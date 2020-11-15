<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static create(string[] $array)
 */
class Admin extends Authenticatable
{
    protected $guarded = ['id'];
}
