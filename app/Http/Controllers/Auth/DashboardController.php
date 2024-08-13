<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MOdels\Post;
use App\MOdels\Tag;
use App\MOdels\Category;
use App\MOdels\User;

class DashboardController extends Controller
{
    public function dashboard(){
        $postCount = Post::count();
        $tagCount = Tag::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        return view('auth.dashbord', compact('postCount', 'tagCount', 'categoryCount', 'userCount'));
    }
}
