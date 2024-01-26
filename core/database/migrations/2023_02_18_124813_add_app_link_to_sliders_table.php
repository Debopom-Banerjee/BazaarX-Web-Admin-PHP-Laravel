<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppLinkToSlidersTable extends Migration
{
 
    // ALTER TABLE `sliders` ADD `app_link` VARCHAR(255) NULL DEFAULT NULL AFTER `link`;
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('app_link')->nullable()->after('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('app_link');
        });
    }
}
