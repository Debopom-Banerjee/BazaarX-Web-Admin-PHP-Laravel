@extends('backend.layouts.empty') 
@section('title', 'User Advisory')
@section('content')
@php
/**
 * User Advisory 
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */
$user_detail = json_decode($advisory_record->user_detail);
$goals = json_decode($advisory_record->goals);
$bud_income = json_decode($advisory_record->budget);
$net_worth_assests = json_decode($advisory_record->assests);
$net_worth_liabilities = json_decode($advisory_record->liabilities);
$risk_assessment = json_decode($advisory_record->risk_assessment);
$budget_sources = ($bud_income->salary_source) + ($bud_income->other_source);
$annual_income = $budget_sources * 12;
$exp_monthly = ($bud_income->loan_expenses) + ($bud_income->insurance_expenses) + ($bud_income->tax) + ($bud_income->other_expenses);
$annual_exp = $exp_monthly * 12;
$saving_monthly = $budget_sources - $exp_monthly;
$annual_saving = $saving_monthly * 12;
$debt_income_ratio = (($bud_income->loan_expenses) / ((($bud_income->salary_source + $bud_income->other_source) - $bud_income->tax)))*100;
$exp_percent = ($annual_exp / $annual_income)*100;
$saving_ratio_actual = round(100-$exp_percent);
$net_worth_equity = ($net_worth_assests->assets_amount) - ($net_worth_liabilities->personal_loan_amount);
$fixed_assets_amount = (($net_worth_assests->assets_amount) + ($net_worth_assests->stock_amount) + ($net_worth_assests->debet_instrument_amount) + ($net_worth_assests->precious_amount));
$fixed_assets_loan_amount = ($net_worth_liabilities->personal_loan_amount) + 0 + 0 + 0;
$fixed_assets_net_worth_amount = ($net_worth_equity) + (($net_worth_liabilities->short_loan_amount) - 0) + (($net_worth_assests->debet_instrument_amount) - 0) + (($net_worth_assests->precious_amount) - 0);
$net_worth_short_term_amount =  ($net_worth_assests->other_liablities_amount) - ($net_worth_liabilities->short_loan_amount);
$assumption = App\Models\AssumptionLogic::whereId(4)->first();
$assumption_advised = App\Models\AssumptionLogic::whereId(1)->first();
$assumption_alternative_investment_advised = App\Models\AssumptionLogic::whereId(13)->first();
$assumption_debt_expected_return = App\Models\AssumptionLogic::whereId(8)->first();
$assumption_house_assets_expected_return = App\Models\AssumptionLogic::whereId(6)->first();
$assumption_enquity_expected_return = App\Models\AssumptionLogic::whereId(10)->first();
$assumption_alternative_investment_expected_return = App\Models\AssumptionLogic::whereId(12)->first();
$assumption_cash_and_surplus_expected_return = App\Models\AssumptionLogic::whereId(8)->first();
$assumption_real_estate = App\Models\AssumptionLogic::whereId(9)->first();
$assumption_current_living_expenses = App\Models\AssumptionLogic::whereId(11)->first();
$assumption_debt_old_portfolio1 = App\Models\AssumptionLogic::whereId(2)->first();
$debt_logics = App\Models\DebtLogic::get();
$alternative_investments = App\Models\InvestmentOption::whereType('Alternative')->get();
$enquity_investments = App\Models\InvestmentOption::whereType('Equity')->get();
$medical_insurance_amount = App\Models\MedicalInsuranceLogic::whereId(2)->first();

$assumption_expectancy = $assumption->expectancy;
$net_worth_surplus_asset = (($annual_saving) * str_replace('%', '', $assumption_expectancy))/100;
$net_worth_current_asset = ($net_worth_assests->other_liablities_amount) + ($net_worth_surplus_asset);
$net_worth_current_equity = ($net_worth_current_asset) - ($net_worth_liabilities->short_loan_amount + 0);
$net_worth_total_assets = ($fixed_assets_amount) + ($net_worth_current_asset);
$net_worth_total_liability = (($net_worth_liabilities->short_loan_amount + 0)) + ($fixed_assets_loan_amount);
$net_worth_total_assets_enquity = ($net_worth_total_assets) - ($net_worth_total_liability);
$net_worth_current_liability = $net_worth_liabilities->short_loan_amount + 0;
$fin_ratio_debt_analysis = (($net_worth_total_liability) / (ABS($net_worth_total_assets_enquity))) * 100;
$fin_ratio_actual_liquidity_ratio = (($net_worth_current_equity) / ($exp_monthly)) * 100;
$risk_life_insurance_optimum_coverage = (((max(10 * ($annual_income) , 20 * ($annual_exp))) - ($net_worth_total_assets_enquity)) + ($net_worth_total_liability));
$risk_life_insurance_approx_premium = ($risk_life_insurance_optimum_coverage/30000) * (($user_detail->total_dependent)/($user_detail->no_dependents));
$asset_allocation_total_current_balance = ($net_worth_assests->debet_instrument_amount) + ($net_worth_assests->assets_amount) + ($net_worth_assests->stock_amount) + ($net_worth_assests->precious_amount) + ($net_worth_current_asset);
$asset_allocation_debt_deposit_current = round((($net_worth_assests->debet_instrument_amount)/($asset_allocation_total_current_balance))*100,2);
$asset_allocation_house_assets_current = round((($net_worth_assests->assets_amount)/($asset_allocation_total_current_balance))*100,2);
$asset_allocation_enquity_current = round((($net_worth_assests->stock_amount)/($asset_allocation_total_current_balance))*100,2);
$asset_allocation_alternative_investment_current = round((($net_worth_assests->precious_amount)/($asset_allocation_total_current_balance))*100,2);
$asset_allocation_cash_and_surplush_current = round((($net_worth_current_asset)/($asset_allocation_total_current_balance))*100,2);
$asset_allocation_total_current_balance_in_percent = round(($asset_allocation_debt_deposit_current) + ($asset_allocation_house_assets_current) + ($asset_allocation_enquity_current) + ($asset_allocation_alternative_investment_current) + ($asset_allocation_cash_and_surplush_current));
$asset_allocation_debt_advised = min(round(($assumption_advised->expectancy)/100 * 80 ,2) , 70);

$asset_allocation_cash_and_surplus_advised = min((((($budget_sources * 2.5) - ($net_worth_assests->other_liablities_amount))/ ($net_worth_total_assets))*100 ) , 10);

$asset_allocation_assets_advised = min($asset_allocation_house_assets_current , 30);
$assumption_alternative_investment_advised_exp = str_replace('%','',$assumption_alternative_investment_advised->expectancy);
$asset_allocation_enquity_advised = max(((1 - ($asset_allocation_debt_advised/100) - (str_replace('%','',$assumption_alternative_investment_advised->expectancy)/100) - ($asset_allocation_cash_and_surplus_advised/100) - ($asset_allocation_assets_advised/100))*100),0);

$asset_allocation_total_advised = ($asset_allocation_debt_advised) + ($asset_allocation_assets_advised) +($asset_allocation_enquity_advised) + (str_replace('%','',$assumption_alternative_investment_advised->expectancy)) + ($asset_allocation_cash_and_surplus_advised);

// For show use round, For calc show without round
$asset_allocation_debt_advisable = round((($asset_allocation_debt_advised) * ($asset_allocation_total_current_balance))/100,2);

$asset_allocation_assets_advisable = round((($asset_allocation_assets_advised) * ($asset_allocation_total_current_balance))/100,2);

$asset_allocation_enquity_advisable = round((($asset_allocation_enquity_advised) * ($asset_allocation_total_current_balance))/100,2);

$asset_allocation_alternative_investment_advisable = round((str_replace('%','',$assumption_alternative_investment_advised->expectancy) * ($asset_allocation_total_current_balance))/100,2);
$asset_allocation_cash_and_surplus_advisable = round((($asset_allocation_cash_and_surplus_advised) * ($asset_allocation_total_current_balance))/100,2);

$asset_allocation_total_advisable = ($asset_allocation_debt_advisable) + ($asset_allocation_assets_advisable) + ($asset_allocation_enquity_advisable) + ($asset_allocation_alternative_investment_advisable) + ($asset_allocation_cash_and_surplus_advisable);

$asset_allocation_debt_old_portfolio = $net_worth_assests->debet_instrument_amount * pow(1 + str_replace('%','',$assumption_debt_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy)));
$asset_allocation_asset_old_portfolio = round($net_worth_assests->assets_amount * pow(1 + str_replace('%','',$assumption_house_assets_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy))),2);
$asset_allocation_enquity_old_portfolio = round($net_worth_assests->stock_amount * pow(1 + str_replace('%','',$assumption_enquity_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy))),2);
$asset_allocation_alternative_investment_old_portfolio = round($net_worth_assests->precious_amount * pow(1 + str_replace('%','',$assumption_alternative_investment_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy))),2);

$asset_allocation_cash_and_surplus_old_portfolio = round($net_worth_current_asset * pow(1 + str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy))),2);
$asset_allocation_total_old_portfolio = round(($asset_allocation_debt_old_portfolio) + ($asset_allocation_asset_old_portfolio) + ($asset_allocation_enquity_old_portfolio) + ($asset_allocation_alternative_investment_old_portfolio) + ($asset_allocation_cash_and_surplus_old_portfolio),2);

$asset_allocation_debt_advised_portfolio = $asset_allocation_debt_advisable * pow(1 + str_replace('%','',$assumption_debt_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy)));

$asset_allocation_asset_advised_portfolio = round($asset_allocation_enquity_advisable * pow(1 + str_replace('%','',$assumption_house_assets_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy))),2);

$asset_allocation_enquity_advised_portfolio = round($asset_allocation_enquity_advisable * pow(1 + str_replace('%','',$assumption_enquity_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy))),2);

$asset_allocation_alternative_investment_advised_portfolio = round($asset_allocation_alternative_investment_advisable * pow(1 + str_replace('%','',$assumption_alternative_investment_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy))),2);

$asset_allocation_cash_and_surplus_advised_portfolio = round($asset_allocation_cash_and_surplus_advisable * pow(1 + str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy)/100 ,(($assumption_debt_old_portfolio1->expectancy) - ($assumption_advised->expectancy))),2);

$asset_allocation_total_advised_portfolio = round(($asset_allocation_debt_advised_portfolio) + ($asset_allocation_asset_advised_portfolio) + ($asset_allocation_enquity_advised_portfolio) + ($asset_allocation_alternative_investment_advised_portfolio) + ($asset_allocation_cash_and_surplus_advised_portfolio),2);
$goals_vacation_savings_per_month =
  (($goals->vacation) * (str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy)/100 + 2/100)* pow(1 + (str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy)/100 + 2/100),($goals->vacation_years - date("Y"))) / (pow(1 + (str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy)/100 + 2/100),($goals->vacation_years - date("Y"))) - 1));

$goals_collage_education1_savings_per_month = (($goals->collage_education1)* (str_replace('%','',$assumption_real_estate->expectancy)/100 + 2/100)* pow(1 + (str_replace('%','',$assumption_real_estate->expectancy)/100 + 2/100),($goals->collage_education_year1 - date("Y"))) / (pow(1 + (str_replace('%','',$assumption_real_estate->expectancy)/100 + 2/100),($goals->collage_education_year1 - date("Y"))) - 1));

$goals_collage_education2_savings_per_month = (($goals->collage_education2)* (str_replace('%','',$assumption_enquity_expected_return->expectancy)/100 + 2/100)* pow(1 + (str_replace('%','',$assumption_enquity_expected_return->expectancy)/100 + 2/100),($goals->collage_education_year2 - date("Y"))) / (pow(1 + (str_replace('%','',$assumption_enquity_expected_return->expectancy)/100 + 2/100),($goals->collage_education_year2 - date("Y"))) - 1));

$goals_house_property_savings_per_month = (($goals->house_property)* (str_replace('%','',$assumption_current_living_expenses->expectancy)/100 + 2/100)* pow(1 + (str_replace('%','',$assumption_current_living_expenses->expectancy)/100 + 2/100),($goals->house_property_year - date("Y"))) / (pow(1 + (str_replace('%','',$assumption_current_living_expenses->expectancy)/100 + 2/100),($goals->house_property_year - date("Y"))) - 1));

$goals_retirement_savings_per_month = (($goals->retirement)* (str_replace('%','',$assumption_current_living_expenses->expectancy)/100 + 2/100)* pow(1 + (str_replace('%','',$assumption_current_living_expenses->expectancy)/100 + 2/100),($goals->retirement_year - date("Y"))) / (pow(1 + (str_replace('%','',$assumption_current_living_expenses->expectancy)/100 + 2/100),($goals->retirement_year - date("Y"))) - 1));

$asset_allocation_total_expected_return = ((((round($asset_allocation_debt_advisable) * (1 + (str_replace('%','',$assumption_debt_expected_return->expectancy))/100)) + (($asset_allocation_enquity_advisable) * (1 + (str_replace('%','',$assumption_enquity_expected_return->expectancy))/100)) + (($asset_allocation_alternative_investment_advisable) * (1 + (str_replace('%','',$assumption_alternative_investment_expected_return->expectancy))/100)) + (($asset_allocation_cash_and_surplus_advisable) * (1 + (str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy))/100)) +(($asset_allocation_assets_advisable) * (1 + (str_replace('%','',$assumption_house_assets_expected_return->expectancy))/100))) / ($asset_allocation_total_advisable)) - 1) *100;

$goals_vacation_savings_per_month = (($goals->vacation)* (str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy)/100 + 2/100)* (pow(1 + (str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy)/100 + 2/100),($goals->vacation_years - date("Y")))) / (pow(1 + (str_replace('%','',$assumption_cash_and_surplus_expected_return->expectancy)/100 + 2/100),($goals->vacation_years - date("Y")))-1) );

@endphp
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('backend/plugins/chartist/dist/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
<style>
  .error{
    color:red;
      }
        .parentForm:not(:first-of-type) {
            display: none
      }
        table {
        table-layout: fixed;
        width: 100%;
      }
      @media(max-width:700px){
        table.table-responsives {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
          }
          
        }
        #ChartContainer div{
          height: 400px !important;
        }
        #assetCurrentAllocation div{
          height: 400px !important;
        }
        #assetAdvisedAllocation div{
          height: 400px !important;
        }
        .anychart-credits a{
            display: none;
        }
        .canvasjs-chart-canvas{
          width: 100% !important;
          height: 380px;
          position: absolute;
          user-select: none;
        }
        </style>
    @endpush

    <div class="container-fluid ">
      <div class="page-header">
        <div class="row align-items-end">
            <div class="col-12">
                <div class="page-header-title">
                    <i class="ik ik-grid bg-blue"></i>
                    <div class="d-inline">
                        <h5>#ADVID {{getPrefixZeros($advisory_record->id)}}</h5>
                        <span>{{$user_detail->name}}</span>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mx-auto">
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <img src="{{asset('frontend/assets/images/advisory/planner.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    BUDGET PLANNER
                  </button>
                </h2>
              </div>
              <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <div class="row mt-3">
                    <div class="col-lg-4 col-12">
                      <div class="card-block">
                        <div id="ChartContainer" style="width: 100%; height: 100%"></div>
                      </div>
                    </div>
                    <div class="col-lg-8 col-12">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Items</th>
                            <th>Monthly</th>
                            <th>Annual</th>
                            <th>% of total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Total Income</td>
                            <td>{{format_price($budget_sources)}}</td>
                            <td>{{format_price($annual_income)}}</td>
                            <td>100%</td>
                          </tr>
                          <tr>
                            <td>Total Expenses</td>
                            {{-- @dd($bud_income) --}}
                            <td>{{format_price($exp_monthly)}}</td>
                            <td>{{format_price($annual_exp)}}</td>
                            <td>{{round($exp_percent)}}%</td>
                          </tr>
                          <tr>
                            <td>Total Savings</td>
                            <td>{{format_price($saving_monthly)}}</td>
                            <td>{{format_price($annual_saving)}}</td>
                            <td>{{round(100-$exp_percent)}}%</td>
                          </tr>
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <img src="{{asset('frontend/assets/images/advisory/fin-ratio.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    FIN-RATIO ADVISORY
                  </button>
                </h2>
              </div>

              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                 <div class="row mt-3">
                  <div class="col-lg-4 col-12">
                    <div id="barContainer" style="height: 380px; width: 100%;"></div>
                  </div>
                  <div class="col-lg-8 col-12">
                    <table class="table table-striped table-responsives">
                      <thead>
                        <tr>
                          <th>Ratio</th>
                          <th>Actual </th>
                          <th>Advisable</th>
                          <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Debt to Income ratio</td>
                          <td>{{round($debt_income_ratio)}}%</td>
                          <td>40% </td>
                          <td>The ratio implies that you have only INR 100 of assets for every INR {{round($debt_income_ratio),2 * 100/100}} of liability</td>
                        </tr>
                        <tr>
                          <td>Saving Ratio</td>
                          <td>{{$saving_ratio_actual}}%</td>
                          <td>20% </td>
                          <td>
                            @if($saving_ratio_actual > 20)
                              Your saving ratios is good.You will have enough surplus to manage your goals
                            @else
                              Your saving ratio is not up to mark.You must reduce some your unwanted expenses to increase this ratio.It is not only necessary to meet your short term emergency needs as well as long term goals
                            @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                 </div>
                </div>
              </div>
            </div>
            
            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    <img src="{{asset('frontend/assets/images/advisory/net-wroth.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    NET WORTH ANALYSIS
                  </button>
                </h2>
              </div>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <div class="row mt-3">
                    <div class="col-lg-4 col-12">
                      <div id="netWorthAnalysis" style="width: 100%; height: 400px"></div> 
                    </div>
                    <div class="col-lg-8 col-12">
                      <table class="table table-striped table-responsives">
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th>Asset</th>
                            <th>Liability </th>
                            <th>Net-Worth (Equity)</th>
                          </tr>
                        </thead>
                        {{-- @dd($net_worth_assests->assests) --}}
                        <tbody>
                          <tr>
                            <td>
                              <ul class="list-unstyled">
                                @foreach($net_worth_assests->assests as $item)
                                  <li>{{$item}}</li>
                                @endforeach
    
                              </ul>
                            </td>
                            <td>{{format_price($net_worth_assests->assets_amount ?? '')}}</td>
                            <td>
                              <ul class="list-unstyled">
                                @foreach ($net_worth_liabilities->personal_loan as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                                - {{format_price($net_worth_liabilities->personal_loan_amount)}}</td>
                              </ul>
                            <td> {{format_price($net_worth_equity)}} </td>
                          </tr>
                          <tr>
                            <td>
                              <ul class="list-unstyled">
                                @foreach ($net_worth_assests->stock as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                              </ul>
                            </td>
                            <td>{{format_price($net_worth_assests->stock_amount)}} </td>
                            <td>
                              <ul class="list-unstyled">
                                @foreach ($net_worth_liabilities->short_loan as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                                -
                              </ul>
                               </td>
                            <td>{{format_price(($net_worth_liabilities->short_loan_amount) - 0)}}</td>
                          </tr>
                          <tr>
                            <td>
                              <ul class="list-unstyled">
                                @foreach ($net_worth_assests->debet_instrument as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                              </ul>
                            </td>
                            <td>{{format_price($net_worth_assests->debet_instrument_amount)}}</td>
                            <td>0 - </td>
                            <td>{{format_price(($net_worth_assests->debet_instrument_amount) - 0)}}</td>
                          </tr>
                          <tr>
                            <td>
                              <ul class="list-unstyled">
                                @foreach ($net_worth_assests->precious as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                              </ul>
                            </td>
                            <td>{{format_price($net_worth_assests->precious_amount)}}</td>
                            <td> - , -</td>
                            <td> {{format_price(($net_worth_assests->precious_amount) - 0)}}</td>
                          </tr>
                          <tr>
                            <td><strong>Fixed Assets</strong></td>
                            <td>  <strong>{{format_price($fixed_assets_amount)}}</strong> </td>
                            <td><strong> LT Liab -  {{format_price($fixed_assets_loan_amount)}}</strong> </td>
                            <td><strong>{{format_price($fixed_assets_net_worth_amount)}}</strong> </td>
                          </tr>
                          <tr>
                            <td>
                              <ul class="list-unstyled">
                                @foreach ($net_worth_assests->other_liablities as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                              </ul>
                            </td>
                            <td> {{format_price($net_worth_assests->other_liablities_amount)}} </td>
                            <td>
                              <ul class="list-unstyled">
                                @foreach ($net_worth_liabilities->short_loan as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                                - {{format_price($net_worth_liabilities->short_loan_amount)}}</td>
                              </ul>
                            <td> {{format_price($net_worth_short_term_amount)}}</td>
                          </tr>
                          <tr>
                            <td>Surplus</td>
                            <td> {{format_price($net_worth_surplus_asset)}} </td>
                            <td> - </td>
                            <td> {{format_price($net_worth_surplus_asset - 0)}} </td>
                          </tr>
                          <tr>
                            <td><strong>Current</strong></td>
                            <td> <strong>{{format_price($net_worth_current_asset)}}</strong> </td>
                            <td><strong>ST Liab - {{format_price($net_worth_liabilities->short_loan_amount + 0)}}</strong></td>
                            <td> <strong>{{format_price($net_worth_current_equity)}}</strong>  </td>
                          </tr>
                          <tr>
                            <td>Total Assets </td>
                            <td> {{format_price($net_worth_total_assets)}}</td> 
                            <td> Total Liability - {{format_price($net_worth_total_liability)}} </td>
                            <td>  {{format_price($net_worth_total_assets_enquity)}} </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            
            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button  class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    <img src="{{asset('frontend/assets/images/advisory/financial-ratio.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    FIN-RATIO ANALYSIS			
                  </button>
                </h2>
              </div>
              <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <div class="row mt-3">
                    <div class="col-lg-4 col-12">
                      <div id="finRatioAnalysis" style="width: 100%; height: 400px"></div> 
                    </div>
                    <div class="col-lg-8 col-12">
                      <table class="table table-striped table-responsives">
                        <thead>
                          <tr>
                            <th>Radio</th>
                            <th>Actual</th>
                            <th>Advisable </th>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Debt to Net Worth </td>
                            <td>{{round($fin_ratio_debt_analysis)}}% </td>
                            <td>100%</td>
                            <td>
                              @if(round($fin_ratio_debt_analysis) < 100)
                                Your debt is less than networth .It is a good sign from long term point of view 
                              @else
                                The ratio implies that there is potentially negative impacton you cash flow because of the servicing of your liabilities.It will 
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td>Liquidity Ratios</td>
                            <td>{{round($fin_ratio_actual_liquidity_ratio)}}%</td>
                            <td>300% </td>
                            <td> 
                              @if(round($fin_ratio_actual_liquidity_ratio) < 300)
                                Your current liquidity condition is critical. Ideally it should bearound 3. You should consider it a high priority to create anemergency fund.
                              @else
                                Your liquidity ratio is in control.It shows you can manage your emergency needs quite well 
                              @endif
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                    <img src="{{asset('frontend/assets/images/advisory/risk-management.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    RISK MANAGEMENT			
                  </button>
                </h2>
              </div>
              <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <table class="table table-striped table-responsives">
                    <thead>
                      <tr>
                        <th>Insurance</th>
                        <th>Optimum Coverage</th>
                        <th>Approx Premium</th>
                        <th>Current</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Life Insurance</td>
                        <td> {{format_price($risk_life_insurance_optimum_coverage)}} </td>
                        <td>{{format_price(round($risk_life_insurance_approx_premium))}} </td>
                        <td> {{format_price($bud_income->life_insurance_amount)}} </td>
                      </tr>
                      <tr>
                        <td>Medical Insurance</td>
                        <td>{{$medical_insurance_amount->coverage_required_for_family}} </td>
                        <td>{{format_price($medical_insurance_amount->approx_premium)}} </td>
                        <td> {{format_price($bud_income->medical_amount)}} </td>
                      </tr>
                      <tr>
                        <td>Cancer Insurance</td>
                        <td>  
                          @if($user_detail->smoke == "Yes")
                            10,00,000  
                          @else
                            0
                          @endif
                        </td>
                        <td> - </td>
                        <td> -</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                    <img src="{{asset('frontend/assets/images/advisory/asset-allocation.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    ASSET ALLOCATION			
                  </button>
                </h2>
              </div>
              <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <div class="">
                    <div class="row mt-3">
                      <div class="col-lg-6 col-md-12">
                          <div class="card-block">
                            <div id="assetCurrentAllocation" style="width: 100%; height: 100%"></div>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-12">
                          <div class="card-block">
                            <div id="assetAdvisedAllocation" style="width: 100%; height: 100%"></div>
                          </div>
                      </div>
                    </div>
                      <table class="table table-striped table-responsives">
                      <thead>
                        <tr>
                          <th>Asset Type</th>
                          <th>Current</th>
                          <th>Current</th>
                          <th>Advised</th>
                          <th>Advisable</th>
                          <th>Expected Return</th>
                          <th>Old Portfolio </th>
                          <th>Advised Portfolio</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Debt / Fixed Deposit </td>
                          <td> {{$asset_allocation_debt_deposit_current}}% </td>
                          <td> {{format_price($net_worth_assests->debet_instrument_amount)}} </td>
                          <td> {{$asset_allocation_debt_advised}}%</td>
                          <td> {{format_price($asset_allocation_debt_advisable)}} - 
                            @if($asset_allocation_debt_advisable < $net_worth_assests->debet_instrument_amount)
                              Decrease
                            @else
                              Increase
                            @endif
                          </td>
                          <td> {{$assumption_debt_expected_return->expectancy}}</td>
                          <td> {{format_price($asset_allocation_debt_old_portfolio)}} </td>
                          <td> {{format_price($asset_allocation_debt_advised_portfolio)}} -FD,PPF </td>
                        </tr>
                        <tr>
                          <td>House/Other Assets </td>
                          <td> {{$asset_allocation_house_assets_current}}%</td>
                          <td> {{format_price($net_worth_assests->assets_amount)}} </td>
                          <td>{{$asset_allocation_assets_advised}}%</td>
                          <td> {{format_price($asset_allocation_assets_advisable)}} - 
                            @if($asset_allocation_assets_advisable < $net_worth_assests->assets_amount)
                              Decrease
                            @else
                              Increase
                            @endif
                          </td>
                          <td>{{$assumption_house_assets_expected_return->expectancy}}</td>
                          <td> {{format_price($asset_allocation_asset_old_portfolio)}} </td>
                          <td>{{format_price($asset_allocation_asset_advised_portfolio)}} -Property </td>
                        </tr>
                        <tr>
                          <td>Equity (Stock/MF) </td>
                          <td> {{$asset_allocation_enquity_current}}% </td>
                          <td> {{format_price($net_worth_assests->stock_amount)}} </td>
                          <td> {{round($asset_allocation_enquity_advised,2)}}% </td>
                          <td>{{format_price($asset_allocation_enquity_advisable)}} - 
                            @if($asset_allocation_enquity_advisable < $net_worth_assests->stock_amount)
                              Decrease
                            @else
                              Increase
                            @endif
                          </td>
                          <td> {{$assumption_enquity_expected_return->expectancy}}</td>
                          <td> {{format_price($asset_allocation_enquity_old_portfolio)}} </td>
                          <td> {{format_price($asset_allocation_enquity_advised_portfolio)}} - Stock/MF </td>
                        </tr>
                        <tr>
                          <td>Alternative Investment(Gold,Crypto etc) </td>
                          <td> {{$asset_allocation_alternative_investment_current}}%</td>
                          <td> {{format_price($net_worth_assests->precious_amount)}} </td>
                          <td> {{$assumption_alternative_investment_advised->expectancy}}</td>
                          <td> {{format_price($asset_allocation_alternative_investment_advisable)}} - 
                            @if($asset_allocation_alternative_investment_advisable < $net_worth_assests->precious_amount)
                              Decrease
                            @else
                              Increase
                            @endif
                          </td>
                          <td> {{$assumption_alternative_investment_expected_return->expectancy}}</td>
                          <td> {{format_price($asset_allocation_alternative_investment_old_portfolio)}} </td>
                          <td>{{format_price($asset_allocation_alternative_investment_advised_portfolio)}} - Gold </td>
                        </tr>
                        <tr>
                          <td>Cash & Surplus </td>
                          <td> {{$asset_allocation_cash_and_surplush_current}}% </td>
                          <td> {{format_price($net_worth_current_asset)}} </td>
                          <td> {{round($asset_allocation_cash_and_surplus_advised,2)}}%</td>
                          <td> {{format_price($asset_allocation_cash_and_surplus_advisable)}} - 
                            @if($asset_allocation_cash_and_surplus_advisable < $net_worth_current_asset)
                              Decrease
                            @else
                              Increase
                            @endif
                          </td>
                          <td> {{$assumption_cash_and_surplus_expected_return->expectancy}}</td>
                          <td> {{format_price($asset_allocation_cash_and_surplus_old_portfolio)}} </td>
                          <td> {{format_price($asset_allocation_cash_and_surplus_advised_portfolio)}} - Emergency</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>{{$asset_allocation_total_current_balance_in_percent}}% </td>
                          <td> {{format_price($asset_allocation_total_current_balance)}} </td>
                          <td> {{$asset_allocation_total_advised}}%</td>
                          <td> {{format_price($asset_allocation_total_advisable)}} </td>
                          <td> {{round($asset_allocation_total_expected_return)}}% </td>
                          <td> {{format_price($asset_allocation_total_old_portfolio)}} </td>
                          <td> {{format_price($asset_allocation_total_advised_portfolio)}}</td>
                        </tr>
                      </tbody>
                    </table>
                      
                  </div>
                </div>
              </div>
            </div>
            
            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                    <img src="{{asset('frontend/assets/images/advisory/investor.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    INVESTOR TYPE		
                  </button>
                </h2>
              </div>
              <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <table class="table table-striped table-responsives">
                    <tbody>
                      <tr>
                        <td class="col-2">
                          @php
                            $risks  = (array)$risk_assessment;
                            $risk_score = 0;
                            foreach ($risks as $key => $value) {
                              // $option = collect(explode('|', $value))->first();
                              $option = explode('|', $value)[0];
                              $risk_score += (int)$option;
                            }
                            $age = ageCalculator($user_detail->dob);
                            $multiplier = round(100 - ($age * 30 / 100));
                            $risk_score_value = $risk_score * $multiplier / 100 ;

                            $investor_type1 = App\Models\InvestorType::whereId(1)->first();
                            $investor_type2 = App\Models\InvestorType::whereId(2)->first();
                            $investor_type3 = App\Models\InvestorType::whereId(3)->first();
                          @endphp
                          {{ $risk_score_value }}
                        </td>
                        <td class="col-10"> 
                          @if($risk_score_value <= 18)
                            {{$investor_type1->category}}
                          @elseif($risk_score_value <= 25)
                            {{$investor_type2->category}}
                          @else
                            {{$investor_type3->category}}
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                    <img src="{{asset('frontend/assets/images/advisory/goals.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    GOALS			
                  </button>
                </h2>
              </div>
              <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <table class="table table-striped table-responsives">
                    <thead>
                      <tr>
                        <th>Description</th>
                        <th>Goals (Today's Value)</th>
                        <th>Target Year</th>
                        <th>Savings Required per month </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Vacation</td>
                        <td> {{format_price($goals->vacation)}} </td>
                        <td> {{$goals->vacation_years}} </td>
                        <td> {{format_price($goals_vacation_savings_per_month)}} </td>
                      </tr>
                      <tr>
                        <td>College Education </td>
                        <td> {{format_price($goals->collage_education1)}}</td>
                        <td> {{$goals->collage_education_year1}} </td>
                        <td> {{format_price($goals_collage_education1_savings_per_month)}} </td>
                      </tr>
                      <tr>
                        <td>College Education</td>
                        <td> {{format_price($goals->collage_education2)}}</td>
                        <td> {{$goals->collage_education_year2}} </td>
                        <td> {{format_price($goals_collage_education2_savings_per_month)}}</td>
                      </tr>
                      <tr>
                        <td>House property  </td>
                        <td> {{format_price($goals->house_property) }} </td>
                        <td> {{$goals->house_property_year}} </td>
                        <td> {{format_price($goals_house_property_savings_per_month)}} </td>
                      </tr>
                      <tr>
                        <td>Retirement </td>
                        <td>{{format_price($goals->retirement)}} </td>
                        <td> {{$goals->retirement_year}} </td>
                        <td> {{format_price($goals_retirement_savings_per_month)}} </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0 " id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                    <img src="{{asset('frontend/assets/images/advisory/debt.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    DEBT			
                  </button>
                </h2>
              </div>
              <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Institutions</th>
                        <th>Type of Bank </th>
                        <th>Rate</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($debt_logics as $debt)
                        <tr>
                          <td>{{$debt->institutions }}</td>
                          <td> {{$debt->type_of_bank }} </td>
                          <td>{{$debt->rate}} </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0" id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                    <img src="{{asset('frontend/assets/images/advisory/investment.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    ALTERNATIVE INVESTMENTS		
                  </button>
                </h2>
              </div>
              <div id="flush-collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <table class="table table-striped table-responsives">
                    <thead>
                      <tr>
                        <th>Mutual Fund  </th>
                        <th>Allocation </th>
                        <th>Scrip Name  </th>
                        <th>Tenure </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($alternative_investments as $alternative_investment)
                        <tr>
                          <td>{{$alternative_investment->mutual_fund}}</td>
                          <td> {{$alternative_investment->allocation}} </td>
                          <td> {{$alternative_investment->scrip_name}} </td>
                          <td> {{$alternative_investment->tenure}} </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="accordion-item" style="margin-bottom: 20px;">
              <div id="headingOne">
                <h2 class="accordion-header mb-0" id="flush-headingOne">
                  <button class="accordion-button collapsed" style="font-size: 13px; font-weight: 600;padding: 16px 20px;border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEleven" aria-expanded="false" aria-controls="flush-collapseEleven">
                    <img src="{{asset('frontend/assets/images/advisory/equity.png')}}" class="mr-2" style="margin-top: -7px;" alt="" srcset="">
                    EQUITY
                  </button>
                </h2>
              </div>
              <div id="flush-collapseEleven" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <table class="table table-striped table-responsives">
                    <tbody>
                      @foreach ($enquity_investments as $enquity_investment)
                        <tr>
                          <td>{{$enquity_investment->mutual_fund}}</td>
                          <td> {{$enquity_investment->allocation}} </td>
                          <td> {{$enquity_investment->scrip_name}} </td>
                          <td> {{$enquity_investment->tenure}} </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>
@endsection


@push('script')
  <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-core.min.js"></script>
  <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-pie.min.js"></script>
  <script defer src="{{ asset('backend/plugins/ammap3/ammap/ammap.js') }}"></script>
  <script defer src="{{ asset('backend/plugins/ammap3/ammap/maps/js/usaLow.js') }}"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
  
          var chart = new CanvasJS.Chart("finRatioAnalysis", {

              theme: "light2",  

              data: [  //array of dataSeries     
              {        
                type: "column",
                name: "Actual",
                showInLegend: true,
                dataPoints: [
                { label: "Debt Actual Net Worth", y: {{round($fin_ratio_debt_analysis)}} },
                { label: "Liquidity Actual Ratios", y: {{$fin_ratio_actual_liquidity_ratio}} },
                ]
            },

            {

              type: "column",
              name: "Advisable", 
              showInLegend: true,               
              dataPoints: [
              { label: "Debt Net Worth", y: 100 },
              { label: "Liquidity Ratios", y: 300 },
              ]
            }
              ],
              axisY:{
                suffix: "%"
              }    
          });
          chart.render();

            var chart = new CanvasJS.Chart("netWorthAnalysis", {  

                  data: [ 
                  {        
                  type: "column",
                  name: "Asset",
                  showInLegend: true,
                  dataPoints: [
                  { label: "Asset", y: {{$fixed_assets_amount}} },
                  { label: "Current", y: {{$net_worth_current_asset}} },
                  { label: "Total Asset", y: {{$net_worth_total_assets}} },                                    
                
                  ]
                },

                { //dataSeries - second quarter

                  type: "column",
                  name: "Liability", 
                  showInLegend: true,               
                  dataPoints: [
                  { label: "Fixed", y: {{$fixed_assets_loan_amount}} },
                  { label: "Current Liabilities", y: {{$net_worth_current_liability}} },
                  { label: "Total Asset Liabilities", y: {{$net_worth_total_liability}} },                                    
                
                  ]
                }
                ],   
          });
          chart.render();
        
    $(document).ready(function(){
        setInterval(function time(){
            var date_from = "2022-08-29 11:00:25";
            
            var date_to = "2022-10-15 00:00:00";
            var startDay = new Date(date_from);
            var endDay = new Date(date_to);
      
            var millisBetween = endDay.getTime() - startDay.getTime();
            var days_t = millisBetween / (1000 * 3600 * 24);

            if(days_t >= 0){
                var days_tmp = Math.round(Math.abs(days_t));

                var d = new Date();
                var days = days_tmp + 1;
                var hours = 24 - d.getHours();
                var min = 60 - d.getMinutes();
                if((min + '').length == 1){
                    min = '0' + min;
                }
                var sec = 60 - d.getSeconds();
                if((sec + '').length == 1){
                        sec = '0' + sec;
                }
                jQuery('#week-countdown p').html(days+'d : '+hours+'h : '+min+'m : '+sec+'s ')
            }else{
                var d = new Date();
                var hours = 24 - d.getHours();
                var min = 60 - d.getMinutes();
                if((min + '').length == 1){
                    min = '0' + min;
                }
                var sec = 60 - d.getSeconds();
                if((sec + '').length == 1){
                        sec = '0' + sec;
                }
                jQuery('#week-countdown p').html(0+'d : '+hours+'h : '+min+'m : '+sec+'s ')
            }
        }, 1000);
        anychart.onDocumentReady(function() {

        // set the data
        var data = [
                    {x: 'Total Expenses', value: "{{ round($exp_percent )}}"},
                    {x: 'Total Savings', value: "{{ round(100-$exp_percent) }}" },
                ];

        // create the chart
        var chart = anychart.pie();

        // add the data
        chart.data(data);

        // display the chart in the container
        chart.container('ChartContainer');
        chart.draw();

        });

        anychart.onDocumentReady(function() {

            // set the data
            var data = [
                        {x: 'Debt/Fixed Deposite', value: "{{ $asset_allocation_debt_deposit_current }}"},
                        {x: 'House/Other Assets', value: "{{ $asset_allocation_house_assets_current }}" },
                        {x: 'Enquity(Stock/MF)', value: "{{ $asset_allocation_enquity_current }}" },
                        {x: 'Alternative Investment', value: "{{ $asset_allocation_alternative_investment_current }}" },
                        {x: 'Cash & Surplus', value: "{{ $asset_allocation_cash_and_surplush_current }}" },
                    ];

            // create the chart
            var chart = anychart.pie();

            // add the data
            chart.data(data);

            // display the chart in the container
            chart.container('assetCurrentAllocation');
            chart.draw();

        });

        anychart.onDocumentReady(function() {

            // set the data
            var data = [
                        {x: 'Debt/Fixed Deposite', value: "{{ $asset_allocation_debt_advised }}"},
                        {x: 'House/Other Assets', value: "{{ $asset_allocation_assets_advised }}" },
                        {x: 'Enquity(Stock/MF)', value: "{{ round($asset_allocation_enquity_advised,2) }}" },
                        {x: 'Alternative Investment', value: "{{ $assumption_alternative_investment_advised_exp }}" },
                        {x: 'Cash & Surplus', value: "{{round($asset_allocation_cash_and_surplus_advised,2)}}" },
                    ];

            // create the chart
            var chart = anychart.pie();

            // add the data
            chart.data(data);

            // display the chart in the container
            chart.container('assetAdvisedAllocation');
            chart.draw();

        });

        window.onload = function () {
          var chart = new CanvasJS.Chart("barContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            data: [{        
              type: "column",  
              showInLegend: true, 
              legendMarkerColor: "grey",
              dataPoints: [      
                { y: {{round($debt_income_ratio)}}, label: "Debt Actual Ratio" },  
                { y: 40,  label: "Debt Advisable Ratio" },
                { y: {{$saving_ratio_actual}},  label: "Saving Actual Ratio" },
                { y: 20,  label: "Saving Advisable Ratio" },
              ]
            }]
          });
          chart.render();
        }
    });
  </script>
@endpush