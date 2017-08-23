<?php

namespace W3C;

use Cmfcmf\OpenWeatherMap;
use PhpSlackBot\Command\BaseCommand;

class Weather extends BaseCommand
{
    private $lang = 'en';
    private $units = 'metric';

    private $apiKey;

    public function __construct()
    {
        $this->apiKey = getenv('openweathermap_apikey');
    }

    protected function configure()
    {
        $this->setName('!weather');
    }

    protected function execute($message, $context)
    {
        $openWeatherMap = new OpenWeatherMap($this->apiKey);

        $forecast = $openWeatherMap->getWeatherForecast('De Kluut', $this->units, $this->lang);

        $theWeather = '';

        $weatherForADay = current($forecast);

        $theWeather .= "Weather forecast at " . $weatherForADay->time->day->format('d.m.Y') . " from " . $weatherForADay->time->from->format('H:i') . " to " . $weatherForADay->time->to->format('H:i')."\n";
        $theWeather .= "It will be " . $weatherForADay->temperature . " degrees Celsius\n";
        $theWeather .= "There will be a wind " . $weatherForADay->wind->direction . " degrees with a speed of " . $weatherForADay->wind->speed . "m/s\n";
        $theWeather .= "We'll have " . $weatherForADay->precipitation . "mm of rain\n";
        $theWeather .= "The humidity will be " . $weatherForADay->humidity . "%\n";
        $theWeather .= $this->decideWhatTypeOfWeatherItIs($weatherForADay);

        $this->send($this->getCurrentChannel(), null, implode("\n", $theWeather));
    }

    protected function decideWhatTypeOfWeatherItIs(OpenWeatherMap\Forecast $weather) {
        if ($weather->precipitation == 0 && $weather->clouds < 25) {
            return "It's going to be one hell of a sunny day\n";
        }

        if ($weather->precipitation > 0 && $weather->precipitation < 5) {
            return "We might have some rain, but we should be fine\n";
        }

        if ($weather->temperature > 25) {
            return "It's going to be very hot, make sure to stay hydrated\n";
        }
    }
}
