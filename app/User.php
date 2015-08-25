<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Lawrence
 * Date: 8/19/15
 * Time: 10:26 AM
 */
class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['first_name', 'last_name', 'phone_no'];
}
