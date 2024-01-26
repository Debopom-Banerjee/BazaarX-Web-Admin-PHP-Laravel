/**
 * Class ServicesTable
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

class CreateServicesTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('title');                       
                 $table->longText('description')->nullable()->comment('desc');   
                 $table->string('banner')->nullable()->comment('banner');   
                 $table->boolean('is_publish')->default(1)->comment('0 for publish and 1 for unpublish');   
                 $table->integer('category_id')->comment('category_id');                       
                 $table->json('permission')->nullable()->comment('permission');   
                 $table->decimal('price')->comment('price');                       
                 $table->decimal('mrp')->nullable()->comment('mrp');   
                               
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
        Schema::dropIfExists('services');
    }
}
