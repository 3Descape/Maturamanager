<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->string('slug')->unique();
            $table->text('markup');
            $table->text('html');
            $table->boolean('completed')->default(0);
            $table->string('thumbnail')->nullable();
            $table->boolean('visible')->default(0);
            $table->timestamps();
        });

        Schema::create('user_working_ticket', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('working_ticket_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('working_ticket_id')->references('id')->on('working_tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_tickets');
        Schema::dropIfExists('user_working_ticket');
    }
}
