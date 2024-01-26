<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $codes->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $codes->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $codes->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $codes->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Code</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Expires At</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Type</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Precentage</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_5"><a href="javascript:void(0);"  class="btn btn-sm">Max Uses</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.codes.print') }}"  data-rows="{{json_encode($codes) }}" class="btn btn-primary btn-sm">Print</a>
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
                            Promo Code 
                        </th>
                        <th class="col_2">
                            Expires At 
                        </th>
                        <th class="col_3">
                           Criteria
                        </th>
                        {{-- <th class="col_4">
                            Value 
                        </th> --}}
                        <th class="col_5">
                            Max Use
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($codes->count() > 0)
                        @foreach($codes as  $code)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.codes.edit', $code->id) }}" title="Edit Code" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            <a href="{{ route('panel.codes.destroy', $code->id) }}" title="Delete Code" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a>
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export">#{{getPrefixZeros($loop->iteration)}}</td>
                                <td class="col_1">{{$code->code }}</td>
                                <td class="col_2">{{$code->expires_at }}</td>
                                <td class="col_3">
                                    <?php if($code->type == 0){ 
                                        echo $code->value;
                                        echo ' Percentage';
                                    }
                                    ?>  
                                    
                                    <?php if($code->type == 1){
                                         echo 'Flat ';
                                        echo $code->value; 
                                       
                                    }
                                    ?>
                                </td>
                                  {{-- <td class="col_4">{{$code->value }}</td> --}}
                                  <td class="col_5">{{$code->max_uses }}</td>
                                  
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
            {{ $codes->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($codes->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $codes->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $codes->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
