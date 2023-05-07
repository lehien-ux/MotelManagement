<?php

namespace App\Http\Controllers\Customer;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::where('status', Constant::ROOM_FREE)->with('images')->take(6)->get();

        return view('customer.home')->with([
            'rooms' => $rooms
        ]);
    }
}