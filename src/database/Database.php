<?php

namespace App\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Database\Migrations\Migrations;

class Database {
    public function __construct() {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => $_ENV['DB_CONNECTION'],
            'host'      => $_ENV['DB_HOST'],
            'database'  => $_ENV['DB_DATABASE'],
            'username'  => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => $_ENV['DB_PREFIX'],
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $this->runMigrations();
    }

    /**
     * The private function `runMigrations` in PHP runs database migrations using the `Migrations` class.
     */
    private function runMigrations() {
        Migrations::runMigrations();
    }
}
