<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
