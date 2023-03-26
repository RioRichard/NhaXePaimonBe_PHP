<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Bus;
use App\Http\Resources\BusResource;

class BusController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $bus = Bus::all();
    $arr = [
      'status' => true,
      'message' => "Danh sách xe",
      'data' => BusResource::collection($bus)
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
      'id' => 'required',
      'plates' => 'required',
      'type' => 'required',
    ]);
    if ($validator->fails()) {
      $arr = [
        'success' => false,
        'message' => 'Lỗi kiểm tra dữ liệu',
        'data' => $validator->errors()
      ];
      return response()->json($arr, 200);
    }
    $bus = Bus::create($input);
    $arr = [
      'status' => true,
      'message' => "Xe đã lưu thành công",
      'data' => new BusResource($bus)
    ];
    return response()->json($arr, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show($_id)
  {
    $bus = Bus::find($_id);
    if (is_null($bus)) {
      $arr = [
        'success' => false,
        'message' => 'Không có xe này',
        'dara' => []
      ];
      return response()->json($arr, 200);
    }
    $arr = [
      'status' => true,
      'message' => "Chi tiết xe ",
      'data' => new BusResource($bus)
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
    $bus = Bus::find($_id);
    if (!$bus) {
      $error = ['message' => 'Không tìm thấy id cần xóa'];
      return response()->json($error);
    }
    $input = $request->all();
    $validator = Validator::make($input, [
      'plates' => 'required',
      'type' => 'required',
    ]);
    if ($validator->fails()) {
      $arr = [
        'success' => false,
        'message' => 'Lỗi kiểm tra dữ liệu',
        'data' => $validator->errors()
      ];
      return response()->json($arr, 200);
    }

    $bus->plates = $input['plates'];
    $bus->type = $input['type'];
    $bus->save();
    $arr = [
      'status' => true,
      'message' => 'cập nhật thành công',
      'data' => new BusResource($bus)
    ];
    return response()->json($arr, 200);
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy($_id)
  {
    $bus = Bus::find($_id);
    if ($bus) {
      $bus->delete();
      $arr = [
        'status' => true,
        'message' => 'Xe đã được xóa',
        'data' => [],
      ];
      return response()->json($arr, 200);
    } else {
      $error = ['message' => 'Không tìm thấy id cần xóa'];
      return response()->json($error);
    }
  }
}