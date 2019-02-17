<?php
/**
 * Created by PhpStorm.
 * User: Jackson
 * Date: 16/02/2019
 * Time: 18:25
 */

namespace App\Http\Controllers;

use App\Models\Tags;

class TagsController extends Controller
{
    public function index()
    {
        return Tags::all();
    }
}
