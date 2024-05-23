<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Database\Database;
use App\Services\WeatherService;

new Database();

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($method === 'GET' && $path === '/temperature-history') {
    $day = $_GET['day'] ?? null;
    $xToken = $_SERVER['HTTP_X_TOKEN'] ?? null;

    if ($xToken !== $_ENV['X_TOKEN']) {
        http_response_code(403);
        echo json_encode(['error' => 'Invalid token']);
        exit;
    }

    if (!$day || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $day)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid date format']);
        exit;
    }

    $weatherService = new WeatherService();
    $history = $weatherService->getTemperatureHistory($day);

    echo json_encode($history);
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Not found']);
?>