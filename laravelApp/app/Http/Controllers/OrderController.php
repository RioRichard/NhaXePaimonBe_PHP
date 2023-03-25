<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Validator;
class OrderController extends Controller
{
    public function index() {
        $order = Order::all();
        $arr = [
        'status' => true,
        'message' => "Danh sách tài khoản user",
        'data'=>OrderResource::collection($order)
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
       
       public function update(Request $request, Order $order){
        $input = $request->all();

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
      public function destroy(Order $order){
        $order->delete();
        $arr = [
           'status' => true,
           'message' =>'Sản phẩm đã được xóa',
           'data' => [],
        ];
        return response()->json($arr, 200);
     }
}
