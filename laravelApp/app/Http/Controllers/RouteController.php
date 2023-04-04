<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Route;
use App\Http\Resources\RouteResource;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $route = Route::all();
        $data = [
            'routes' => RouteResource::collection($route)
          ];
        $arr = [
            'status' => true,
            'message' => "Danh sách tuyến",
            'data' => $data
        ];
        return response()->json($arr, 200);
    }


    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'fromId' => 'required',
            'toId' => 'required',
            'departure' => 'required',
            'arrival' => 'required',

        ]);
        if ($validator->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ];
            return response()->json($arr, 200);
        }
        $route = Route::create($input);
        $arr = [
            'status' => true,
            'message' => "Tuyến đã lưu thành công",
            'data' => new RouteResource($route)
        ];
        return response()->json($arr, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($_id)
    {
        $route = Route::find($_id);
        if (is_null($route)) {
            $arr = [
                'success' => false,
                'message' => 'Không có tuyến này',
                'data' => []
            ];
            return response()->json($arr, 200);
        }
        $data = [
            'routes' => new RouteResource($route)
          ];
        $arr = [
            'status' => true,
            'message' => "Chi tiết tuyến ",
            'data' => $data
        ];
        return response()->json($arr, 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $_id)
    {
        $route = Route::find($_id);
        if (!$route) {
            $error = ['message' => 'Không tìm thấy id cần sửa'];
            return response()->json($error);
        }
        $input = $request->all();       
        $route->fromId = $input['fromId'];
        $route->toId = $input['toId'];
        $route->departure = $input['departure'];
        $route->arrival = $input['arrival'];
        $route->bus = $input['bus'];
        $route->price = $input['price'];
        $route->save();
        $arr = [
            'status' => true,
            'message' => 'cập nhật thành công',
            'data' => new RouteResource($route)
        ];
        return response()->json($arr, 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($_id)
    {
        $route = Route::find($_id);
        if ($route) {
            $route->delete();
            $arr = [
                'status' => true,
                'message' => 'Tuyến đã được xóa',
                'data' => [],
            ];
            return response()->json($arr, 200);
        } else {
            $error = ['message' => 'Không tìm thấy id cần xóa'];
            return response()->json($error);
        }
    }
}