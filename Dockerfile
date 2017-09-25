FROM php:7

ADD . /var/bot

COPY docker/supervisord/wecamp_bot.conf /etc/supervisord/conf.d/wecamp_bot.conf

WORKDIR /var/bot

RUN apt-get update && apt-get install -y git zlib1g-dev supervisord
RUN docker-php-ext-install zip

RUN cd /var/bot && ./composer.phar install

CMD supervisorctl start
