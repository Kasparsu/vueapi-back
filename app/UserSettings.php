<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    public $fillable = [
        'values',
    ];

    protected $casts = [
        'values' => 'array',
    ];

}
