<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $portfolios->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $portfolios->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $portfolios->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $portfolios->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility</button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                    <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Service  </a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">Title</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Description</a></li>                    <li class="dropdown-item p-0 col-btn" data-val="col_4"><a href="javascript:void(0);"  class="btn btn-sm">Buy Link</a></li>                                        
                </ul>
                <a href="javascript:void(0);" id="print" data-url="{{ route('panel.portfolios.print') }}"  data-rows="{{json_encode($portfolios) }}" class="btn btn-primary btn-sm">Print</a>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th class="no-export">Actions</th> 
                        <th  class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>             
                                               
                        {{-- <th class="col_1">
                            Service    
                            <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="service_id"></i><i class="ik ik ik-arrow-down desc" data-val="service_id"></i></div>
                        </th> --}}
                        <th class="col_2">
                            Title 
                            {{-- <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="title"></i><i class="ik ik ik-arrow-down desc" data-val="title"></i></div> --}}
                        </th>
                        <th class="col_2">
                            Last Update At 
                            {{-- <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="title"></i><i class="ik ik ik-arrow-down desc" data-val="title"></i></div> --}}
                        </th>
                        {{-- <th class="col_3">
                            Description 
                            <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="description"></i><i class="ik ik ik-arrow-down desc" data-val="description"></i></div>
                        </th> --}}
                                                
                        {{-- <th class="col_4">
                            Buy Link
                             {{-- <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="buy_link"></i><i class="ik ik ik-arrow-down desc" data-val="buy_link"></i></div> 
                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if($portfolios->count() > 0)
                        @foreach($portfolios as  $portfolio)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.portfolios.edit', $portfolio->id) }}" title="Edit Portfolio" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            <a href="{{ route('panel.portfolios.destroy', $portfolio->id) }}" title="Delete Portfolio" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a>
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export">#{{  getPrefixZeros($loop->iteration) }}</td>
                                    {{-- <td class="col_1">{{fetchFirst('App\Models\Service',$portfolio->service_id,'name','--')}}</td> --}}
                                <td class="col_2">
                                    <a class="text-primary" href="{{ $portfolio->buy_link !=''? $portfolio->buy_link:'javascript:void(0)'}}">{{$portfolio->title }}</a>
                                </td>
                                <td class="col_2">
                                    {{$portfolio->updated_at }}</a>
                                </td>
                                  {{-- <td class="col_3">{{$portfolio->description }}</td> --}}
                                {{-- <td class="col_4">
                                    <a class="btn btn-outline-primary" href="{{$portfolio->buy_link }}">Click</a>
                                </td> --}}
                                  
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
            {{ $portfolios->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($portfolios->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $portfolios->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $portfolios->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif
        </div>
    </div>
