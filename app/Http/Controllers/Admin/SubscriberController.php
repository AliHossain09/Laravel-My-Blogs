<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    public function index()
    {
        // Fetch all subscribers from the database
        $subscribers = Subscriber::all();
        
        // Return the view with the subscribers data
        return view('admin.subscriber', compact('subscribers'));
    }
    public function destroy($id)
    {
        // Find the subscriber by ID and delete it
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        
        // Redirect back to the subscribers list with a success message
        toastr()->success('Subscriber deleted successfully.');
        return redirect()->route('admin.subscriber.index');
    }
}
