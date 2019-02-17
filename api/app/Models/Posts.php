<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = "posts";

    protected $fillable = ['title', 'slug', 'body', 'image', 'published', 'author_id'];

    const UPDATED_AT = null;
    const CREATED_AT = null;
}
