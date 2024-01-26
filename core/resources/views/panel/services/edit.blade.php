
@extends('backend.layouts.main')
@section('title', 'Service')
@section('content')
@php
/**
* Service
*
* @category  zStarter
*
* @ref  zCURD
* @author    Defenzelite <hq@defenzelite.com>
* @license  https://www.defenzelite.com Defenzelite Private Limited
* @version  <zStarter: 1.1.0>
* @link        https://www.defenzelite.com
*/
$breadcrumb_arr = [
    ['name'=>'Edit Service', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
        }
    </style>
    @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Edit Service</h5>
                            <span>Update a record for Service</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('backend.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
                @include('backend.include.message')
            <!-- end message area-->
            <form action="{{ route('panel.services.update',$service->id) }}" method="post" enctype="multipart/form-data" id="ServiceForm" class="row">
                @csrf
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header">
                            <h3>Update Service</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label for="title" class="control-label">Title<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="title" type="text" id="title" value="{{$service->title }}" onChange="return slugConvert();" onBlur="return slugConvert();">
                                        <input name="slug" type="hidden" id="slug" value="{{$service->slug}}" >
                                    </div>
                                </div>

                                {{-- category --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                                        <label for="category_id" class="control-label">Category<span class="text-danger">*</span> </label>
                                        <select name="category_id" id="category_id" class="form-control select2">
                                            <option value="" readonly>Select Category</option>
                                            @foreach (App\Models\Category::where('category_type_id',15)->get() as $item)
                                                <option value="{{$item->id}}" @if ($item->id == $service->category_id) selected @endif>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--sub category --}}

                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('sub_category_id') ? 'has-error' : ''}}">
                                        <label for="sub_category_id" class="control-label">Sub Category</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                                {{-- price --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                        <label for="price" class="control-label">Price<span class="text-danger">*</span> </label>
                                        <input required   class="form-control" name="price" type="number" step="any" id="price" value="{{$service->price }}">
                                    </div>
                                </div>
                                {{-- mrp --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('mrp') ? 'has-error' : ''}}">
                                        <label for="mrp" class="control-label">MRP</label>
                                        <input   class="form-control" name="mrp" type="number" step="any" id="mrp" value="{{$service->mrp }}">
                                    </div>
                                </div>
                                {{-- banner --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('web_banner') ? 'has-error' : ''}}">
                                        <label for="web_banner" class="control-label">Banner(Web)
                                        </label>
                                        <input class="form-control" name="web_banner_file" type="file" id="web_banner">
                                        <img id="web_banner_file" src="{{ asset($service->web_banner) }}" class="mt-2" style="border-radius: 10px;width:100px;height:80px;"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('banner') ? 'has-error' : ''}}">
                                        <label for="banner" class="control-label">Banner(App)
                                        </label>
                                        <input class="form-control" name="banner_file" type="file" id="banner">
                                        <img id="banner_file" src="{{ asset($service->banner) }}" class="mt-2" style="border-radius: 10px;width:100px;height:80px;"/>
                                    </div>
                                </div>
                                {{-- permission --}}
                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('permission') ? 'has-error' : ''}}">
                                        <label for="permission" class="control-label">Permission</label>
                                        <input   class="form-control" name="permission" type="text" id="permission" value="{{$service->permission }}">
                                    </div>
                                </div> --}}
                                @php
                                $permission = (object)$service->permission;
                                @endphp
                                {{-- @dump($permission->chat) --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group {{ $errors->has('permission') ? 'has-error' : ''}}">
                                        <label for="permission" class="control-label">Permission</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="chat" value="1" checked disabled>
                                            <label class="form-check-label" for="inlineCheckbox1">Chat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="attachment" value="1"
                                            {{$permission->attachment == 1 ? 'checked':'' }}
                                            >
                                            <label class="form-check-label" for="inlineCheckbox2">Attachment</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="portfolio" value="1"
                                            {{$permission->portfolio == 1 ? 'checked':'' }}
                                            >
                                            <label class="form-check-label" for="inlineCheckbox3">Portfolio</label>
                                        </div>
                                        {{-- <select name="country" id="country" class="form-control select2 select2-hidden-accessible"style="width: 100%;" aria-hidden="true">
                                            <option value="" readonly="" >Chat</option>
                                            <option value="1">Attachment</option>
                                        </select>   --}}
                                    </div>
                                </div>
                                {{-- publish --}}
                                <div class="col-6 pl-0">
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="is_publish">Is Publish</label>
                                            <input type="checkbox" name="is_publish" class="js-switch switch-input" value="1" @if($service->is_publish) checked @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="is_featured">Is Featured</label>
                                            <input type="checkbox" name="is_featured" class="js-switch switch-input" value="1" @if($service->is_featured) checked @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="is_flagship">Is Flagship</label>
                                            <input type="checkbox" name="is_flagship" class="js-switch switch-input" value="1" @if($service->is_flagship) checked @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="_rate">Is Dynamic Rate</label>
                                            <input type="checkbox" name="is_dynamic_rate" class="js-switch switch-input" value="1"  @if($service->is_dynamic_rate == 1 ) checked @endif>
                                        </div>
                                    </div>
                                </div>
                                {{-- description --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="control-label">Description</label>
                                        <textarea rows="5" class="form-control" name="description" id="description" placeholder="Enter Description">{{$service->description }}</textarea>
                                    </div>
                                </div>

                                {{-- Benefits --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="benefits" class="control-label">Benefit </label>
                                        <textarea rows="5" class="form-control" name="benefit" id="benefits" placeholder="Enter Benefits">{{$service->benefit}}</textarea>
                                    </div>
                                </div>

                                {{-- Documents --}}
                                
                                <div class="col-12"> 
                                    <div class="form-group">
                                        <label for="documents" class="control-label">Document</label>
                                        <select name="document[]" class="select2 form-control" multiple id="document">
                                            
                                            @if($document_categories)
                                            @foreach ($document_categories as $document)
                                                <option value="{{$document->id}}" @if ($service->document!= null && is_array($service->document) && in_array($document->id,$service->document)) selected @endif>{{$document->name}}</option>
                                            @endforeach  
                                                
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                
                                
                                {{-- Affiliate Type --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="affiliation_type" class="control-label">Affiliate Type</label>
                                        <select name="affiliation_type" id="affiliation_type" class="form-control select2">
                                                <option value="Flat" @if ($service->affiliation_type == 'Flat') selected @endif>Flat Amount</option>
                                                <option value="Percent" @if ($service->affiliation_type == 'Percent') selected @endif>Percentage Based</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Affiliate Value --}}
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('affiliation_value') ? 'has-error' : ''}}">
                                        <label for="affiliation_type" class="control-label">Affiliate Value </label>
                                        <input class="form-control" name="affiliation_value" type="number" step="any" id="affiliation_value" value="{{$service->affiliation_value}}" placeholder="Enter value">
                                    </div>
                                </div>

                                {{-- Deliverable --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deliverable" class="control-label">Deliverable </label>
                                        <textarea rows="5" class="form-control" name="deliverable" id="deliverable" placeholder="Enter deliverable">{{$service->deliverable}}</textarea>
                                    </div>
                                </div>
                                
                                    {{-- Affiliate Description --}}
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('affiliation_desc') ? 'has-error' : ''}}">
                                        <label for="affiliation_desc" class="control-label">Affiliate Description </label>
                                        <textarea rows="5" class="form-control" name="affiliation_desc" id="affiliation_desc" placeholder="Enter description">{{$service->affiliation_desc}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="position:sticky;top:0;">
                        <div class="card-header">
                            <h3>Additional Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label class="control-label">Decide Service Period (in days)</label>
                                        <input value="{{ $service->service_duration ?? 7 }}" class="form-control" name="service_duration" type="number">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label class="control-label">Affilate Sharable Content
                                        </label>
                                        <textarea class="form-control"  name="affilate_sharable_content">{{ $service->affilate_sharable_content }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label class="control-label">Promotional Banner</label>
                                        <input multiple class="form-control" name="promotional_banner[]" type="file" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                    @if (!empty($medias))
                                        @foreach ($medias as $media)
                                            <img src="{{ $media->path }}" class="w-25 mt-3 mr-3" alt="image" srcset="">
                                            <a href="{{ route('panel.services.delete-media',$media->id) }}" class="btn btn-icon  btn-outline-danger delete-item mr-3"><i class="fa fa-trash"></i></a>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 mt-2 text-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{asset('backend/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{asset('backend/js/form-advanced.js') }}"></script>
    <script>
        function slugConvert() {
            var a = document.getElementById("title").value;
        
            var b = a.toLowerCase().replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
        
            document.getElementById("slug").value = b;
        }
            $('#ServiceForm').validate();

                document.getElementById('banner').onchange = function () {
                    var src = URL.createObjectURL(this.files[0])
                    $('#banner_file').removeClass('d-none');
                    document.getElementById('banner_file').src = src
                }
                document.getElementById('web_banner').onchange = function () {
                    var src = URL.createObjectURL(this.files[0])
                    $('#web_banner_file').removeClass('d-none');
                    document.getElementById('web_banner_file').src = src
                }
                
                    document.getElementById('affiliation_type').onchange = function () {
            var affiliation_type = $('#affiliation_type').val();
            if(affiliation_type == 'Percent'){
                $("affiliation_value").attr({
                "max" : 100,        
                "min" : 1         
                });
            }
        }
        function getSubCategory(categoryId =  101) {
            $.ajax({
            url: '{{ route("get-sub-category") }}',
            method: 'GET',
            data: {
                category_id: categoryId
            },
            success: function(res){
                $('#sub_category_id').html(res).css('width','100%').select2();
                var selectedSubCategoryId = "{{$service->sub_category_id}}";
                $('#sub_category_id').val(selectedSubCategoryId).trigger('change.select2');
            }
            })
        }
        $('#category_id').on('change', function(e){
            getSubCategory($(this).val());
        });
        $(document).ready(function(){
            setTimeout(() => {
                $('#category_id').val("{{$service->category_id}}").change();
                $('#sub_category_id').val("{{$service->sub_category_id}}").change();
            }, 500);
        })

    </script>
    @endpush
@endsection
