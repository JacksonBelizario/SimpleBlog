<?php
/**
 * Created by PhpStorm.
 * User: Jackson
 * Date: 16/02/2019
 * Time: 18:25
 */

namespace App\Http\Controllers;


use App\Http\Resources\PostsResources;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return PostsResources::collection(Posts::all());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required|string",
            "body" => "required|string",
            "image" => "string",
            "published" => "required|boolean",
        ]);

        return (new Posts($request->all()))->save();
    }

}
