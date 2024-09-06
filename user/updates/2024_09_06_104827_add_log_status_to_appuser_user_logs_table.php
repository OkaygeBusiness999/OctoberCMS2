<?php

use October\Rain\Database\Updates\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLogStatusToAppuserUserLogsTable extends Migration
{

    public function up()
    {
        Schema::table('appuser_user_logs', function (Blueprint $table) {
            $table->string('log_status')->default('on time');
        });
    }

    public function down()
    {
        Schema::table('appuser_user_logs', function (Blueprint $table) {
            $table->dropColumn('log_status');
        });
    }
}
