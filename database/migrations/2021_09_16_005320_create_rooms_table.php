<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image', 200);
            $table->unsignedBigInteger('category_id');
            $table->string('slug');
            $table->float('price');
            $table->float('sale_price')->nullable()->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('bed');
            $table->integer('bath');
            $table->integer('quantity');
            $table->float('area');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
