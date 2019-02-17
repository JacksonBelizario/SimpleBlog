<?php
/**
 * Created by PhpStorm.
 * User: Jackson
 * Date: 16/02/2019
 * Time: 18:25
 */

namespace App\Http\Controllers;

use App\Models\Authors;

class AuthorsController extends Controller
{
    public function index()
    {
        return Authors::all();
    }
}
