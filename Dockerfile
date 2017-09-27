FROM php:7

ADD . /var/bot

WORKDIR /var/bot

RUN apt-get update && apt-get install -y git zlib1g-dev supervisord
RUN docker-php-ext-install zip

COPY docker/supervisord/wecamp_bot.conf /etc/supervisord/conf.d/wecamp_bot.conf

RUN cd /var/bot && ./composer.phar install

CMD supervisorctl start
