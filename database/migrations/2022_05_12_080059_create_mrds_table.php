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
        Schema::create('mrds', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no')->nullable();
            $table->string('mr_no')->nullable();
            $table->string('department')->nullable();
            $table->string('photo_category')->nullable();
            $table->string('tags')->nullable();
            $table->string('ipd_registration_id')->nullable();
            $table->string('opd_registration_id')->nullable();
            $table->string('daycare_registration_id')->nullable();
            $table->string('photo')->nullable();
            $table->string('notes')->nullable();
            $table->boolean('verified')->nullable();
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
        Schema::dropIfExists('mrds');
    }
};
