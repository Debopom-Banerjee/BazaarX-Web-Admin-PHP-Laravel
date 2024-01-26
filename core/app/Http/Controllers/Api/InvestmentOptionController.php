<?php
/**
 * Class InvestmentOptionController
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
use App\Models\InvestmentOption;

class InvestmentOptionController extends Controller
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

            $investment_options = InvestmentOption::query();

            $investment_options = $investment_options->limit($limit)->offset(($page - 1) * $limit)->get();

            return $this->success($investment_options);
        } catch(\Exception $e){
            return $this->error("Error: " . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
                
            $this->validate($request, [
                                'mutual_fund'     => 'required',
                                'allocation'     => 'required',
                                'scrip_name'     => 'required',
                                'tenure'     => 'required',
                                'type'     => 'required',
                            ]);
                         
            $investment_option = InvestmentOption::create($request->all());

            if($investment_option){
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
    * @param  InvestmentOption $investment_option
    * @return  \Illuminate\Http\JsonResponse
    */
    public function show(InvestmentOption $investment_option)
    {
        try{
            return $this->success($investment_option);
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
     public function update(Request $request, InvestmentOption $investment_option)
    {
        try{
                
            $this->validate($request, [
                                'mutual_fund'     => 'required',
                                'allocation'     => 'required',
                                'scrip_name'     => 'required',
                                'tenure'     => 'required',
                                'type'     => 'required',
                            ]);
        
                 
            $investment_option = $investment_option->update($request->all());

            return $this->success($investment_option, 201);
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
            $investment_option = InvestmentOption::findOrFail($id);
                                   
             $investment_option->delete();
 
             return $this->successMessage("InvestmentOption deleted successfully!");
         } catch(\Exception $e){
             return $this->error("Error: " . $e->getMessage());
         }
     }
    
}
