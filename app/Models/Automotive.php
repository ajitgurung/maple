<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Automotive extends Model
{
    public $fillable = ['make', 'model', 'year', 'type', 'price_note'];
}
