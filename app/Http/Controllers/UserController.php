<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request) {
        // validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        // if request is invalid, return 400 response
        if ($validator->stopOnFirstFailure()->fails()) {
            $json = json_decode($validator->errors(), true);
            foreach ($json as $key => $value) {
                return response()->json(["error" => $value[0]], 400);
            }
        }
        // grab the request data and return it as json
        $input = $request->all();
        return response()->json($input, 200);
    }
}
