

<div class="row">
    <div class="col-md-9 col-12">
        <table id="table" class="table">
            <thead>
                <tr> 
                    <th  class="col_2">#AID<div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>             
                    <th class="col_2"> Name </th>         
                    <th class="col_2">Category</th>         
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
                    <td>{{fetchFirst('App\Models\Category',$item->category_id,'name','--')}}</td>
                    <td class="col_2">
                            <a title="Delete" href="{{route('panel.orders.delete-img',$item->id)}}" class="btn btn-danger delete-item btn-icon"><i class="fa fa-trash"></i></a>
                            <a title="Download" download href="{{$item->path}}" class="btn btn-success btn-icon"><i class="fa fa-download"></i></a>
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

    
    <div class="col-md-3 col-12 ml-2 ml-lg-0 border p-3">
        <h6 class="fw-700">
           Add Attachments
        </h6>
        <form class="form" action="{{route('panel.orders.fileManager')}}" method="post" enctype="multipart/form-data" class="">
            {{csrf_field()}}
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <div class="form-group">
                    <label>Document <span class="text-danger">*</span></label>
                    <input style="width: 100%" required type="file" class="" name="files[]" id="customFile" class="form-control" multiple="multiple">
                </div>
                <div class="form-group">
                    <label>Category <span class="text-danger">*</span></label>
                    <select required name="category_id" id="" class="form-control select2">
                        <option value="" readonly>Select Category</option>
                        @foreach (App\Models\Category::where('category_type_id',23)->get() as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-2">Upload Attachment</button>
              </form>
              
        </form>
    </div>
</div>
