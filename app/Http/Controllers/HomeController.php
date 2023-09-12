<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

class HomeController extends Controller
{
    public function __invoke()
    {
        $user = User::find(2);

        dump($user->profile);

        $users = User::query()->select(['id', 'name', 'email'])->paginate(5);

        return view('home', [
            'users' => $users,
        ]);
    }
}
