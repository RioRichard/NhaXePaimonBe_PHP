<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Manager;
use App\Http\Resources\ManagerResource;

class ManagerController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $manager = Manager::all();
      $arr = [
         'status' => true,
         'message' => "Danh sách tài khoản admin",
         'data' => ManagerResource::collection($manager)
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


         'userName' => 'required',

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
      $manager = Manager::create($input);
      $arr = [
         'status' => true,
         'message' => "Sản phẩm đã lưu thành công",
         'data' => new ManagerResource($manager)
      ];
      return response()->json($arr, 201);
   }

   /**
    * Display the specified resource.
    */
   public function show($_id)
   {
      $manager = Manager::find($_id);
      if (is_null($manager)) {
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
         'data' => new ManagerResource($manager)
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
   public function update(Request $request, Manager $manager)
   {
      $input = $request->all();
      $validator = Validator::make($input, [
         'id' => 'required',
         'userName' => 'required',
         'email' => 'required',
         'password' => 'required',
         'name' => 'required',
         'phone' => 'required',
         'role' => 'required',
      ]);
      if ($validator->fails()) {
         $arr = [
            'success' => false,
            'message' => 'Lỗi kiểm tra dữ liệu',
            'data' => $validator->errors()
         ];
         return response()->json($arr, 200);
      }
      $manager->id = $input['id'];
      $manager->userName = $input['userName'];
      $manager->email = $input['email'];
      $manager->password = $input['password'];
      $manager->name = $input['name'];
      $manager->phone = $input['phone'];
      $manager->role = $input['role'];

      $manager->save();
      $arr = [
         'status' => true,
         'message' => 'cập nhật thành công',
         'data' => new ManagerResource($manager)
      ];
      return response()->json($arr, 200);
   }
   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Manager $manager)
   {
      $manager->delete();
      $arr = [
         'status' => true,
         'message' => 'Sản phẩm đã được xóa',
         'data' => [],
      ];
      return response()->json($arr, 200);
   }
}