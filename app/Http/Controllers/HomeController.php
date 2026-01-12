<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Here you can add code to send email or save to database
        // Example: Mail::to('contact@youssefyouyou.com')->send(new ContactMessage($request->all()));

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully!'
        ]);
    }
}
