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
        Schema::create('severities', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name', 50);
            $table->string('description', 100);
            $table->string('status')->default('active');
            $table->string('color', 7);
            $table->softDeletes();
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
        Schema::dropIfExists('severities');
    }
};
