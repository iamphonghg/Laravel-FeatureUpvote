<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('suggestion_id');
            $table->unsignedBigInteger('contributor_id');
            $table->string('content');
            $table->string('status');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('suggestion_id')->references('id')->on('suggestions');
            $table->foreign('contributor_id')->references('id')->on('contributors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
