<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = "posts";

    protected $fillable = ['title', 'slug', 'body', 'image', 'published', 'author_id'];

    protected $hidden = ['author_id'];

    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $casts = [
        'published' => 'boolean'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function author()
    {
        return $this->hasOne('App\Models\Authors', "id", "author_id");
    }

    public function tags()
    {
        return $this->belongsToMany(
            'App\Models\Tags', 'post_tag', 'post_id', 'tag_id'
        )->using('App\Models\Pivots\PostTag');
    }

}
