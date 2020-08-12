<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['url'];
}
