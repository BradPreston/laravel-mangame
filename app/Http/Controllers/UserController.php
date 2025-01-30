<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create()
    {
        return Inertia::render('User/Create');
    }
    public function store(Request $request)
    {
        $rules = [
            "name" => "required",
            "password" => "required",
            "email" => "required"
        ];
        $validations = [
            "required" => "the :attribute field is required"
        ];
        $validator = Validator::make($request->all(), $rules, $validations);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        return response()->json($input, 200);
    }
}
