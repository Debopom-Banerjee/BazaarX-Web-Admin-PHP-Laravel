<?php
/**
 * Class MedicalInsuranceLogicController
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalInsuranceLogic;

class MedicalInsuranceLogicController extends Controller
{
   
    private $resultLimit;

    public function __construct(){
        $this->resultLimit = 10;
    }


    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $page = $request->has('page') ? $request->get('page') : 1;
            $limit = $request->has('limit') ? $request->get('limit') : $this->resultLimit;

            $medical_insurance_logics = MedicalInsuranceLogic::query();

            $medical_insurance_logics = $medical_insurance_logics->limit($limit)->offset(($page - 1) * $limit)->get();

            return $this->success($medical_insurance_logics);
        } catch(\Exception $e){
            return $this->error("Error: " . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
                
            $this->validate($request, [
                                'family_income'     => 'required',
                                'insurance_amount'     => 'required',
                                'of_family_members'     => 'required',
                                'coverage_required_for_family'     => 'required',
                                'approx_premium'     => 'required',
                            ]);
                         
            $medical_insurance_logic = MedicalInsuranceLogic::create($request->all());

            if($medical_insurance_logic){
                return $this->success($article, 201);
            }else{
                return $this->error("Error: Record not Created!");
            }

        } catch(\Exception $e){
            return $this->error("Error: " . $e->getMessage());
        }
    }


    /**
    * Return single instance of the requested resource
    *
    * @param  MedicalInsuranceLogic $medical_insurance_logic
    * @return  \Illuminate\Http\JsonResponse
    */
    public function show(MedicalInsuranceLogic $medical_insurance_logic)
    {
        try{
            return $this->success($medical_insurance_logic);
        } catch(\Exception $e){
            return $this->error("Error: " . $e->getMessage());
        }
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
     public function update(Request $request, MedicalInsuranceLogic $medical_insurance_logic)
    {
        try{
                
            $this->validate($request, [
                                'family_income'     => 'required',
                                'insurance_amount'     => 'required',
                                'of_family_members'     => 'required',
                                'coverage_required_for_family'     => 'required',
                                'approx_premium'     => 'required',
                            ]);
        
                 
            $medical_insurance_logic = $medical_insurance_logic->update($request->all());

            return $this->success($medical_insurance_logic, 201);
        } catch(\Exception $e){
            return $this->error("Error: " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */    
     public function destroy($id)
     {
         try{
            $medical_insurance_logic = MedicalInsuranceLogic::findOrFail($id);
                                   
             $medical_insurance_logic->delete();
 
             return $this->successMessage("MedicalInsuranceLogic deleted successfully!");
         } catch(\Exception $e){
             return $this->error("Error: " . $e->getMessage());
         }
     }
    
}
