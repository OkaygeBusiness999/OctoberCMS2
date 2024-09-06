<?php namespace AppUser\User\Updates;

use October\Rain\Database\Updates\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArrivalTimeToLogsTable extends Migration
{
    public function up()
    {
        Schema::table('appuser_user_logs', function (Blueprint $table) {
            $table->time('arrival_time')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('appuser_user_logs', function (Blueprint $table) {
            $table->dropColumn('arrival_time');
        });
    }
}
