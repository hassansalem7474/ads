<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->boolean('type');   // [0 => free , 1 => paid] 
            $table->string('title');
            $table->string('description');
            $table->date('start_date');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('advertiser_id')->constrained('advertisers')->onDelete('cascade');
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
        Schema::dropIfExists('ads');
    }
}