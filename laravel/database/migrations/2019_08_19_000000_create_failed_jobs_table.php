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
//    public function up()
//    {
//        Schema::create('failed_jobs', function (Blueprint $table) {
//            $table->id();
//            $table->string('uuid')->unique();
//            $table->text('connection');
//            $table->text('queue');
//            $table->longText('payload');
//            $table->longText('exception');
//            $table->timestamp('failed_at')->useCurrent();
//        });
//    }


    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('商品名');
            $table->unsignedInteger('price')->comment('値段');
            $table->string('scraping_class')->comment('スクレピング用クラス名');
            $table->string('scraping_url')->comment('スクレイピング先URL');
            $table->dateTime('scraped_at')->comment('スクレイピングした日時');
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
        Schema::dropIfExists('failed_jobs');
    }
};
