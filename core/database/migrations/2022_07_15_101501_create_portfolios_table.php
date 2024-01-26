/**
 * Class PortfoliosTable
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

class CreatePortfoliosTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id')->comment('service_id');                       
                 $table->string('title')->comment('title');                       
                 $table->text('description')->nullable()->comment('description');   
                 $table->string('buy_link')->nullable()->comment('buy_link');   
                               
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
        Schema::dropIfExists('portfolios');
    }
}
