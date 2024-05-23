<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureRecord extends Model {
    protected $fillable = ['timestamp', 'temperature'];
    public $timestamps = false;
}
?>