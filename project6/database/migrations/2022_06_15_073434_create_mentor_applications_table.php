<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_applications', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->date('age');
            $table->text('education');
            $table->text('purpose');  
            $table->bigInteger('mentor_id')->unsigned();

            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');     
            
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
        Schema::dropIfExists('mentor_applications');
    }
}
