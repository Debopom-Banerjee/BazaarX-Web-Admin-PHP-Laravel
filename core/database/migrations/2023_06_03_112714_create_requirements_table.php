/**
 * Class RequirementsTable
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementsTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->comment('.');                       
            $table->bigInteger('user_id')->comment('.');                       
            $table->string('title')->comment('.');                       
            $table->bigInteger('category_id')->comment('.');                       
            $table->bigInteger('sub_category_id')->comment('.');                       
            $table->double('price')->comment('.');                       
            $table->longText('customer_info')->comment('.');                       
            $table->longText('location')->nullable()->comment('.');   
            $table->integer('status')->comment('Hot:0,Warm:1,Cold:2');                       
            $table->bigInteger('budget')->comment('.');                       
            $table->integer('type')->comment('Private:1,Public:0');                                          
            $table->timestamps();
            $table->softDeletes();
                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('requirements');
    }
}
