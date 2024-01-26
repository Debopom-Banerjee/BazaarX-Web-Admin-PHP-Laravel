/**
 * Class MedicalInsuranceLogicsTable
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

class CreateMedicalInsuranceLogicsTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('medical_insurance_logics', function (Blueprint $table) {
            $table->id();
            $table->text('family_income')->comment('familyincome');                       
                 $table->text('insurance_amount')->comment('Insurance Amount');                       
                 $table->text('of_family_members')->comment('of_family_members');                       
                 $table->text('coverage_required_for_family')->comment('coverage_required_for_family');                       
                 $table->text('approx_premium')->comment('Approx Premium');                       
                               
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
        Schema::dropIfExists('medical_insurance_logics');
    }
}
