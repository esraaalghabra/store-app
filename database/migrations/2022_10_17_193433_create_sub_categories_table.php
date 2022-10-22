<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new
class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_category_id')->constrained('main_categories');
            $table->string('name')->nullable(false);
            $table->string('details')->nullable(false);
            $table->string('photo')->nullable(false);
            $table->tinyInteger('active')->default(0);
            $table->timestamps();
//            $table->biginteger('main_category_id');
//            $table->foreign('main_category_id')->references('id')->on('main_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
