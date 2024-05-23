<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Database\Database;
use App\Services\WeatherService;

new Database();

$weatherService = new WeatherService();
$weatherService->saveTemperature();

echo 'Temperature saved' . PHP_EOL;
?>