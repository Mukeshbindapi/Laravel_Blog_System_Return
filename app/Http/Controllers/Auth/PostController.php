<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Posts\CreateRequest;
use App\Http\Requests\Auth\Posts\UpdateRequest;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('auth.posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('auth.posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            DB::beginTransaction();

                if($file = $request->file('file')){
                    $fileName =  $this->fileUpload($file);
                    $gallery = $this->storeImage($fileName);
                }

                $post = Post::create([
                    'gallery_id' => $gallery->id,
                    'user_id' => auth()->id(),
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->status,
                    'category_id' => $request->category,
                ]);

                // Attach tags to the post
                foreach($request->tags as $tag){
                    $post->tags()->attach($tag);
                }

            DB::commit();

            $request->session()->flash('alert-success', 'Post Created Successfully');

            return to_route('posts.index');

        }catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }

        return 'Done';
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('auth.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $postTags = $post->tags; // Fetch tags related to this post

        return view('auth.posts.edit', compact('post', 'categories', 'tags', 'postTags'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        if ($file = $request->file('file')) {
            $imageName = null;
            if ($post->gallery) {
                $imageName = $post->gallery->image;
                $imagePath = public_path('/storage/auth/posts/');

                if (file_exists($imagePath . $imageName)) {
                    unlink($imagePath . $imageName);
                }
            }

            $fileName = $this->fileUpload($file);

            if ($post->gallery) {
                $post->gallery->update([
                    'image' => $fileName
                ]);
            } else {
                $post->gallery()->create([
                    'image' => $fileName
                ]);
            }
        }

        $post->update([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category,
        ]);

        $post->tags()->sync($request->tags);

        $request->session()->flash('alert-success', 'Post Updated Successfully');

        return to_route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();

        $post->delete();

        request()->session()->flash('alert-success', 'Post Deleted Successfully');

        return to_route('posts.index');
    }

    private function fileUpload($file)
    {
        $filename = rand(100, 1000000) . time() . $file->getClientOriginalName();

        $filePath = public_path('/storage/auth/posts/');

        $fileWithPath = $filePath . $filename;

        $file->move($filePath, $filename);

        return $filename;
    }

    private function storeImage($filename)
    {
        $gallery = Gallery::create([
            'image' => $filename,
            'type' => Gallery::POST_IMAGE
        ]);
        return $gallery;
    }
}
