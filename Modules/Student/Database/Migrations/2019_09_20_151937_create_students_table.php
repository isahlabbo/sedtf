<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('admission_id')
            ->unsigned()
            ->nullable()
            ->foreign()
            ->references('id')
            ->on('admissions')
            ->delete('restrict')
            ->update('cascade');
            $table->integer('application_id')
            ->unsigned()
            ->nullable()
            ->foreign()
            ->references('id')
            ->on('applications')
            ->delete('restrict')
            ->update('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('email');
            $table->string('user_name')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('real_pass')->nullable();
            $table->string('is_active')->default(1);
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
        Schema::dropIfExists('students');
    }
}
