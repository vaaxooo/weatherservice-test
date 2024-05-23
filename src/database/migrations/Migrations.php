<?php

namespace App\Database\Migrations;

class Migrations
{
    /**
     * The `runMigrations` function iterates through PHP migration files in a directory, requires each
     * file, and executes the `runMigrations` method if it exists in the corresponding class.
     */
    public static function runMigrations() {
        try {
            $migrations = glob(__DIR__ . '/*.php');
            foreach ($migrations as $migration) {
                if (basename($migration) != 'Migrations.php') {
                    require_once $migration;
                    $className = 'App\\Database\\Migrations\\' . basename($migration, '.php');
                    if (method_exists($className, 'runMigrations')) {
                        $className::runMigrations();
                    }
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}