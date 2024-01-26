<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $user_advisories->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $user_advisories->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $user_advisories->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $user_advisories->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            {{-- <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">User  </a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">User Detail</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Assests</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Liabilities</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_5"><a href="javascript:void(0);"  class="btn btn-sm">Goals</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_6"><a href="javascript:void(0);"  class="btn btn-sm">Budget</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_7"><a href="javascript:void(0);"  class="btn btn-sm">Risk Assessment</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.user_advisories.print') }}"  data-rows="{{json_encode($user_advisories) }}" class="btn btn-primary btn-sm">Print</a>
            </div> --}}
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th class="no-export">Actions</th> 
                        <th  class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>             
                                               
                            <th class="col_1">
                                Customer Name    <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="user_id"></i><i class="ik ik ik-arrow-down desc" data-val="user_id"></i></div>
                            </th>
                            <th class="col_1">
                                Applicant Name    <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="user_id"></i><i class="ik ik ik-arrow-down desc" data-val="user_id"></i></div>
                            </th>
                            <th class="col_1">
                                Created At    <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="user_id"></i><i class="ik ik ik-arrow-down desc" data-val="user_id"></i></div>
                            </th>
                                                    {{-- <th class="col_2">
                            User Detail <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="user_detail"></i><i class="ik ik ik-arrow-down desc" data-val="user_detail"></i></div></th>
                                                    <th class="col_3">
                            Assests <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="assests"></i><i class="ik ik ik-arrow-down desc" data-val="assests"></i></div></th>
                                                    <th class="col_4">
                            Liabilities <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="liabilities"></i><i class="ik ik ik-arrow-down desc" data-val="liabilities"></i></div></th>
                                                    <th class="col_5">
                            Goals <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="goals"></i><i class="ik ik ik-arrow-down desc" data-val="goals"></i></div></th>
                                                    <th class="col_6">
                            Budget <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="budget"></i><i class="ik ik ik-arrow-down desc" data-val="budget"></i></div></th>
                                                    <th class="col_7">
                            Risk Assessment <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="risk_assessment"></i><i class="ik ik ik-arrow-down desc" data-val="risk_assessment"></i></div></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if($user_advisories->count() > 0)
                        @foreach($user_advisories as  $user_advisory)
                        @php
                            $user_data = json_decode($user_advisory->user_detail);
                        @endphp
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            {{-- <a href="{{ route('panel.user_advisories.edit', $user_advisory->id) }}" title="Edit User Advisory" class="dropdown-item "><li class="p-0">Edit</li></a> --}}
                                            {{-- <a href="{{ route('panel.user_advisories.show', $user_advisory->id) }}" title="Edit User Advisory" class="dropdown-item "><li class="p-0">Show</li></a> --}}
                                            <a href="{{ route('panel.user_advisories.destroy', $user_advisory->id) }}" title="Delete User Advisory" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a>
                                            <a href="{{ route('user-advisory.show', $user_advisory->id) }}" title="Show User Advisory" class="dropdown-item "><li class=" p-0">User Advisory Show</li></a>
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> {{  $loop->iteration }}</td>
                                <td class="col_1">{{fetchFirst('App\User',$user_advisory->user_id,'name','--')}}</td>
                                <td class="col_1">
                                    {{$user_data->name ?? ''}}
                                </td>
                                <td class="col_1">{{$user_advisory->created_at}}</td>
                                  
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
            {{ $user_advisories->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($user_advisories->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $user_advisories->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $user_advisories->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
