<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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
            return response()->json($validator->errors(), 422);
        }
        $input = $request->all();
        return response()->json($input, 200);
    }
}
