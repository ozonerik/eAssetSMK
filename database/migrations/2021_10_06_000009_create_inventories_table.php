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
            $table->float('purchase_price',20,2)->nullable()->default('0');
            $table->string('unit')->nullable();
            $table->smallInteger('good_qty')->default('0');
            $table->smallInteger('med_qty')->default('0');
            $table->smallInteger('bad_qty')->default('0');
            $table->smallInteger('lost_qty')->default('0');
            $table->string('picture')->nullable();
            $table->string('qrpicture')->nullable();
            $table->string('qrcheck')->nullable();
            $table->timestamps();
            $table->foreignId('budgeting_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');;
            $table->foreignId('fiscalyear_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');;
            $table->foreignId('itemtype_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');;
            $table->foreignId('storeroom_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');;
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
        Schema::dropIfExists('inventories');
    }
}
