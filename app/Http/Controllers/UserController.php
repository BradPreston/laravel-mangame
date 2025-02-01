<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create()
    {
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

        return redirect()->back();
    }
}
