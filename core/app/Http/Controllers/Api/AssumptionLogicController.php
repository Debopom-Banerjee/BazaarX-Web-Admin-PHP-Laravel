<?php
/**
 * Class AssumptionLogicController
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
use App\Models\AssumptionLogic;

class AssumptionLogicController extends Controller
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

            $assumption_logics = AssumptionLogic::query();

            $assumption_logics = $assumption_logics->limit($limit)->offset(($page - 1) * $limit)->get();

            return $this->success($assumption_logics);
        } catch(\Exception $e){
            return $this->error("Error: " . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
                
            $this->validate($request, [
                                'scenerio'     => 'required',
                                'expectancy'     => 'required',
                                'low_limit'     => 'required',
                                'high_limit'     => 'required',
                                'year'     => 'required',
                            ]);
                         
            $assumption_logic = AssumptionLogic::create($request->all());

            if($assumption_logic){
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
    * @param  AssumptionLogic $assumption_logic
    * @return  \Illuminate\Http\JsonResponse
    */
    public function show(AssumptionLogic $assumption_logic)
    {
        try{
            return $this->success($assumption_logic);
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
     public function update(Request $request, AssumptionLogic $assumption_logic)
    {
        try{
                
            $this->validate($request, [
                                'scenerio'     => 'required',
                                'expectancy'     => 'required',
                                'low_limit'     => 'required',
                                'high_limit'     => 'required',
                                'year'     => 'required',
                            ]);
        
                 
            $assumption_logic = $assumption_logic->update($request->all());

            return $this->success($assumption_logic, 201);
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
            $assumption_logic = AssumptionLogic::findOrFail($id);
                                   
             $assumption_logic->delete();
 
             return $this->successMessage("AssumptionLogic deleted successfully!");
         } catch(\Exception $e){
             return $this->error("Error: " . $e->getMessage());
         }
     }
    
}
