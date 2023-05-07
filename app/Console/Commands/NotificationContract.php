<?php

namespace App\Console\Commands;

use App\Enums\Constant;
use App\Models\Contract;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notification:Contract';

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
            $expired = Carbon::now()->addMonth()->format('Y-m-d');
            $contracts = Contract::where('end_date', $expired)
                ->where('status', Constant::CONTRACT_ACTIVE)->get();
            $customerIds = [];
            foreach ($contracts as $contract) {
                $customerIds[] = $contract->customer_id;
            }
            $customers = Customer::whereIn('id', $customerIds)->get();
            foreach ($customers as $customer) {
                foreach ($contracts as $contract) {
                    if ($contract->customer_id == $customer->id) {
                        Mail::to($customer->email)->send(new \App\Mail\NotificationContract($contract));
                    }
                }
            }

            Log::info("send success");
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
