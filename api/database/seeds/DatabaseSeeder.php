<?php

use Illuminate\Database\Seeder;
use \App\Models\Authors;
use \App\Models\Posts;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(Authors::class, 1)->create()->each(function (Authors $authors) {
            $authors->save();
        });

        factory(Posts::class, 5)->create()->each(function (Posts $posts) {
            $posts->save();
        });
    }
}
