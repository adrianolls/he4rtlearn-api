<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('document_number',15)->nullable();
            $table->string('avatar')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_number')->nullable();
            $table->string('address_neighborhood')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_state')->nullable();
            $table->boolean('is_admin')->nullable()->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['email', 'is_admin', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
