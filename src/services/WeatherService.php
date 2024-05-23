<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Database\Models\TemperatureRecord;

class WeatherService
{
    private $client;
    private $city;
    private $apiKey;

    /**
     * The above PHP function is a constructor that initializes class properties for a client, city, and
     * API key using environment variables.
     */
    public function __construct() {
        $this->client = new Client();
        $this->city = $_ENV['CITY'];
        $this->apiKey = $_ENV['API_KEY'];
    }

    /**
     * The function fetches the current temperature of a specified city using the OpenWeatherMap API in
     * PHP.
     * 
     * @return The function `fetchTemperature` is returning the current temperature in Celsius for the
     * specified city using the OpenWeatherMap API.
     */
    public function fetchTemperature() {
        try {
            $url = "http://api.openweathermap.org/data/2.5/weather?q={$this->city}&appid={$this->apiKey}&units=metric";
            $response = $this->client->get($url);
            $data = json_decode($response->getBody(), true);
            return $data['main']['temp'];
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * The function `saveTemperature` saves the current temperature along with a timestamp in a database
     * table.
     */
    public function saveTemperature() {
        try {
            $temperature = $this->fetchTemperature();
            $timestamp = date('Y-m-d H:i:s');
            if($temperature) {
                TemperatureRecord::create([
                    'timestamp' => $timestamp,
                    'temperature' => $temperature,
                ]);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * The function `getTemperatureHistory` retrieves temperature records for a specific date.
     * 
     * @param date The `getTemperatureHistory` function takes a date as a parameter. This date is used to
     * retrieve temperature records from the database that match the provided date. The function then
     * returns a collection of temperature records for that specific date.
     * 
     * @return The `getTemperatureHistory` function is returning a collection of temperature records for a
     * specific date. It uses the `whereDate` method to filter the records based on the `timestamp` column
     * matching the provided date, and then retrieves the records using the `get` method.
     */
    public function getTemperatureHistory($date) {
        try {
            return TemperatureRecord::whereDate('timestamp', $date)->get();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>