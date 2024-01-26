/**
 * Class InvestorTypesTable
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

class CreateInvestorTypesTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('investor_types', function (Blueprint $table) {
            $table->id();
            $table->text('category')->comment('Category');                       
                 $table->text('score')->comment('Score');                       
                               
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
        Schema::dropIfExists('investor_types');
    }
}
