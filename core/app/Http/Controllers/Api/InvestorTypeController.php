<?php
/**
 * Class InvestorTypeController
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
use App\Models\InvestorType;

class InvestorTypeController extends Controller
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

            $investor_types = InvestorType::query();

            $investor_types = $investor_types->limit($limit)->offset(($page - 1) * $limit)->get();

            return $this->success($investor_types);
        } catch(\Exception $e){
            return $this->error("Error: " . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
                
            $this->validate($request, [
                                'category'     => 'required',
                                'score'     => 'required',
                            ]);
                      
            $investor_type = InvestorType::create($request->all());

            if($investor_type){
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
    * @param  InvestorType $investor_type
    * @return  \Illuminate\Http\JsonResponse
    */
    public function show(InvestorType $investor_type)
    {
        try{
            return $this->success($investor_type);
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
     public function update(Request $request, InvestorType $investor_type)
    {
        try{
                
            $this->validate($request, [
                                'category'     => 'required',
                                'score'     => 'required',
                            ]);
        
              
            $investor_type = $investor_type->update($request->all());

            return $this->success($investor_type, 201);
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
            $investor_type = InvestorType::findOrFail($id);
                             
             $investor_type->delete();
 
             return $this->successMessage("InvestorType deleted successfully!");
         } catch(\Exception $e){
             return $this->error("Error: " . $e->getMessage());
         }
     }
    
}
