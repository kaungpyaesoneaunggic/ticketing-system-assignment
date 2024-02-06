<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->unsignedBigInteger('signed_agent_id');
            $table->enum('status', ['open', 'closed','pending']);
            $table->timestamps();

            $table->foreign('signed_agent_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('category_tickets', function (Blueprint $table) {
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
        });

        Schema::table('label_ticket', function (Blueprint $table) {
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('label_ticket');
        Schema::dropIfExists('category_ticket');
        Schema::dropIfExists('tickets');
    }
}
