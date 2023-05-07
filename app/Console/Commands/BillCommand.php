<?php

namespace App\Console\Commands;

use App\Enums\Constant;
use App\Mail\OverdueBill;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BillCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bill:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $expiredDate = Carbon::now()->subDays(Constant::OVERDUE_15_DAY)->format('Y-m-d');
            $overdueBills = Customer::with(['bills' => function ($q) use ($expiredDate) {
                $q->with('room')->whereRaw("date(created_at) = '$expiredDate'")
                    ->where('status', Constant::NOT_PAY);
            }])->get();

            if (count($overdueBills) > 0) {
                foreach ($overdueBills as $overdueBill) {
                    if ($overdueBill->bills) {
                        Mail::to($overdueBill->email)->queue(new OverdueBill($overdueBill));
                    }
                }
            }

            Log::info('Notification overdue bills success');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
