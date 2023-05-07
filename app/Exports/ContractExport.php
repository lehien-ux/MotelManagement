<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContractExport implements FromView
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('admin.contracts.export')->with([
            'contract' => Contract::where('id', $this->id)->with('customer', 'room')->first()
        ]);
    }
}
