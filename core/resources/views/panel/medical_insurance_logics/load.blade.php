<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $medical_insurance_logics->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $medical_insurance_logics->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $medical_insurance_logics->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $medical_insurance_logics->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Family Income</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Insurance Amount</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Of Family Members</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Coverage Required For Family</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_5"><a href="javascript:void(0);"  class="btn btn-sm">Approx Premium</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.medical_insurance_logics.print') }}"  data-rows="{{json_encode($medical_insurance_logics) }}" class="btn btn-primary btn-sm">Print</a>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th class="no-export">Actions</th> 
                        <th  class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>             
                                               
                        <th class="col_1">
                            Family Income <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="family_income"></i><i class="ik ik ik-arrow-down desc" data-val="family_income"></i></div></th>
                                                    <th class="col_2">
                            Insurance Amount <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="insurance_amount"></i><i class="ik ik ik-arrow-down desc" data-val="insurance_amount"></i></div></th>
                                                    <th class="col_3">
                            Of Family Members <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="of_family_members"></i><i class="ik ik ik-arrow-down desc" data-val="of_family_members"></i></div></th>
                                                    <th class="col_4">
                            Coverage Required For Family <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="coverage_required_for_family"></i><i class="ik ik ik-arrow-down desc" data-val="coverage_required_for_family"></i></div></th>
                                                    <th class="col_5">
                            Approx Premium <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="approx_premium"></i><i class="ik ik ik-arrow-down desc" data-val="approx_premium"></i></div></th>
                                                                        </tr>
                </thead>
                <tbody>
                    @if($medical_insurance_logics->count() > 0)
                                                    @foreach($medical_insurance_logics as  $medical_insurance_logic)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.medical_insurance_logics.edit', $medical_insurance_logic->id) }}" title="Edit Medical Insurance Logic" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            {{-- <a href="{{ route('panel.medical_insurance_logics.destroy', $medical_insurance_logic->id) }}" title="Delete Medical Insurance Logic" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a> --}}
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> {{  $loop->iteration }}</td>
                                <td class="col_1">{{$medical_insurance_logic->family_income }}</td>
                                  <td class="col_2">{{$medical_insurance_logic->insurance_amount }}</td>
                                  <td class="col_3">{{$medical_insurance_logic->of_family_members }}</td>
                                  <td class="col_4">{{$medical_insurance_logic->coverage_required_for_family }}</td>
                                  <td class="col_5">{{$medical_insurance_logic->approx_premium }}</td>
                                  
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td class="text-center" colspan="8">No Data Found...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $medical_insurance_logics->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($medical_insurance_logics->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $medical_insurance_logics->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $medical_insurance_logics->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
