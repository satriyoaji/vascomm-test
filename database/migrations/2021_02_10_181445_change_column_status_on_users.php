<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnStatusOnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'status'))
        {
            Schema::table('users', function (Blueprint $table)
            {
                $table->dropColumn('status');
            });
        }
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'status'))
        {
            Schema::table('users', function (Blueprint $table)
            {
                $table->dropColumn('status');
            });
        }
    }
}
