<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $investment_options->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $investment_options->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $investment_options->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $investment_options->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Mutual Fund</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Allocation</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Scrip Name</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Tenure</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_5"><a href="javascript:void(0);"  class="btn btn-sm">Type</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.investment_options.print') }}"  data-rows="{{json_encode($investment_options) }}" class="btn btn-primary btn-sm">Print</a>
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
                            Mutual Fund <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="mutual_fund"></i><i class="ik ik ik-arrow-down desc" data-val="mutual_fund"></i></div></th>
                                                    <th class="col_2">
                            Allocation <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="allocation"></i><i class="ik ik ik-arrow-down desc" data-val="allocation"></i></div></th>
                                                    <th class="col_3">
                            Scrip Name <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="scrip_name"></i><i class="ik ik ik-arrow-down desc" data-val="scrip_name"></i></div></th>
                                                    <th class="col_4">
                            Tenure <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="tenure"></i><i class="ik ik ik-arrow-down desc" data-val="tenure"></i></div></th>
                                                    <th class="col_5">
                            Type <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="type"></i><i class="ik ik ik-arrow-down desc" data-val="type"></i></div></th>
                                                                        </tr>
                </thead>
                <tbody>
                    @if($investment_options->count() > 0)
                         @foreach($investment_options as  $investment_option)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.investment_options.edit', $investment_option->id) }}" title="Edit Investment Option" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            {{-- <a href="{{ route('panel.investment_options.destroy', $investment_option->id) }}" title="Delete Investment Option" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a> --}}
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> {{  $loop->iteration }}</td>
                                <td class="col_1">{{$investment_option->mutual_fund }}</td>
                                  <td class="col_2">{{$investment_option->allocation }}</td>
                                  <td class="col_3">{{$investment_option->scrip_name }}</td>
                                  <td class="col_4">{{$investment_option->tenure }}</td>
                                  <td class="col_5">{{$investment_option->type }}</td>
                                  
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
            {{ $investment_options->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($investment_options->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $investment_options->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $investment_options->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
