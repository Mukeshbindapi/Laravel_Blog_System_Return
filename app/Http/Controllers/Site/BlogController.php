<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Post::where('status', Post::PUBLISHED)->SimplePaginate(4);
        return view('site.index', compact('blogs'));
    }

    public function openSingleBlog($id)
    {
        $blog = Post::find($id);

        if(!$blog){
            abort(404);
        }

        $comments = Comment::where('post_id', $blog->id)->SimplePaginate(3);
        $latestBlogs = Post::where('id', '!=', $blog->id)->latest()->limit(5)->get();
        $tags = $blog->tags;

        return view('site.single', compact('blog', 'comments', 'latestBlogs', 'tags'));
    }
}
