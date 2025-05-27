<?php

namespace App\Http\Controllers\Author;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Image\Image;

class AuthorPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       if (!Auth::check() || Auth::User()->role->id != 2) {
            return redirect()->route('login')->with('error', 'You do not have author access.');
        }
       
         $posts = Auth::User()->posts()->latest()->get();
        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.createPost', compact('categories', 'tags'));
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
            'tags' => 'nullable',
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
        $post->is_approved = false; // Automatically approve the post

        // Save the post
        $post->save();

        // Attach the category to the post
        $post->categories()->attach($request->category_id);
        $post->tags()->attach($request->tags);
        

        // Redirect to the index page with success message
        toastr()->success('Post created successfully.');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Check if the post belongs to the authenticated user
        if ($post->user_id != Auth::id()) {
            return redirect()->route('author.post.index')->with('error', 'You do not have permission to view this post.');
        }
        // Fetch all categories and tags for the post
        if (!Auth::check() || Auth::User()->role->id != 2) {
            return redirect()->route('login')->with('error', 'You do not have author access.');
        }
        $categories = Category::all();
        // Fetch all tags for the post
        
        $tags = Tag::all();
        return view('author.post.show', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Check if the post belongs to the authenticated user
        if ($post->user_id != Auth::id()) {
            return redirect()->route('author.post.index')->with('error', 'You do not have permission to edit this post.');
        }
        // Fetch all categories and tags for the form
        if (!Auth::check() || Auth::User()->role->id != 2) {
            return redirect()->route('login')->with('error', 'You do not have author access.');
        }
        // Fetch all categories and tags for the form
        $categories = Category::all();
        $tags = Tag::all();
        // Toaster Success And Error Messages
    
        // Check if the post is already approved
        return view('author.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validate the request data
        $request->validate([
            'postTitle' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable',
            'body' => 'required|string',
        ]);

        // Check if an image is uploaded
        if (isset($request->image)) {
            // Save the image with a unique name and the original file extension
            $imageName = $request->postTitle . '_' . time() . '.' . $request->image->extension();

            // Define the path for the post images
            $postImagePath = public_path('postImages');

            // Delete the old image if it exists
            if ($post->image != $imageName && file_exists($postImagePath.'/'.$post->image)) {
                unlink($postImagePath.'/'.$post->image);

                // Resize the image to 800x600 and save it
            Image::load($request->image->path())->resize(1600, 1066)->save($postImagePath . '/' . $imageName);
            }

            
        } else {
            // If no uploaded image, keep the existing image name
            $imageName = $post->image;
        }

        // Update the post details
        $post->title = $request->postTitle;
        $post->slug = Str::slug($request->postTitle, '-');
        $post->image = $imageName; // Updated image
        $post->body = $request->body;

        if (isset($request->status)) {
            $post->status = true; // If status is set, mark as published
        } else {
            $post->status = false; // If status is not set, mark as draft
        }
        $post->is_approved = false; // Automatically approve the post
        
        // Save the updated post
        $post->save();

        // Sync the category and tags for the post
        $post->categories()->sync([$request->category_id]);
        $post->tags()->sync($request->tags);

        // Redirect to the index page with success message
        toastr()->success('Post updated successfully.');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Check if the post belongs to the authenticated user
        if ($post->user_id != Auth::id()) {
            return redirect()->route('author.post.index')->with('error', 'You do not have permission to delete this post.');
        }
        // Check if the user is authenticated and has author access
        if (!Auth::check() || Auth::User()->role->id != 2) {
            return redirect()->route('login')->with('error', 'You do not have author access.');
        }
        // Check if the post exists
        if (!$post) {
            return redirect()->route('author.post.index')->with('error', 'Post not found.');
        }
        // Check if the post is already deleted
        if ($post->deleted_at) {
            return redirect()->route('author.post.index')->with('error', 'Post is already deleted.');
        }
         // Delete the post image from the server
        $postImagePath = public_path('postImages');
        if (file_exists($postImagePath . '/' . $post->image)) {
            unlink($postImagePath . '/' . $post->image);
        }
        // Detach/Remove the categories and tags associated with the post
        // If the post has categories, delete them
        $post->categories()->detach();
        // If the post has tags, delete them
        $post->tags()->detach();

        // Delete the post from the database
        $post->delete();

        // Redirect to the index page with success message
        toastr()->success('Post deleted successfully.');
        return redirect()->route('author.post.index');
    }
}
