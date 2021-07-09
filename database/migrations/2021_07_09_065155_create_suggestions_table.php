<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contributor_id');
            $table->unsignedBigInteger('board_id');
            $table->string('title');
            $table->string('content');
            $table->string('status')->default('Awaiting approval');
            $table->boolean('is_pinned')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('last_voted_at')->useCurrent();

            $table->foreign('contributor_id')->references('id')->on('contributors');
            $table->foreign('board_id')->references('id')->on('boards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggestions');
    }
}
