<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_default_role = 2;

        $this->validate($request, [
            'username' => 'required|max:30',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            // fix later on
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role' => $user_default_role
        ]);

        Log::channel('myCustomLogFile')->notice('User with an ID ' . Auth::id() . ' just registered.');

        $credentials = $request->only('email', 'password');

        Auth::attempt($credentials);

        return redirect()->route('home');
    }
}
