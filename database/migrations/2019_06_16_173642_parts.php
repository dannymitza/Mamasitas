<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SAP');
            $table->string('Material')->unique();
            $table->string('Veneer');
            $table->string('carline');
            $table->integer('boxQuantity');
            $table->integer('palletQuantity');
            $table->integer('backupQuantity');
            $table->integer('prodStorageLoc');
            $table->integer('prodPlant');
            $table->integer('workplaceStorageLoc');
            $table->integer('costCenter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
