<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    // Fields we want to fill
    protected $fillable = ['name', 'email', 'phone'];
}