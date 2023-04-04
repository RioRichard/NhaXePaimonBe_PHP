<?php

namespace App\Http\Controllers;

use App\Models\Seat;
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
    $data = [
      'buses' => BusResource::collection($bus)
    ];
    $arr = [
      'status' => true,
      'message' => "Danh sách xe",
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
    echo $input['bus_number'];
    $bus = Bus::create($input);
    $numberSeats = $input['numberOfSeat'];
    // $busId = $bus->id;
    // $name = "name";
    // $param = array($busId,$name);
    for ($i = 0; $i < $numberSeats; $i++) {
      $seat = new Seat;
      $seat->busId = $bus->id;
      $seat->name = "Ghế ".$i+1;
      $seat->save();
    }
    echo $numberSeats;
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
    $data = [
      'buses' => new BusResource($bus)
    ];
    $arr = [
      'status' => true,
      'message' => "Chi tiết xe ",
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
    $bus = Bus::find($_id);
    if (!$bus) {
      $error = ['message' => 'Không tìm thấy id cần xóa'];
      return response()->json($error);
    }
    $input = $request->all();

    $bus->bus_number = $input['bus_number'];
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