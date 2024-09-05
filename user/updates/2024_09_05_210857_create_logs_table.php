<?php namespace AppUser\User\Updates;

use October\Rain\Database\Updates\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('appuser_user_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('description');
            $table->boolean('has_delay')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appuser_user_logs');
    }
}
