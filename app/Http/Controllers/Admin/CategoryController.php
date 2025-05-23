<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.createCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'categoryName' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if an image is uploaded
        if(isset($request->image))
        {
            // Save the image with a unique name and the original file extension
            $imageName = time().'.'.$request->image->extension();

            // Define the paths for the images
            $slider = public_path('categoryImages/slider');
            $categoryFolder = public_path('categoryImages');

            // Resize the image to 500x333 for the slider and 1600x479 for the category folder
            Image::load($request->image->path())->resize(500, 333)->save( $slider.'/'.$imageName);
            Image::load($request->image->path())->resize(1600, 479)->save( $categoryFolder.'/'.$imageName);
        }
        else
        {
            // If no uploaded image, keep the default image name 'category.png'
            $imageName = 'category.png';
        }
       

       
        // add new post
        $category = new Category();
        $category->name = $request->categoryName;
        $category->slug = Str::slug($request->name);
        $category->image = $imageName;
        $category->save();
        // success message
        toastr()->success('Category created successfully.');
        // Redirect to the index page
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);
        // Return the edit view with the category data
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        // Validate the request data
        $request->validate([
            'categoryName' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
       
            // Updated image
        // Check if an image is uploaded
        if(isset($request->image))
        {
           $imageName = time().'.'.$request->image->extension();
            $slider = public_path('categoryImages/slider');
            $categoryFolder = public_path('categoryImages');

            
            // Delete the old image if it exists
            if ($category->image != 'category.png' && file_exists($slider.'/'.$category->image)) {
                unlink($slider.'/'.$category->image);

                 // Image::load($request->image->path())->resize(500, 333)->save( $slider.'/'.$imageName);
                Image::load($request->image->path())->resize(500, 333)->save( $slider.'/'.$imageName);
            }

            // Delete the old image if it exists
            if ($category->image != 'category.png' && file_exists($categoryFolder.'/'.$category->image)) {
                unlink($categoryFolder.'/'.$category->image);

                 // Image::load($request->image->path())->resize(1600, 479)->save( $categoryFolder.'/'.$imageName);   
                 Image::load($request->image->path())->resize(1600, 479)->save( $categoryFolder.'/'.$imageName);  
            }
            
            
        }
        else
        {
            // If no new image is uploaded, keep the old image
           $imageName = $category->image;
        } 
    
        // update  post
        $category =  Category::findOrFail($id);   //Optional Because we are using the same variable name
        $category->name = $request->categoryName;
        $category->slug = Str::slug($request->categoryName);
        $category->image = $imageName;
        $category->save();

        toastr()->success('Category updated successfully.');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        toastr()->success('Category deleted successfully.');
        return redirect()->route('admin.category.index');
    }
}
