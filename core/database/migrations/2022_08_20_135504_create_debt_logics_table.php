/**
 * Class DebtLogicsTable
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

class CreateDebtLogicsTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('debt_logics', function (Blueprint $table) {
            $table->id();
            $table->text('institutions')->comment('Institutions');                       
                 $table->text('type_of_bank')->comment('Type of Bank');                       
                 $table->text('rate')->comment('rate');                       
                 $table->text('period')->comment('Period');                       
                               
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
        Schema::dropIfExists('debt_logics');
    }
}
