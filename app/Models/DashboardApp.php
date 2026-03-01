<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardApp extends Model
{
    protected $fillable = [
        'app_key',
        'name',
        'theme',
        'url',
        'username',
        'password',
        'position',
    ];
}

