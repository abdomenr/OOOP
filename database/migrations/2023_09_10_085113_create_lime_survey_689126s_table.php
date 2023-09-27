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
    public function up()
    {
        Schema::create('lime_survey_689126', function (Blueprint $table) {
            $table->id();
            $table->string('token', 36)->nullable();
            $table->dateTime('submitdate')->nullable();
            $table->integer('lastpage')->nullable();
            $table->string('startlanguage', 20);
            $table->string('seed', 31)->nullable();
            $table->string('689126X1X1', 5)->nullable();
            $table->string('689126X1X2', 5)->nullable();
            $table->text('689126X1X3')->nullable();
            $table->text('689126X1X4')->nullable();
            $table->date('survey_sent_date')->nullable();
            $table->enum('survey_submitted_status', ['Yes', 'No', 'Partial'])->nullable();
            $table->string('whatsapp_number', 20)->nullable();
            $table->string('chat_id', 50)->nullable();
            $table->string('customer_name', 100)->nullable();
            $table->date('chat_start_datetime')->nullable();
            $table->text('service_inquiries')->nullable();
            $table->string('agent_id', 50)->nullable();
            $table->string('agent_name', 100)->nullable();
            $table->string('Served_By', 100)->nullable();
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

        Schema::dropIfExists('lime_survey_689126');
    }
};
