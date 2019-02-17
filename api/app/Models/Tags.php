<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = "tags";

    protected $fillable = ["name"];

    public function posts()
    {
        return $this->belongsToMany(
            'App\Models\Posts',
            'post_tag',
            'tag_id',
            'post_id'
        )->using('App\Models\Pivots\PostTag');
    }

    const UPDATED_AT = null;
    const CREATED_AT = null;
}
