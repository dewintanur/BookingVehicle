<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['people', 'goods']);
            $table->boolean('is_company_owned');
            $table->float('fuel_consumption')->nullable(); // tambahkan konsumsi BBM
            $table->string('service_schedule')->nullable(); // tambahkan jadwal service
            $table->text('usage_history')->nullable(); // tambahkan riwayat pemakaian
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
