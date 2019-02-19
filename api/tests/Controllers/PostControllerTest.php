<?php
/**
 * Created by PhpStorm.
 * User: Jackson
 * Date: 18/02/2019
 * Time: 22:57
 */

namespace Tests\Controllers;

use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/posts');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "*" => [
                    "id",
                    "title",
                    "slug",
                    "body",
                    "image",
                    "published",
                    "author" => [
                        "id",
                        "name"
                    ],
                    "tags"
                ]
            ]
        ]);
    }

}
