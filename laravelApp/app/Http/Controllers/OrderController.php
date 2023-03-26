<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Validator;
class OrderController extends Controller
{

    public function index()
    {
        $order = Order::all();
        $arr = [
            'status' => true,
            'message' => "Danh sách tuyến",
            'data' => OrderResource::collection($order)
        ];
        return response()->json($arr, 200);
    }
    public function store(Request $request) {
        $input = $request->all(); 
        $order = Order::create($input);
        $arr = ['status' => true,
           'message'=>"Tai khoan đã lưu thành công",
           'data'=> new OrderResource($order)
        ];
        return response()->json($arr, 201);
       }

       public function show($id) {
        $order = Order::find($id);
        if (is_null($order)) {
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
          'data'=> new OrderResource($order)
        ];
        return response()->json($arr, 201);
       }
       


      public function update(Request $request, $_id)
      {
          $order = Order::find($_id);
          if (!$order) {
              $error = ['message' => 'Không tìm thấy id cần xóa'];
              return response()->json($error);
          }
          $input = $request->all();
          $validator = Validator::make($input, [
            'userId' => 'required',
            'routeId' => 'required',
            // 'seatsId' =>'required',
            'status' => 'required',
            'paymentInfo' =>'required',
            'promoteId' =>'required',
          ]);
          if ($validator->fails()) {
              $arr = [
                  'success' => false,
                  'message' => 'Lỗi kiểm tra dữ liệu',
                  'data' => $validator->errors()
              ];
              return response()->json($arr, 200);
          }
  
          $order->userId = $input['userId'];
          $order->routeId = $input['routeId'];
          $order->seatsId = $input['seatsId'];
          $order->status = $input['status'];
          $order->paymentInfo = $input['paymentInfo'];
          $order->promoteId = $input['promoteId'];
          $order->save();
          $arr = [
              'status' => true,
              'message' => 'cập nhật thành công',
              'data' => new OrderResource($order)
          ];
          return response()->json($arr, 200);
      }
     public function destroy($_id){
      $order = Order::find($_id);
      if ($order) {
         $order->delete();
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
