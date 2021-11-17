<?php

namespace App\Http\Controllers;

use Spatie\Newsletter\NewsletterFacade as Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        if (!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribePending($request->email);
            return 'subscribed';
        }

        return 'error';
    }
}
