<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    public $fillable = [
        'age', 'biography', 'language_filter_enabled', 'night_mode_enabled'
    ];
}
