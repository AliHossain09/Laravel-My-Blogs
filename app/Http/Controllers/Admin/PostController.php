<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use Spatie\Image\Image;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use Illuminate\Support\Facades\Notification;
use Mockery\Matcher\Not;

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
        $post->is_approved = true; // Automatically approve the post

        // Save the post
        $post->save();

        // Attach the category to the post
        $post->categories()->attach($request->category_id);
        $post->tags()->attach($request->tags);
        
        $subscribers = Subscriber::all();
        foreach($subscribers as $subscriber) {
            Notification::route('mail', $subscriber->email)
                ->notify(new NewPostNotify($post));
        }

        // Redirect to the index page with success message
        toastr()->success('Post created successfully.');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.show', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
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
        $post->is_approved = true; // Automatically approve the post
        
        // Save the updated post
        $post->save();

        // Sync the category and tags for the post
        $post->categories()->sync([$request->category_id]);
        $post->tags()->sync($request->tags);

        // Redirect to the index page with success message
        toastr()->success('Post updated successfully.');
        return redirect()->route('admin.post.index');
    }


    /**
     * Approve the specified post.
     */
    public function approve($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Check if the post is already approved
        if ($post->is_approved) {
            toastr()->info('Post is already approved.');
            return redirect()->route('admin.post.index');
        }

        // Approve the post
        $post->is_approved = true;
        $post->save();

        // Notify the author about the approval
        $post->user->notify(new AuthorPostApproved($post));
        // Notify all subscribers about the new post
        $subscribers = Subscriber::all();
        foreach($subscribers as $subscriber) {
            Notification::route('mail', $subscriber->email)
                ->notify(new NewPostNotify($post));
        }

        // Redirect to the index page with success message
        toastr()->success('Post approved successfully.');
        return redirect()->route('admin.post.index');
    }
    /**
     * Display a listing of pending posts.
     */
    public function pending()
    {
        // Get all posts that are not approved
        $posts = Post::where('is_approved', false)->latest()->get();
        return view('admin.post.pending', compact('posts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
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
        return redirect()->route('admin.post.index');
    }
}
