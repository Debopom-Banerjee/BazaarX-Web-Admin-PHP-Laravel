<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $services->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $services->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $services->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $services->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">User Id</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Details</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Is Primary</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.testimonial.print') }}"  data-rows="{{json_encode($services) }}" class="btn btn-primary btn-sm">Print</a>
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
                            Title <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="user_id"></i><i class="ik ik ik-arrow-down desc" data-val="user_id"></i></div></th>
                                                    <th class="col_2">
                            Details <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="details"></i><i class="ik ik ik-arrow-down desc" data-val="details"></i></div></th>
                         </tr>
                </thead>
                <tbody>
                    @if($services->count() > 0)
                                                    @foreach($services as  $user_addre)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.testimonial.edit', $user_addre->id) }}" title="Edit User Addre" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            <a href="{{ route('panel.testimonial.destroy', $user_addre->id) }}" title="Delete User Addre" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a>
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> {{  $loop->iteration }}</td>
                                <td class="col_1">{{$user_addre->title }}</td>
                                  <td class="col_2">{{$user_addre->description }}</td>
                                 
                                  
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
            {{ $services->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($services->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $services->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $services->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
