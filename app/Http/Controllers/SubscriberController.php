<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    
    //   Store a new subscriber.
     
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        // Create a new subscriber
        $subscriber = new Subscriber();
        $subscriber->email = $request->input('email');
        $subscriber->save();

        // Return a response or redirect
        toastr()->success( 'Thank you for subscribing!');
        return redirect()->back();
    }
}
