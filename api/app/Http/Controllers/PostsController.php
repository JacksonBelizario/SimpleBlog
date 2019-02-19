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
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        return PostsResources::collection(Posts::where("published", 1)->get());
    }

    public function dashIndex()
    {
        return PostsResources::collection(Posts::all());
    }

    public function store(Request $request, Posts $post)
    {
        $this->validate($request, [
            "title" => "required|string",
            "body" => "required|string",
            "image" => "string",
            "published" => "required|boolean",
        ]);

        $data = $request->all();
        $data["slug"] = Str::slug($data["title"]);

        $post->tags()->sync(array_column($data["tags"], "id"));

        if ($post->fill($data)->save()) {
            return new PostsResources($post);
        }
        return response()->json(["erro"], 500);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title" => "required|string",
            "body" => "required|string",
            "image" => "string",
            "published" => "required|boolean",
        ]);

        $data = $request->all();
        unset($data["slug"]);

        $post = Posts::find($id);

        $post->tags()->sync(array_column($data["tags"], "id"));

        if ($post->fill($data)->save()) {
            return new PostsResources($post);
        }
        return response()->json(["erro"], 500);
    }

    public function show($id)
    {
        return new PostsResources(Posts::find($id));
    }

    public function destroy($id)
    {
        $post = Posts::find($id);

        if (!$post->delete()) {
            return response()->json(["erro"], 500);
        }

        return ["success"];
    }

}
