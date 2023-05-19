<?php

namespace App\Http\Controllers;

use App\Enums\Constant;
use App\Exports\ContractExport;
use App\Models\Room;
use App\Models\Customer;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContractController extends Controller
{
    public function list(Request $request)
    {
        $request->flash();
        $rooms = Room::all();
        $contracts = Contract::with('room');

        if ($request->has('room_id') && $request->room_id) {
            $contracts->where('room_id', $request->room_id);
        }

        if ($request->has('customer') && $request->customer) {
            $contracts->with(['customer' => function ($q) use ($request) {
                $q->where('name', 'like', "%$request->customer%");
            }]);
        } else {
            $contracts->with('customer');
        }

//        if ($request->has('start_date') && $request->start_date) {
//            $contracts->where('start_date', '>=', $request->start_date);
//        }
//
//        if ($request->has('end_date') && $request->end_date) {
//            $contracts->where('end_date', '<=', $request->end_date);
//        }

        if ($request->has('status') && $request->status || $request->status == '0') {
            $contracts->where('status', $request->status);
        }

        return view('admin.contracts.list')->with([
            'contracts' => $contracts->orderBy('id', 'desc')->paginate(15)->appends(request()->query()),
            'rooms' => $rooms
        ]);
    }

    public function viewCreate()
    {
        return view('admin.contracts.create')->with([
            'rooms' => Room::where('status', 0)->get(),
            'customers' => Customer::all(),
            'services' => Service::all(),
        ]);
    }

    public function handleCreate(Request $request)
    {
        $checkContract = Contract::where('room_id', $request->room_id)
            ->where('status', '!=', Constant::CONTRACT_EXPIRED)
            ->first();
        if ($checkContract) {
            return redirect()->back()->with('message', 'Phòng này đã có 1 hợp đồng khác');
        }
        $startDay = strtotime(Carbon::parse($request->start_date));
        $endDay = strtotime(Carbon::parse($request->end_date));

        if ($endDay < $startDay) {
            return back()->with('message', 'Hạn ngày hợp đồng phải lớn hơn ngày bắt đầu');
        }

        if ($endDay - $startDay < Constant::MIN_DAY_OF_CONTRACT) {
            return back()->with('message', 'Hợp đồng không được nhỏ hơn 1 tháng');
        }

        if ($endDay < now()->timestamp) {
            return back()->with('message', 'Ngày hết hạn hợp đồng phải lớn hơn ngày hiện tại');
        }

        if (strtotime($request->start_date) <= strtotime(now()->format('Y-m-d'))) {
            $status = Constant::CONTRACT_ACTIVE;
        } else {
            $status = Constant::CONTRACT_PENDING;
        }

        $data = [
            'room_id' => $request->room_id,
            'customer_id' => $request->customer_id,
            'deposited' => $request->deposited,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $status
        ];

        DB::beginTransaction();
        try {
            $contract = Contract::create($data);
            if ($request->transplant) {
                Room::where('id', $request->room_id)->update(['status' => 1, 'is_transplant' => 1]);
            } else {
                Room::where('id', $request->room_id)->update(['status' => 1]);
            }

            DB::table('customer_rooms')->insert([
                'customer_id' => $request->customer_id,
                'room_id' => $request->room_id
            ]);

            $useService = [];
            foreach ($request->service_id as $service) {
                $useService[] = [
                    'service_id' => $service,
                    'contract_id' => $contract->id
                ];
            }
            DB::table('contract_services')->insert($useService);
            DB::commit();
            return redirect()->route('contracts.list')->with('message', 'Thêm hợp đồng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function destroy($id)
    {
        $contract = Contract::findOrFail($id);
        DB::beginTransaction();
        try {
            Room::where('id', $contract->room_id)->update(['status' => 0]);
            DB::table('contract_services')->where('contract_id', $contract->id)->delete();
            DB::table('customer_rooms')->where('room_id', $id)->delete();

            $contract->delete();

            DB::commit();
            return redirect()->route('contracts.list')->with('message', 'Xóa hợp đồng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function viewUpdate($id)
    {
        $contract = Contract::with(['room', 'customer', 'services'])->findOrFail($id);
        $useService = collect($contract->services)->mapWithKeys(function ($service) {
            return [$service->id => $service];
        });

        return view('admin.contracts.edit')->with([
            'contract' => $contract,
            'useService' => $useService,
            'rooms' => Room::where('status', 0)->get(),
            'customers' => Customer::all(),
            'services' => Service::all()
        ]);
    }

    public function update(Request $request, $id)
    {

        $startDay = strtotime(Carbon::parse($request->start_date));
        $endDay = strtotime(Carbon::parse($request->end_date));
        
        if ($endDay < $startDay) {
            return back()->withErrors(['message' => 'Hạn ngày hợp đồng phải lớn hơn ngày bắt đầu'])->withInput();
        }

        if ($endDay - $startDay < Constant::MIN_DAY_OF_CONTRACT) {
            return back()->withErrors(['message' => 'Hợp đồng không được nhỏ hơn 1 tháng'])->withInput();
        }

        if ($endDay < now()->timestamp) {
            return back()->withErrors(['message' => 'Ngày hết hạn hợp đồng phải lớn hơn ngày hiện tại'])->withInput();
        }

        if (strtotime($request->start_date) <= strtotime(now()->format('Y-m-d'))) {
            $status = Constant::CONTRACT_ACTIVE;
        } else {
            $status = Constant::CONTRACT_PENDING;
        }

        $data = [
            'room_id' => $request->room_id,
            'customer_id' => $request->customer_id,
            'deposited' => $request->deposited,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $status
        ];

        DB::beginTransaction();
        try {
            $contract = Contract::findOrFail($id);

            if ($contract->room_id != $data['room_id']) {
                Room::where('id', $data['room_id'])->update(['status' => 1]);   //update new room
                Room::where('id', $contract->room_id)->update(['status' => 0]); //update old room
            }

            $useService = [];
            foreach ($request->service_id as $service) {
                $useService[] = $service;
            }
            $contract->services()->sync($useService);

            $contract->update($data);

            DB::commit();
            return redirect()->route('contracts.list')->with('message', 'Cập nhật hợp đồng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function export($id)
    {
        return Excel::download(new ContractExport($id), 'HopDong.xlsx');
    }

    public function confirm($id)
    {
        $contract = Contract::find($id);

        if (strtotime($contract->start_date) > strtotime(Carbon::now())) {
            $contract->status = Constant::CONTRACT_PENDING;
        } else {
            $contract->status = Constant::CONTRACT_ACTIVE;
        }

        $contract->save();

        return redirect()->route('contracts.list')->with('message', 'Cập nhật hợp đồng thành công');
    }

    public function returnList()
    {
        $contracts = Contract::where('return_room', 1)->with('customer', 'room')->paginate(10);

        return view('admin.contracts.returnRoom')->with([
            'contracts' => $contracts
        ]);
    }

    public function confirmReturnRoom($id)
    {
        DB::beginTransaction();
        try {
            $contract = Contract::where('id', $id)->first();
            Room::where('id', $contract->room_id)->update(['status' => Constant::ROOM_FREE]);
            DB::table('customer_rooms')->where('room_id', $id)->delete();

            $contract->status = Constant::CONTRACT_EXPIRED;
            $contract->return_room = 0;
            $contract->save();

            DB::commit();
            return redirect()->route('contracts.return')->with('message', 'Trả phòng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();

            abort(500);
        }
    }
}
