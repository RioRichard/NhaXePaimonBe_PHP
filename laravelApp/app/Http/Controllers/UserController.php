<?php

namespace App\Http\Controllers;
use App\Models\Users;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Validator;


class UserController extends Controller
{
    public function index() {
        $users = Users::all();
        $arr = [
        'status' => true,
        'message' => "Danh sách tài khoản user",
        'data'=>UserResource::collection($users)
        ];
        return response()->json($arr, 200);
    }

    public function store(Request $request) {
        $input = $request->all(); 
        $validator = Validator::make($input, [
          'userName' => 'required',
          'email' => 'required',
          'password' =>'required',
          'name' => 'required',
          'phone' =>'required'
        ]);
        if($validator->fails()){
           $arr = [
             'success' => false,
             'message' => 'Lỗi kiểm tra dữ liệu',
             'data' => $validator->errors()
           ];
           return response()->json($arr, 200);
        }
        $users = Users::create($input);
        $arr = ['status' => true,
           'message'=>"Tai khoan đã lưu thành công",
           'data'=> new UserResource($users)
        ];
        return response()->json($arr, 201);
       }

       public function show($id) {
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
          'data'=> new UserResource($users)
        ];
        return response()->json($arr, 201);
       }
       
       public function update(Request $request, Users $users){
        $input = $request->all();
        $validator = Validator::make($input, [
            'userName' => 'required',
            'email' => 'required',
            'password' =>'required',
            'name' => 'required',
            'phone' =>'required'
        ]);
        if($validator->fails()){
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
      public function destroy(Users $users){
        $users->delete();
        $arr = [
           'status' => true,
           'message' =>'Sản phẩm đã được xóa',
           'data' => [],
        ];
        return response()->json($arr, 200);
     }
}
