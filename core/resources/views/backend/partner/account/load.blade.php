<div class="card-body">
    {{-- <div class="d-flex justify-content-between mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10"{{$bankDetails->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25"{{$bankDetails->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50"{{ $bankDetails->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100"{{ $bankDetails->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
    </div> --}}
    <div class="table-responsive">
        <table id="table" class="table">
            <thead>
                <tr>
                    {{-- <th class="no-export">Actions</th> --}}
                    <th  class="no-export">ID <div class="table-div"><i class="ik ik-arrow-up  asc  " data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                    <th>Name</th>
                    <th>Account No</th>
                    <th>IFSC Code</th>
                </tr>
            </thead>
            <tbody>
                @if($bankDetails->count() > 0)
                     @foreach($bankDetails as $bankDetail)
                            {{-- <td class="no-export">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        <li class="dropdown-item p-0"><a href="{{route('panel.partner.account.edit',$bankDetail->id)}}" title="Edit Details" class="btn btn-sm">Edit</a></li>
                                        <li class="dropdown-item p-0"><a href="{{route('panel.partner.account.destroy',$bankDetail->id)}}" title="Delete Account" class="btn btn-sm delete-item">Delete</a></li>
                                    </ul>
                                </div> 
                            </td> --}}
                              <td> 
                                {{ $bankDetail->getPrefix() }}
                            </td>
                              <td> 
                                {{ $bankDetail->name }}
                            </td>
                              <td> 
                                {{ $bankDetail->accountNumber }}
                            </td>
                              <td> 
                                {{ $bankDetail->ifscCode }}
                            </td>
                        </tr>
                    @endforeach
                @else 
                    <tr>
                        <td class="text-center text-danger" colspan="15">No Data Found !</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <div class="pagination">
        {{ $bankDetails->appends(request()->except('page'))->links() }}
    </div>
    <div>
       @if($bankDetails->lastPage() > 1)
            <label for="">Jump To: 
                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                    @for ($i = 1; $i <= $bankDetails->lastPage(); $i++)
                        <option value="{{ $i }}" {{ $bankDetails->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </label>
       @endif
    </div>
</div>
