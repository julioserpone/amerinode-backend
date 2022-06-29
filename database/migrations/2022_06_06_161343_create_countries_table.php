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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('capital', 100)->nullable();
            $table->string('code_iso', 2)->nullable()->comment('iso_3166_1_alpha2');
            $table->string('code_iso3', 3)->nullable()->comment('iso_3166_1_alpha3');
            $table->string('currency', 3)->nullable()->comment('iso_4217_code');
            $table->string('calling_code', 3)->nullable();
            $table->string('flag_url', 80)->nullable();
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
        Schema::dropIfExists('countries');
    }
};
