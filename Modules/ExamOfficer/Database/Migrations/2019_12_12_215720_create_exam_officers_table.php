<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_officers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('coodinator_id')
            ->unsigned()
            ->nullable()
            ->foreign()
            ->references('id')
            ->on('coodinators')
            ->delete('restrict')
            ->update('cascade');
            $table->integer('lecturer_id')
            ->unsigned()
            ->nullable()
            ->foreign()
            ->references('id')
            ->on('lecturers')
            ->delete('restrict')
            ->update('cascade');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('real_pass')->nullable();
            $table->string('from');
            $table->string('to')->nullable();
            $table->integer('is_active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('exam_officers');
    }
}
