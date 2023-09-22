<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {


        return view('home', [

        ]);
    }
}
