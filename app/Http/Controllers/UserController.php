<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Http\Controllers\AuthenticateController as Login;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): RedirectResponse | Response
    {
        // Redirect to the login page if user is not logged in.
        // Prevents the user from accessing the account page unless logged in.
        if (!Auth::check()) {
            return redirect('/account/login');
        }
        return Inertia::render('Account/Index', [
            'isLoggedIn' => Auth::check()
        ]);
    }
    public function login(): RedirectResponse | Response
    {
        // Redirect to the account page if user is logged in.
        // Prevents the user from accessing the login page if already logged in.
        if (Auth::check()) {
            return redirect('/account');
        }
        return Inertia::render('Account/Login');
    }
    public function create(): RedirectResponse | Response
    {
        // Redirect to the account page if user is logged in.
        // Prevents the user from accessing the register account page if already logged in.
        if (Auth::check()) {
            return redirect('/account');
        }
        return Inertia::render('Account/Register');
    }
    public function store(Request $request)
    {
        $rules = [
            "first_name" => "required",
            "last_name" => "required",
            "password" => "required",
            "email" => "required|unique:users"
        ];
        $validations = [
            "required" => "the :attribute field is required"
        ];
        $validator = Validator::make($request->all(), $rules, $validations);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::create([
            "first_name" => $request->input('first_name'),
            "last_name" => $request->input('last_name'),
            "email" => $request->input('email'),
            "password" => $request->input('password'),
        ]);

        $login = new Login;
        $login->authenticate($request);
    }
}
