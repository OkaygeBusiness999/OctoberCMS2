<?php namespace AppUser\User\Updates;

use October\Rain\Database\Updates\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('appuser_user_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appuser_user_users');
    }
}
