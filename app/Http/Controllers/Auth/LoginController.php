<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $req)
    {
        // validation
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //sign the user in
        if (!Auth::attempt($req->only('email', 'password'), $req->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        // redirect
        return redirect()->route('dashboard');
    }
}
