<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request) {
        Mail::to('MAIL_FROM_ADDRESS', false)->send(new Contact(), [
            'name' => $request->name,
            'message' => $request->message,
            'from' => $request->email
        ]);
    }
}
