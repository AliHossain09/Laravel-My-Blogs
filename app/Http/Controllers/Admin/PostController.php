<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use Spatie\Image\Image;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.createPost', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'postTitle' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|nullable',
            'body' => 'required|string',

        ]);
        // Check if an image is uploaded
        if (isset($request->image)) {
            // Save the image with a unique name and the original file extension
            $imageName = $request->postTitle . '_' . time() . '.' . $request->image->extension();

            // Define the path for the post images
            $postImagePath = public_path('postImages');

            // Resize the image to 800x600 and save it
            Image::load($request->image->path())->resize(1600, 1066)->save($postImagePath . '/' . $imageName);
        } else {
            // If no uploaded image, keep the default image name 'default.png'
            $imageName = 'default.png';
        }

        // Create a unique slug
        $slug = Str::slug($request->postTitle, '-');
        $originalSlug = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        // Create a new post instance
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->postTitle;
        $post->slug =  $slug;
        $post->image = $imageName; // Default image
        $post->body = $request->body;

        if (isset($request->status)) {
            $post->status = true; // If status is set, mark as published
        } else {
            $post->status = false; // If status is not set, mark as draft
        }
        $post->is_approved = true; // Automatically approve the post

        // Save the post
        $post->save();

        // Attach the category to the post
        $post->categories()->attach($request->category_id);
        $post->tags()->attach($request->tags);
        

        // Redirect to the index page with success message
        toastr()->success('Post created successfully.');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
