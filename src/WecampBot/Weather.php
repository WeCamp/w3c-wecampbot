<?php

namespace W3C;

use Cmfcmf\OpenWeatherMap;
use PhpSlackBot\Command\BaseCommand;

class Weather extends BaseCommand
{
    private $lang = 'en';
    private $units = 'metric';

    private $apiKey;

    /**
     * @var OpenWeatherMap
     */
    private $openWeatherMap;

    public function __construct()
    {
        $this->apiKey = getenv('OPENWEATHERMAP_APIKEY');

        $this->openWeatherMap = new OpenWeatherMap($this->apiKey);
    }

    protected function configure()
    {
        $this->setName('!weather');
    }

    protected function execute($message, $context)
    {
        $argument = $this->extractFirstArgument($message);

        if ('debug' === $argument) {
            return $this->handleDebug();
        }

        $theWeather = '';

        $weatherForADay = $this->getForecast();

        $from = $weatherForADay->time->from;
        $to = $weatherForADay->time->to;
        $day = $weatherForADay->time->day;

        $timezone = new \DateTimeZone('Europe/Amsterdam');
        $from->setTimezone($timezone);
        $to->setTimezone($timezone);
        $day->setTimezone($timezone);

        $theWeather .= "Weather forecast at " . $day->format('d.m.Y') . " from " . $from->format('H:i') . " to " . $to->format('H:i')."\n";
        $theWeather .= "It will be " . str_replace('&deg;', '°', $weatherForADay->temperature) . "\n";
        $theWeather .= "There will be a wind " . $weatherForADay->wind->direction . " degrees with a speed of " . $weatherForADay->wind->speed . "\n";
        $theWeather .= "We'll have " . $weatherForADay->precipitation . " mm of rain\n";
        $theWeather .= "The humidity will be " . $weatherForADay->humidity . "\n";
        $theWeather .= $this->decideWhatTypeOfWeatherItIs($weatherForADay);

        $this->sendToChannel($theWeather);
    }

    protected function decideWhatTypeOfWeatherItIs(OpenWeatherMap\Forecast $weather) {
        $precipitation = $weather->precipitation->getValue();
        $clouds = $weather->clouds->getValue();
        $temperature = $weather->temperature->getValue();

        if ($precipitation == 0 && $clouds < 25) {
            return "It's going to be one hell of a sunny day\n";
        }

        if ($precipitation > 0 && $precipitation < 5) {
            return "We might have some rain, but we should be fine\n";
        }

        if ($temperature > 25) {
            return "It's going to be very hot, make sure to stay hydrated\n";
        }
    }

    private function handleDebug()
    {
        $message = print_r($this->getForecast());

        $this->sendToChannel($message);
    }

    private function getForecast()
    {
        $weatherForecast = $this->openWeatherMap->getWeatherForecast('Biddinghuizen', $this->units, $this->lang);

        return $weatherForecast->current();
    }

    private function extractFirstArgument($message)
    {
        $args = [];

        if (isset($message['text'])) {
            $args = array_values(array_filter(explode(' ', $message['text'])));
        }

        return isset($args[1]) ? $args[1] : '';
    }

    private function sendToChannel($message)
    {
        $this->send($this->getCurrentChannel(), null, $message);
    }
}
