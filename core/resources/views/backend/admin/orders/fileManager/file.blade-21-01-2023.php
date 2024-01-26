

<div class="row">
    <div class="col-md-9 col-12">
        <table id="table" class="table">
            <thead>
                <tr> 
                    <th  class="col_2">#AID<div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>             
                    <th class="col_2"> Name </th>         
                    <th class="col_2"> Action </th>               
                </tr>
            </thead>
            <tbody>
                @forelse ($attachments as $index => $item)
                <tr>
                    <td class="col_2">#{{++$index}}</td>
                    <td class="col_2">
                       <h6 class="m-0 p-0"> {{$item->file_name}}</h6>
                        <span class="text-muted">
                            {{$item->created_at->diffForHumans()}}
                        </span>
                    </td>
                    <td class="col_2">
                            {{-- <a href="{{route('panel.orders.delete-img',$item->id)}}" class="btn btn-danger">Delete</a> --}}
                            <a href="{{route('panel.orders.delete-img',$item->id)}}" class="btn btn-danger delete-item">Delete</a>
                            {{-- @dd($item->path); --}}
                            <a download href="{{$item->path}}" class="btn btn-success">Download</a>
                    </td>
                </tr>         
                @empty
                <tr>
                    <td colspan="4">
                        <h6 class="text-danger text-center">No Data Found !</h6>
                    </td>
                </tr>         
                @endforelse
            </tbody>
        </table>
            <div class="card-footer d-flex justify-content-between">
                <div class="pagination">
                    {{ $attachments->appends(request()->except('page'))->links() }}
                </div>
            </div>
    </div>

    
    <div class="col-md-3 col-12 ml-2 ml-lg-0">
        <h6>
           Add Attachments
        </h6>
        <form class="form" action="{{route('panel.orders.fileManager')}}" method="post" enctype="multipart/form-data" class="">
            {{csrf_field()}}
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <div class="form-group">
                    <label>Select Service Document</label>
                    
                    <select required name="document_name" class="form-control">
                        <!--<option value=" "> Select Document</option>-->
                        @if($service_document)
                            @foreach($service_document as $document)
                             <option value="{{$document}}">{{$document}}</option>
                            @endforeach
                        @endif
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Document File</label>
                    <input required type="file" class="" name="files[]" id="customFile" class="form-control" multiple="multiple">
                    <button type="submit" class="btn btn-primary mt-2">Upload</button>
                </div>
              </form>
              
        </form>
    </div>
</div>
