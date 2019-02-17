<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    protected $table = "post_tag";

    protected $fillable = ["post_id", "tag_id"];

    const UPDATED_AT = null;
    const CREATED_AT = null;
}
