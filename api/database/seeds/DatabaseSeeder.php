<?php

use Illuminate\Database\Seeder;
use \App\Models\Authors;
use \App\Models\Posts;
use \App\Models\Tags;
use \App\Models\Users;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Users::class)->create()->save();

        factory(Authors::class, 3)->create()->each(function (Authors $author) {
            $author->save();
        });

        factory(Tags::class, 5)->create()->each(function (Tags $tag) {
            $tag->save();
        });

        factory(Posts::class, 5)->create()->each(function (Posts $post) {
            $post->tags()->sync(([rand(1, 5), rand(1, 5)]));
            $post->save();
        });
    }
}
