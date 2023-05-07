<?php

namespace App\Console\Commands;

use App\Models\Contract;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContractCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Contract:Command';

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
        DB::beginTransaction();
        try {
            //update contract to used || change pending to use
            $isUpdate = Contract::where('status', 2)->where('start_date', Carbon::now()->format('Y-m-d'))->update(['status' => 1]);
            //update contract expired
            $contacts = Contract::where('status', 1)->where('end_date', Carbon::now()->format('Y-m-d'))->get();
            Log::info($isUpdate);
            Log::info($contacts);
            $contactIds = [];
            $roomIds = [];
            foreach ($contacts as $contact) {
                $roomIds[] = $contact->room_id;
                $contactIds[] = $contact->id;
            }
            Room::whereIn('id', $roomIds)->update(['status' => 0, 'is_transplant' => 0]);
            Contract::whereIn('id', $contactIds)->update(['status' => 0]);
            DB::table('customer_rooms')->whereIn('room_id', $roomIds)->delete();

            DB::commit();

            Log::info("update contract success");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }
}
