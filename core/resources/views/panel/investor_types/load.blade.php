<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $investor_types->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $investor_types->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $investor_types->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $investor_types->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Category</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Score</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.investor_types.print') }}"  data-rows="{{json_encode($investor_types) }}" class="btn btn-primary btn-sm">Print</a>
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
                            Category <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="category"></i><i class="ik ik ik-arrow-down desc" data-val="category"></i></div></th>
                                                    <th class="col_2">
                            Score <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="score"></i><i class="ik ik ik-arrow-down desc" data-val="score"></i></div></th>
                                                                        </tr>
                </thead>
                <tbody>
                    @if($investor_types->count() > 0)
                                                    @foreach($investor_types as  $investor_type)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.investor_types.edit', $investor_type->id) }}" title="Edit Investor Type" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            {{-- <a href="{{ route('panel.investor_types.destroy', $investor_type->id) }}" title="Delete Investor Type" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a> --}}
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> {{  $loop->iteration }}</td>
                                <td class="col_1">{{$investor_type->category }}</td>
                                  <td class="col_2">{{$investor_type->score }}</td>
                                  
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
            {{ $investor_types->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($investor_types->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $investor_types->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $investor_types->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
