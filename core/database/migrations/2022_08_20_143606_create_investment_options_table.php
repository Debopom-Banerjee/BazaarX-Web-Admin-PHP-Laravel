/**
 * Class InvestmentOptionsTable
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

class CreateInvestmentOptionsTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('investment_options', function (Blueprint $table) {
            $table->id();
            $table->text('mutual_fund')->comment('mutual_fund');                       
                 $table->text('allocation')->comment('Allocation');                       
                 $table->text('scrip_name')->comment('Scrip Name');                       
                 $table->text('tenure')->comment('Tenure');                       
                 $table->text('type')->comment('type');                       
                               
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
        Schema::dropIfExists('investment_options');
    }
}
