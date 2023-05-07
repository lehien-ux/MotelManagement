<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Images;
use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function addRoom()
    {
        return view("admin.room.add_room");
    }

    public function saveRoom(Request $request)
    {
        $requestData = $request->all();
        $request->validate([
            'number' => 'required|max:10|',
            'price' => 'required|max:15|',
            'size' => 'required|max:60|',
        ], [
            'number.required' => 'Vui lòng nhập số phòng Không quá 10 ký tự ',
            'price.required' => 'Vui lòng nhập giá phòng Không quá 15 ký tự',
            'size.required' => 'Vui lòng nhập kích thước phòng'
        ]);
        DB::beginTransaction();
        try {
            $room = new Room();
            $room->number = $requestData['number'];
            $room->price = $requestData['price'];
            $room->size = $requestData['size'];
            $room->description = $requestData['description'];
            $room->status = 0;
            $room->save();

            $images = $request->file('images');
            $insertImages = [];
            foreach ($images as $image) {
                $name = time() . Str::random(16) . '.' . $image->getClientOriginalExtension();
                $shit[] = $image->move('upload/images', $name);
                $insertImages[] = [
                    'path' => $name,
                    'room_id' => $room->id
                ];
            }
            Images::insert($insertImages);

            DB::commit();
            return redirect()->route('room.view')->with('message', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('room.view')->with('message', 'Thêm mới thất bại');
        }
    }

    public function getAllRoom(Request $request)
    {
        $request->flash();
        $list = Room::with('images');

        if ($request->has('number') && $request->number) {
            $list->where('number', 'like', "%$request->number%");
        }

        if ($request->has('start_price') && $request->start_price) {
            $list->where('price', '>=', $request->start_price);
        }

        if ($request->has('end_price') && $request->end_price) {
            $list->where('price', '<=', $request->end_price);
        }

        if ($request->has('status') && $request->status || $request->status == '0') {
            $list->where('status', $request->status);
        }

        $list->paginate(10);
        return view("admin.room.all_room", [
            'list' => $list->paginate(10)->appends(request()->query())
        ]);
    }

    ///

    public function getEditRoom(Request $request, $id)
    {
        $room = Room::with('images')->where('id', $id)->first();

        return view("admin.room.edit_room",)->with([
            'room' => $room
        ]);
    }

    public function UpdateRoom(Request $request, $id)
    {
        $requestData = $request->all();
        // dd($requestrequestData);
        $request->validate([
            'number' => 'required|max:10|',
            'price' => 'required|max:15|',
            'size' => 'required|max:60|',
        ], [
            'number.required' => 'Vui lòng nhập số phòng Không quá 10 ký tự ',
            'price.required' => 'Vui lòng nhập giá phòng Không quá 15 ký tự',
            'size.required' => 'Vui lòng nhập kích thước phòng',

        ]);
        try {
            $room = Room::find($id);
            $room->number = $requestData['number'];
            $room->price = $requestData['price'];
            $room->size = $requestData['size'];
            $room->description = $requestData['description'];
            $room->status = $requestData['status'];
            $room->save();

            $images = $request->file('images');
            $insertImages = [];
            foreach ($images as $image) {
                $name = time() . Str::random(16) . '.' . $image->getClientOriginalExtension();
                $shit[] = $image->move('upload/images', $name);
                $insertImages[] = [
                    'path' => $name,
                    'room_id' => $room->id
                ];
            }
            Images::insert($insertImages);

            DB::commit();
            return redirect()->route('room.view')->with('message', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('room.view')->with('message', 'Cập nhất thất bại');
        }
    }

    public function DeleteRoom($id)
    {
        Images::where('room_id', $id)->delete();
        Room::findOrFail($id)->delete();

        return redirect()->route('room.view')->with('message', 'Xóa thành công');
    }

    public function deleteRoomImage($id)
    {
        Images::findOrFail($id)->delete();

        return response("oke");
    }

    public function roomCustomer()
    {
        $rooms = Room::leftJoin('customer_rooms', 'customer_rooms.room_id', '=', 'rooms.id')
            ->leftJoin('customers', 'customer_rooms.customer_id', '=', 'customers.id')
            ->select('rooms.id', 'rooms.number', 'customers.name', 'customers.phone', 'customers.id as customer_id')
            ->orderBy('rooms.id')
            ->get();

        return view('admin.roomCustomer.list')->with([
            'rooms' => $rooms
        ]);
    }

    public function deleteRoomCustomer($room_id, $customer_id)
    {
        DB::table('customer_rooms')->where('room_id', $room_id)
            ->where('customer_id', $customer_id)
            ->delete();

        return redirect()->route('room.customer')->with('message', 'Xóa thành công');
    }

    public function createCustomerRoom()
    {
        return view('admin.roomCustomer.create')->with([
            'customers' => Customer::all(),
            'rooms' => Room::all()
        ]);
    }

    public function handleCreateCustomerRoom(Request $request)
    {
        DB::table('customer_rooms')->insert([
            'customer_id' => $request->customer_id,
            'room_id' =>$request->room_id
        ]);

        return redirect()->route('room.customer')->with('message', 'Thêm mới thành công');
    }
}
