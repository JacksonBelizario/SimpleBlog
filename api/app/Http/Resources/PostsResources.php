<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostsResources extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $request["author"] = $this->author;
        return parent::toArray($request);
    }
}
