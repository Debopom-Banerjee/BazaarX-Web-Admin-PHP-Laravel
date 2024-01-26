<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $assumption_logics->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $assumption_logics->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $assumption_logics->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $assumption_logics->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Scenerio</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Expectancy</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Low Limit</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">High Limit</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_5"><a href="javascript:void(0);"  class="btn btn-sm">Year</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.assumption_logics.print') }}"  data-rows="{{json_encode($assumption_logics) }}" class="btn btn-primary btn-sm">Print</a>
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
                            Scenerio <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="scenerio"></i><i class="ik ik ik-arrow-down desc" data-val="scenerio"></i></div></th>
                                                    <th class="col_2">
                            Expectancy <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="expectancy"></i><i class="ik ik ik-arrow-down desc" data-val="expectancy"></i></div></th>
                                                    <th class="col_3">
                            Low Limit <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="low_limit"></i><i class="ik ik ik-arrow-down desc" data-val="low_limit"></i></div></th>
                                                    <th class="col_4">
                            High Limit <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="high_limit"></i><i class="ik ik ik-arrow-down desc" data-val="high_limit"></i></div></th>
                                                    <th class="col_5">
                            Year <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="year"></i><i class="ik ik ik-arrow-down desc" data-val="year"></i></div></th>
                                                                        </tr>
                </thead>
                <tbody>
                    @if($assumption_logics->count() > 0)
                                                    @foreach($assumption_logics as  $assumption_logic)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.assumption_logics.edit', $assumption_logic->id) }}" title="Edit Assumption Logic" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            {{-- <a href="{{ route('panel.assumption_logics.destroy', $assumption_logic->id) }}" title="Delete Assumption Logic" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a> --}}
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> {{  $loop->iteration }}</td>
                                <td class="col_1">{{$assumption_logic->scenerio }}</td>
                                  <td class="col_2">{{$assumption_logic->expectancy }}</td>
                                  <td class="col_3">{{$assumption_logic->low_limit }}</td>
                                  <td class="col_4">{{$assumption_logic->high_limit }}</td>
                                  <td class="col_5">{{$assumption_logic->year }}</td>
                                  
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
            {{ $assumption_logics->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($assumption_logics->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $assumption_logics->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $assumption_logics->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
