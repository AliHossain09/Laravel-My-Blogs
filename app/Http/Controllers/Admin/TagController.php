<?php

namespace App\Http\Controllers\Admin;
use Flasher\SweetAlert\Prime\SweetAlertInterface;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tages = Tag::latest()->get();
        return view('admin.tag.index', compact('tages'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.tag.createTag');
         
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'TagName' => 'required|string|max:255',
         ]);

         $tag = new Tag();
            $tag->name = $request->TagName;
            $tag->slug = Str::slug($request->name);
          
         $tag->save();

        // Assuming you have a Tag model
        // Tag::create($request->all());
         toastr()->success('Tag created successfully.');
        return redirect()->route('admin.tag.index');
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
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TagName' => 'required|string|max:255',
         ]);

            $tag = Tag::findOrFail($id);
                $tag->name = $request->TagName;
                $tag->slug = Str::slug($request->name);
            
            $tag->save();
    
            // Assuming you have a Tag model
            toastr()->success('Tag updated successfully.');
            return redirect()->route('admin.tag.index');
           
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        toastr()->success('Tag deleted successfully.');
        return redirect()->route('admin.tag.index');
    }
}
