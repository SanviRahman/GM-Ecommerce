<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'newsletter_email' => 'required|email:rfc|max:254',
            'website' => 'nullable|max:0', // honeypot
        ]);

        $email = strtolower(trim($request->input('newsletter_email')));
        // Create once, preserving the original subscription date on repeat requests.
        NewsletterSubscriber::firstOrCreate(['email' => $email]);
        return redirect()->back()->with('newsletter_success', 'Thank you for subscribing!');
    }
}
