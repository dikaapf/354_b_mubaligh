<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('pengajars', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
$table->string('email');
$table->string('job_desc');
$table->string('google_id');
$table->integer('status_pengajar');

                $table->timestamps();
                $table->softDeletes();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pengajars');
    }

}
