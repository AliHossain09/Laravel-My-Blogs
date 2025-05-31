<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Spatie\Image\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    
    public function index()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = User::findOrFail(Auth::id());

        // Check if an image is uploaded
        if (isset($request->image)) {
            // Save the image with a unique name and the original file extension
            $imageName = $request->name . '_' . time() . '.' . $request->image->extension();

            // Define the path for the post images
            $profileImagePath = public_path('profileImages');

            // Ensure the directory exists
            if (!file_exists($profileImagePath)) { mkdir($profileImagePath, 0755, true); }

             // Delete the old image if it exists
            if (file_exists($profileImagePath . '/' . $user->image)) {
            unlink($profileImagePath . '/' . $user->image);
        }

           // Resize the image to 800x600 and save it
            Image::load($request->image->path())->resize(500, 500)->save($profileImagePath . '/' . $imageName);
        } else {
            // If no uploaded image, keep the default image name 'default.png'
            $imageName = $user->image;
        }

        // Update the user profile with the new data
        $user->name = $request->name;
        $user->email = $request->email  ;
        $user->image =$imageName; // Use the uploaded image 
        $user->about = $request->about;

        $user->save();
        toastr()->success('Profile updated successfully.');
        return redirect()->back();
    }
}

