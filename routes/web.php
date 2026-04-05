<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::view('/', 'welcome', [
    'greeting' => 'Hello, World!',
    'name' => 'John Doe',
    'age' => 30,
    'tasks' => [
        'Learn Laravel',
        'Build a project',
        'Deploy to production',
    ],
]);

Route::view('/about', 'about');
Route::view('/contact', 'contact');

// if email is added, it shows in the formtest view
Route::get('/formtest', function () {
    $emails = session()->get('emails', []);
    return view('formtest', [
        'emails' => $emails,
    ]);
});

// add email
Route::post('/formtest', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);
    $emails = session()->get('emails', []);
    $email = $request->input('email');
    if (count($emails) >= 5) {
        return back()->with('error', 'Maximum of 5 emails only.');
    }
    if (in_array($email, $emails)) {
        return back()->with('error', 'Email already exists.');
    }
    $emails[] = $email;
    session()->put('emails', $emails);
    return back()->with('success', 'Email saved!');
});

// delete email one by one
Route::post('/delete-email', function (Request $request) {
    $emails = session()->get('emails', []);
    $index = $request->input('index');
    if (!isset($emails[$index])) {
        return back()->with('error', 'Invalid email selection.');
    }
    unset($emails[$index]);
    $emails = array_values($emails);
    session()->put('emails', $emails);
    return back()->with('success', 'Email removed.');
});

// delete all emails "Clear All" button
Route::get('/delete-emails', function () {
    session()->forget('emails');
    return redirect('/formtest')->with('success', 'All emails cleared.');
});