<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $requqest)
    {
        Contact::create($requqest->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact' => 'required|digits:11',
            'message' => 'required'
        ]));

        return back()->with(['success' => "Thank you for reaching out to us. We appreciate your email and look forward to connecting with you soon. We do our very best to get back with you within 24hrs (M-F)."]);
    }
}