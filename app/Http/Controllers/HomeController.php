<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // to generate random data
//        $user = User::factory()->create();
//        $post = Post::factory()->for($user)
//        ->create();
//        $comment = Comment::factory()
//            ->count(5)
//            ->for($post)->for($user)
//            ->create();
        return view('home',['posts'=>Post::paginate(2)]);
    }
    public function about(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('about');
    }
}
