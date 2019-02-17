<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = "authors";

    protected $fillable = ['name'];

    const UPDATED_AT = null;
    const CREATED_AT = null;
}
