<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMenuAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_admin', function (Blueprint $table) {
            $table->boolean('status')->default(1)->comment('Status do menu, para mostrá-lo ou não no sistema');
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
        Schema::table('menu_admin', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });
    }
}
