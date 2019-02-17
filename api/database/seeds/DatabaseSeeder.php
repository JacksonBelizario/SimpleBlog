<?php

use Illuminate\Database\Seeder;
use \App\Models\Authors;
use \App\Models\Posts;
use \App\Models\Tags;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Authors::class, 5)->create()->each(function (Authors $author) {
            $author->save();
        });

        factory(Tags::class, 5)->create()->each(function (Tags $tag) {
            $tag->save();
        });

        factory(Posts::class, 5)->create()->each(function (Posts $post) {
            $post->tags()->sync(array_rand([1,2,3,4,5], 2));
            $post->save();
        });
    }
}
