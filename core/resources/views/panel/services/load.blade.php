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
           
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th class="no-export">Actions</th> 
                        <th  class="text-center no-export"># </th>             
                                               
                        <th class="col_1">
                            Title</th>
                                                    {{-- <th class="col_2">
                            Description <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="description"></i><i class="ik ik ik-arrow-down desc" data-val="description"></i></div></th> --}}
                                                    {{-- <th class="col_3">
                            Banner <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="banner"></i><i class="ik ik ik-arrow-down desc" data-val="banner"></i></div></th> --}}
                            <th class="col_5"> Category  </th>                       
                            <th class="col_4">
                              Price <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div>
                            </th>
                            <th class="col_7">
                                Status 
                            </th>         
                        </tr>
                </thead>
                <tbody>
                    @if($services->count() > 0)
                        @foreach($services as  $service)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.services.edit', $service->id) }}" title="Edit Service" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            <a href="{{ route('panel.services.destroy', $service->id) }}" title="Delete Service" class="dropdown-item  delete-item"><li class=" p-0">Delete</li></a>
                                            <?php  if($service->permission['portfolio']){ ?>
                                              <a href="{{ route('panel.portfolios.index', ['service'=>$service->id]) }}" title="Edit Service" class="dropdown-item "><li class="p-0">Manage Portfolio</li></a>
                                            <?php  } ?>
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> #SI{{ getPrefixZeros($service->id) }}</td>
                                <td class="col_1">{{ \Str::limit($service->title,25,'...') }}
                                    @if($service->is_featured == 1)
                                        <i title="Featured" class="ik ik-bookmark text-warning"></i>
                                    @endif
                                </td>
                                  {{-- <td class="col_2">{{$service->description }}</td> --}}
                                  {{-- <td class="col_3"><a href="{{ asset($service->banner) }}" target="_blank" class="btn-link">{{$service->banner }}</a></td> --}}
                                <td class="col_5">
                                    {{fetchFirst('App\Models\Category',$service->category_id,'name','')}}
                                </td>
                               
                                
                                  {{-- <td class="col_6">{{$service->permission }}</td> --}}
                                <td class="col_7">
                                    {{ format_price($service->price) }}
                                   
                                </td>
                                  {{-- <td class="col_8">{{$service->mrp }}</td> --}}
                                <td class="col_4">
                                    @if($service->is_publish == 1)
                                      <span class="badge badge-success">Publish</span>
                                    @else
                                    <span class="badge badge-danger">Unpublish</span>
                                    @endif
                                </td>
                                  
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td class="text-center text-danger" colspan="8">No Data Found !</td>
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
