<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";

    protected $fillable = ["name", "email", "password"];

    protected $hidden = ["password"];

    const UPDATED_AT = null;
    const CREATED_AT = null;
}
