<?php

namespace Fnatic\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'birthday'];
}
