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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_category_id')->constrained('main_categories');
            $table->foreignId('sub_category_id')->constrained('sub_categories');
            $table->string('name')->nullable(false);
            $table->string('details')->nullable(false);
            $table->integer('price')->nullable(false);
            $table->integer('amount')->nullable(false);
            $table->integer('discounts')->nullable(false);
            $table->string('photo')->nullable(false);
            $table->tinyInteger('active')->default(0);
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
        Schema::dropIfExists('products');
    }
};
