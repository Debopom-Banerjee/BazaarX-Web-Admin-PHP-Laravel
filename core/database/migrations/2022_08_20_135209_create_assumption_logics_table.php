/**
 * Class AssumptionLogicsTable
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

class CreateAssumptionLogicsTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('assumption_logics', function (Blueprint $table) {
            $table->id();
            $table->text('scenerio')->comment('Scenerio');                       
                 $table->text('expectancy')->comment('Expectancy');                       
                 $table->text('low_limit')->comment('Low Limit');                       
                 $table->text('high_limit')->comment('High Limit');                       
                 $table->text('year')->comment('Year');                       
                               
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
        Schema::dropIfExists('assumption_logics');
    }
}
