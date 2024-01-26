<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $debt_logics->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $debt_logics->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $debt_logics->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $debt_logics->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Institutions</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Type Of Bank</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Rate</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Period</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.debt_logics.print') }}"  data-rows="{{json_encode($debt_logics) }}" class="btn btn-primary btn-sm">Print</a>
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
                            Institutions <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="institutions"></i><i class="ik ik ik-arrow-down desc" data-val="institutions"></i></div></th>
                                                    <th class="col_2">
                            Type Of Bank <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="type_of_bank"></i><i class="ik ik ik-arrow-down desc" data-val="type_of_bank"></i></div></th>
                                                    <th class="col_3">
                            Rate <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="rate"></i><i class="ik ik ik-arrow-down desc" data-val="rate"></i></div></th>
                                                    <th class="col_4">
                            Period <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="period"></i><i class="ik ik ik-arrow-down desc" data-val="period"></i></div></th>
                                                                        </tr>
                </thead>
                <tbody>
                    @if($debt_logics->count() > 0)
                                                    @foreach($debt_logics as  $debt_logic)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.debt_logics.edit', $debt_logic->id) }}" title="Edit Debt Logic" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            {{-- <a href="{{ route('panel.debt_logics.destroy', $debt_logic->id) }}" title="Delete Debt Logic" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a> --}}
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> {{  $loop->iteration }}</td>
                                <td class="col_1">{{$debt_logic->institutions }}</td>
                                  <td class="col_2">{{$debt_logic->type_of_bank }}</td>
                                  <td class="col_3">{{$debt_logic->rate }}</td>
                                  <td class="col_4">{{$debt_logic->period }}</td>
                                  
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
            {{ $debt_logics->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($debt_logics->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $debt_logics->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $debt_logics->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
