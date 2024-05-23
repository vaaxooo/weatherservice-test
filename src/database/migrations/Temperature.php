<?php

namespace App\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class Temperature {
    /**
     * The function `runMigrations` creates a table named `temperature_records` with columns for id,
     * timestamp, and temperature if the table does not already exist.
     */
    public static function runMigrations() {
        try {
            if (!Capsule::schema()->hasTable('temperature_records')) {
                Capsule::schema()->create('temperature_records', function ($table) {
                    $table->increments('id');
                    $table->timestamp('timestamp');
                    $table->float('temperature');
                });
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}