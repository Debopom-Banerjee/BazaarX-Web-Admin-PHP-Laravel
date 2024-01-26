<div class="card-body">
    <div class="d-flex justify-content-between mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10"{{ $requirements->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25"{{ $requirements->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50"{{ $requirements->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100"{{ $requirements->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <div>
            <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                
                <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Title</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Category  </a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Sub Category  </a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Price</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_5"><a href="javascript:void(0);"  class="btn btn-sm">Cunstomer Info</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_6"><a href="javascript:void(0);"  class="btn btn-sm">Location</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_7"><a href="javascript:void(0);"  class="btn btn-sm">Status</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_8"><a href="javascript:void(0);"  class="btn btn-sm">Budget</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_9"><a href="javascript:void(0);"  class="btn btn-sm">Type</a></li>                                        
            </ul>
            <a href="javascript:void(0);" id="print" data-url="{{ route('panel.requirements.print') }}"  data-rows="{{json_encode($requirements) }}" class="btn btn-primary btn-sm">Print</a>
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
    </div>
    <div class="table-responsive">
        <table id="table" class="table">
            <thead>
                <tr>
                    <th class="no-export">Actions</th> 
                    <th  class="text-center no-export">#<div class="table-div"></div></th>             
                    <th class="col_1">Title <div class="table-div"></div></th>
                    <th class="col_2">Category<div class="table-div"></div></th>
                    <th class="col_3" title="Sub Category">SC<div class="table-div"></div></th>
                    <th class="col_4">Price <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="price"></i><i class="ik ik ik-arrow-down desc" data-val="price"></i></div></th>
                    <th class="col_7">Posted By</th>
                    <th class="col_7">Status <div class="table-div"></div></th>
                    <th class="col_9">Type<div class="table-div"></div></th>
                    <th class="col_10">Created At<div class="table-div"><i class="ik ik-arrow-up  asc" data-val="created_at"></i><i class="ik ik ik-arrow-down desc" data-val="created_at"></i></div></th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($requirements) --}}
                @if($requirements->count() > 0)
                  @foreach($requirements as  $requirement)
                        <tr>
                            <td class="no-export">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        <a href="{{ route('panel.requirements.edit', $requirement->id) }}" title="Edit Requirement" class="dropdown-item "><li class="p-0">Edit</li></a>
                                        <a href="{{ route('panel.requirements.destroy', $requirement->id) }}" title="Delete Requirement" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a>
                                        @if ($requirement->code != null && $requirement->type == 1)
                                            <a id="copyBtn" onclick="Copy();" href="javascript:void(0)" data-val="{{ route('panel.partner.leads.explore',['code' => $requirement->code]) }}" title="Copy URL" class="dropdown-item"><li class=" p-0">Copy URL</li></a>
                                        @endif
                                    </ul>
                                </div> 
                            </td>
                           {{-- @dd($requirement); --}}
                            <td  class="text-center no-export"> {{  $loop->iteration }}</td>
                            <td class="col_1">{{$requirement->title }}</td>
                                  <td class="col_2">{{fetchFirst('App\Models\Category',$requirement->category_id,'name','--')}}</td>
                                  <td class="col_3">{{fetchFirst('App\Models\Category',$requirement->sub_category_id,'name','--')}}</td>
                                  <td class="col_4">{{format_price($requirement->price) }}</td>
                                  
                                  <td class="col_4">{{fetchFirst('App\User',$requirement->created_by,'name','--')}}</td>
                              <td  class="col_4">
                                  <div class="badge badge-{{ getRequirementStatus($requirement->status)['color'] }}">{{getRequirementStatus($requirement->status)['name'] }}</div>
                              </td>
                              {{-- <td class="col_8">
                                {{$requirement->budget }}
                            </td> --}}
                            <td class="col_9">
                                <div class="text-{{ getRequirementType($requirement->type)['color'] }}">{{getRequirementType($requirement->type)['name'] }}</div>
                            </td>
                            <td class="col_9">
                                {{ getFormattedDate($requirement->created_at) }}
                            </td>
                              
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
        {{ $requirements->appends(request()->except('page'))->links() }}
    </div>
    <div>
       @if($requirements->lastPage() > 1)
            <label for="">Jump To: 
                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                    @for ($i = 1; $i <= $requirements->lastPage(); $i++)
                        <option value="{{ $i }}" {{ $requirements->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </label>
       @endif
    </div>
</div>
