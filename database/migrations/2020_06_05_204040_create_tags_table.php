<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('frequency');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('novels_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novels_id')->unsigned()->default(0);
            $table->integer('tags_id')->unsigned()->default(0);
            $table->unique(['novels_id', 'tags_id']);
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
        Schema::dropIfExists('tags');
        Schema::dropIfExists('novels_tags');
    }
}
