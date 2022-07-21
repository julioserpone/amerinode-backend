<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sla_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sla_id')->constrained('slas');
            $table->foreignId('severity_id')->constrained('severities');
            $table->float('time_response')->nullable();
            $table->foreignId('time_response_unit_id')->constrained('units');
            $table->float('time_recovery')->nullable();
            $table->foreignId('time_recovery_unit_id')->constrained('units');
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
        Schema::dropIfExists('sla_infos');
    }
};
