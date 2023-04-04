<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Validator;


class UserController extends Controller
{

  public function index()
  {
    $users = Users::all();
    $arr = [
      'status' => true,
      'message' => "Danh sách tuyến",
      'data' => UserResource::collection($users)
    ];
    return response()->json($arr, 200);
  }

  public function store(Request $request)
  {
    $input = $request->all();
    $validator = Validator::make($input, [
      'username' => 'required',
      'password' => 'required',


    ]);
    if ($validator->fails()) {
      $arr = [
        'success' => false,
        'message' => 'Lỗi kiểm tra dữ liệu',
        'data' => $validator->errors()
      ];
      return response()->json($arr, 200);
    }
    $users = Users::create($input);
    $arr = [
      'status' => true,
      'message' => "Tai khoan đã lưu thành công",
      'data' => new UserResource($users)
    ];
    return response()->json($arr, 201);
  }

  public function show($id)
  {
    $users = Users::find($id);
    if (is_null($users)) {
      $arr = [
        'success' => false,
        'message' => 'Không có sản phẩm này',
        'dara' => []
      ];
      return response()->json($arr, 200);
    }
    $arr = [
      'status' => true,
      'message' => "Chi tiết sản phẩm ",
      'data' => new UserResource($users)
    ];
    return response()->json($arr, 201);
  }

  public function update(Request $request, $_id)
  {
    $users = Users::find($_id);
    if (!$users) {
      $error = ['message' => 'Không tìm thấy id cần xóa'];
      return response()->json($error);
    }
    $input = $request->all();
    $validator = Validator::make($input, [
      'userName' => 'required',
      'email' => 'required',
      'password' => 'required',
      'name' => 'required',
      'phone' => 'required',
    ]);
    if ($validator->fails()) {
      $arr = [
        'success' => false,
        'message' => 'Lỗi kiểm tra dữ liệu',
        'data' => $validator->errors()
      ];
      return response()->json($arr, 200);
    }
    $users->userName = $input['userName'];
    $users->email = $input['email'];
    $users->password = $input['password'];
    $users->name = $input['name'];
    $users->phone = $input['phone'];
    $users->save();
    $arr = [
      'status' => true,
      'message' => 'cập nhật thành công',
      'data' => new UserResource($users)
    ];
    return response()->json($arr, 200);
  }

  public function destroy($_id)
  {
    $users = Users::find($_id);
    if ($users) {
      $users->delete();
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