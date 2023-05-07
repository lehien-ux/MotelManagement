
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer("room_id");
            $table->integer("customer_id");
            $table->string("deposited")->nullable();
            $table->string("description")->nullable();
            $table->date("start_date");
            $table->date("end_date");
            $table->tinyInteger('return_deposit')->nullable(); //check return deposit
            $table->tinyInteger("status")->default(2)->comment('1: still, 0: expired, 2: pending, 3: find');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
