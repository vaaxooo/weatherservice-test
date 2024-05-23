# Weather Service Microservice

This project is a microservice for fetching and storing hourly weather data for a specified city and providing an API to retrieve the temperature history for a given day.

## Features

- Fetches temperature data for a specified city every hour
- Stores temperature data in a database
- Provides an API to retrieve temperature history for a given day
- Requires a valid `x-token` for API requests to prevent spam

## Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL or any other supported database
- An API key from [OpenWeatherMap](https://openweathermap.org/api)

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/vaaxooo/weather_service.git
    cd weather_service
    ```

2. Install the dependencies:

    ```bash
    composer install
    ```

3. Create a copy of the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Open the `.env` file and update the following settings:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=weather
    DB_USERNAME=root
    DB_PASSWORD=root_password

    CITY=Kyiv
    API_KEY=your_openweathermap_api_key
    X_TOKEN=d1f5e6c8a9b3f4d7e2a1b9c4d5e6f7a8
    ```

5. Run the database migrations:

    ```bash
    php cron.php
    ```

6. Start the PHP built-in server:

    ```bash
    php -S localhost:8000 -t public
    ```

## Usage

### Fetching Temperature Data

The microservice fetches temperature data for the specified city every hour and stores it in the database. This is handled by the `cron.php` script.

### Retrieving Temperature History

To retrieve the temperature history for a specific day, send a GET request to the `/temperature-history` endpoint with the following parameters:

- `day` (required) - The date for which to retrieve the temperature history in `Y-m-d` format.
- `x-token` (required) - A valid 32-character token passed via the `x-token` header.

Example request:

```http
GET /temperature-history?day=2023-05-23 HTTP/1.1
Host: localhost:8000
x-token: d1f5e6c8a9b3f4d7e2a1b9c4d5e6f7a8
```

Example response:

```bash
[
    {
        "id": 1,
        "timestamp": "2023-05-23 01:00:00",
        "temperature": 22.5
    },
    {
        "id": 2,
        "timestamp": "2023-05-23 02:00:00",
        "temperature": 22.7
    }
]
```
