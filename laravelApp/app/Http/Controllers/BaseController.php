<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Base;
use App\Http\Resources\BaseResource;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $base = Base::all();
        $data = [
            'bases' => BaseResource::collection($base)
        ];
        $arr = [
            'status' => true,
            'message' => "Danh sách cơ sở",
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
        $base = Base::create($input);
        $arr = [
            'status' => true,
            'message' => "cơ sở đã lưu thành công",
            'data' => new BaseResource($base)
        ];
        return response()->json($arr, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($_id)
    {
        $base = Base::find($_id);
        if (is_null($base)) {
            $arr = [
                'success' => false,
                'message' => 'Không có cơ sở này',
                'data' => []
            ];
            return response()->json($arr, 200);
        }
        $data = [
            'bases' => new BaseResource($base)
        ];
        $arr = [
            'status' => true,
            'message' => "Chi tiết cơ sở ",
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
        $base = Base::find($_id);
        if (!$base) {
            $error = ['message' => 'Không tìm thấy id cần sửa'];
            return response()->json($error);
        }
        $input = $request->all();


        $base->name = $input['name'];
        $base->address = $input['address'];
        $base->save();
        $arr = [
            'status' => true,
            'message' => 'cập nhật thành công',
            'data' => new BaseResource($base)
        ];
        return response()->json($arr, 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($_id)
    {
        $base = Base::find($_id);
        if ($base) {
            $base->delete();
            $arr = [
                'status' => true,
                'message' => 'cơ sở đã được xóa',
                'data' => [],
            ];
            return response()->json($arr, 200);
        } else {
            $error = ['message' => 'Không tìm thấy id cần xóa'];
            return response()->json($error);
        }

    }
}