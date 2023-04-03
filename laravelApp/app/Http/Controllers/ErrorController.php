<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    //

    public function error401()
    {
        $arr = [
            'status' => 401,
            'message' => "Unauthorized",
            'data' => null
          ];
          return response()->json($arr, 401);
    }
}
