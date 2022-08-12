<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('discount');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('minimum_price', 12, 2, true)->nullable()->default(0);
            $table->float('maximum_discount', 12, 2, true)->nullable();
            $table->integer('maximum_uses')->nullable();
            $table->integer('used')->nullable()->default(0);
            $table->boolean('type');
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
        Schema::dropIfExists('promotions');
    }
};
