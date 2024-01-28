<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemtypes', function (Blueprint $table) {
            $table->id();
            $table->string('code',3);
            $table->string('shortname');
            $table->string('typename');
            $table->timestamps();
            $table->foreignId('organitation_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');;
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemtypes');
    }
}
