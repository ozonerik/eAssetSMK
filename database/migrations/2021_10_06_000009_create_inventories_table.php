<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('no');
            $table->string('qrcode');
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('purchase_date')->nullable();
            $table->float('purchase_price',10,2)->default('0');
            $table->smallInteger('good_qty')->default('0');
            $table->smallInteger('med_qty')->default('0');
            $table->smallInteger('bad_qty')->default('0');
            $table->smallInteger('lose_qty')->default('0');
            $table->string('picture')->nullable();
            $table->string('qrpicture')->nullable();
            $table->timestamps();
            $table->foreignId('budgeting_id')->nullable()->constrained();
            $table->foreignId('fiscalyear_id')->nullable()->constrained();
            $table->foreignId('itemtype_id')->nullable()->constrained();
            $table->foreignId('storage_id')->nullable()->constrained();
            $table->foreignId('organitation_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
