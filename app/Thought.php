<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thought extends Model
{
    protected $table = 'thoughts';
    protected $fillable = ['title', 'link_url', 'score'];
}
