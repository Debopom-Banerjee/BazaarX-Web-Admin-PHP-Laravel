@extends('backend.layouts.main') 
@section('title', 'Services')
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
        ['name'=>'Services', 'url'=> "javascript:void(0);", 'class' => 'active']
    ]
    @endphp
    <!-- push external head elements to head -->
    @push('head')
    <style>
        .input-group.search, .input-group.search input.search{
            border-top-left-radius: 60px;
            border-bottom-left-radius: 60px;

        }
        .input-group.search, .input-group.search label.search{
            border-top-right-radius: 60px;
            border-bottom-right-radius: 60px;
        }
        .card-block{
            height: 405px;
            overflow-y: auto;
        }
        .card-block::-webkit-scrollbar, .chat-list::-webkit-scrollbar{
            width: 6px;
        }
        .scrollable{
            overflow: auto;
            border-radius: 10px;
        }
        #style-1::-webkit-scrollbar-thumb
        {
            border-radius: 6px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #d5cece;
        }
        #style-1::-webkit-scrollbar
        {
            width: 8px;
            background-color: #F5F5F5;
        }
        .fw-800{
            font-weight: 800;
        }
        .avatar {
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        }
        .dot {
        position: relative;
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        cursor: pointer;
        }
        .date{
            position: relative;
            top:-5px;
        }

        /* lock */
        section {
            display: flex;
            background: #001923;
            justify-content: center;
            align-items: center;
            width: 100%;
            min-height: 60vh;
        }
 
        section .layout {
            position: relative;
            width: 100%;
            max-width: 600px;
            padding: 50px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .1);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 10px;
        }
 
        section .layout::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
 
        section .layout h1 {
            position: relative;
            text-align: center;
        }
 
        section .layout p {
            position: relative;
            color: #fff;
        }
 
        section .layout button {
            position: relative;
        }
        
    </style>
    @endpush

    <div class="container-fluid">
    	<div class="page-header" style="margin-bottom: 5px;">
           <div class="card" style="margin-bottom: 5px;">
            <div class="row align-items-end m-2">
                <div class="col-lg-8 ">
                    <div class="page-header-title">
                        
                        {{-- <i class="ik ik-grid bg-blue"></i> --}}
                        <div class="d-inline">
                            <h5 class="text-primary ">
                                @php 
                                $createDate = new DateTime(now());
                                $currentdate = $createDate->format('Y-m-d');
                                $color = '';
                                 if($order->date > $currentdate){
                                    $dot = 'success';
                                 }
                                 if($order->date == $currentdate) {
                                    $dot = 'warning';
                                 }
                                 if($order->date < $currentdate){
                                    $dot = 'danger';
                                 }
                                @endphp

                                <span class="dot bg-{{$dot}} "
                                 data-toggle="tooltip"
                                  data-placement="left"
                                   title="
                                   @if($order->date > $currentdate)
                                    {{'Service is on time'}}
                                   @endif
                                   @if($order->date == $currentdate)
                                   {{'Today is Deadline'}}
                                  @endif
                                  @if($order->date < $currentdate)
                                  {{'Tentative Deadline Expired '}}
                                 @endif
                                   
                                   "></span>
                                {{  \Str::limit(ucfirst($service->title),55,'...') }}
                            
                            </h5>
                            <div class="d-flex " >
                                <span class="ik ik-clock mt-1" style="font-size: 14px; "></span>
                                <span class="ml-2">
                                    <label class="m-0">
                                        
                                        Order Date: {{$order->date}}
                                        Today: {{$currentdate}}
                                    
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    {{-- @include("backend.include.breadcrumb") --}}
                    <div class="float-right" style="position:relative;"> 
                        <h6><span class="badge badge-{{ getPayoutStatus($order->payment_status)['color'] }}">{{  getPayoutStatus($order->payment_status)['name'] }}</span></h6>
                    </div>
                </div>
            </div>
           </div>
        </div>
    
            <div class="row">
                <div class="col-lg-12 col-md-8" >
                        <div class="card m-0">
                            <div class="card-header d-flex justify-content-between " >
                                <div class="user d-flex" style="position: relative;">
                                    
                                     <a href="#">
                                        {{-- <img class="avatar" src="http://localhost/project/gofinex/public_html/storage/backend/users/profile_image_4781.png" 
                                        style="object-fit: cover; width: 35px; height: 35px" alt=""> --}}
                                        <img class="avatar" src="{{ ($user && $user->avatar) ? asset('storage/backend/users/'.$user->avatar) : asset('backend/default/default-avatar.png') }}" 
                                        style="object-fit: cover; width: 35px; height: 35px" alt="">
                                    </a>
                                     <div class="ml-2 d-flex flex-column">
                                         <span>{{ $user->name }}</span>
                                         <small>{{\Carbon\Carbon::parse($user->updated_at)->diffForHumans()}}</small>
                                     </div>
                             </div>
                                <div class="drop-down">
                                      <form method="post" action="{{route('panel.orders.updateStatus',$order->id)}}"  id="orderStatusForm">
                                    
                                        @csrf
                                            <div class="form-group m-0">
                                                <select name="orderStatus"  id="orderStatus" class="form-control select2 select2-hidden-accessible"style="width: 100%;" aria-hidden="true">
                                    
                                                    <?php foreach (orderStatus() as $key => $value) { ?>
                                                        <option value="{{$value['id']}}" {{$order->status == $value['id'] ? 'selected' : ''}}>{{$value['name']}}</option> 
                                                    <?php   } ?>

                                                </select>   
                                               
                                           </div>
                                      </form>
                                       
                                </div> 
                                
                            </div>
                        </div>
                       
                            <div class="card" style="height:470px;">
                                {{-- tab header start --}}
                                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item " >
                                        <a class="nav-link active" id="pills-chat-tab" data-toggle="pill" href="#chat" role="tab" aria-controls="pills-chat" aria-selected="true">{{ __('Chat')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="pills-attachment-tab" data-toggle="pill" href="#attachment" role="tab" aria-controls="pills-attachment" aria-selected="false">{{ __('Attachment')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="pills-portfolio-tab" data-toggle="pill" href="#portfolio" role="tab" aria-controls="pills-portfolio" aria-selected="false">{{ __('Portfolio')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="pills-detail-tab" data-toggle="pill" href="#detail" role="tab" aria-controls="pills-detail" aria-selected="false">{{ __('Detail')}}</a>
                                    </li>
                                    
                                </ul>
                                {{-- tb header end --}}
                                {{-- <div class="card-header">
                                    <h3>Chat</h3>
                                </div> --}}
                                <div class="tab-content" id="pills-tabContents">    
                                    <div class="tab-pane fade show active" id="chat" role="tabpanel" aria-labelledby="pills-chat-tab">
                                        @if(!isset($workStream))
                                            <div class="card-body">
                                                {{-- chat no intitate --}}
                                                <section>
                                                    <div class="layout">
                                                        <h1 class="text-danger"> Your Chat is Not initialized Yet !</h1>
                                                        
                                                    </div>
                                                </section>

                                            </div>
                                        @else
                                            <div  class="card-body chat-box  card-200" id="style-1"> 
                                                <ul class="chat-list scrollable"  id="chat-list">
                                                    {{-- @foreach ($message as $item) 
                                                        @if ($item->user_id == auth()->id())
                                                            <li class="odd chat-item">
                                                                <div class="chat-content">
                                                                    <h6 class="box bg-gray text-dark p-3" style="background: #F0F0F0">
                                                                    {!! $item->message !!}
                                                                    </h6>
                                                                    <br>
                                                                </div>
                                                                <div class="chat-time">{{ $item->created_at->format('h:i a')}}</div>
                                                            </li>
                                                        @else  
                                                            <li class="chat-item">
                                                                {{-- <div class="chat-img"><img src="{{ asset('backend/img/users/2.jpg') }}" alt="user"></div> 
                                                                <div class="chat-content">
                                                                    <h6 class="font-medium p-0">{{ NameById($item->user_id) }}</h6>

                                                                    <h6 class="box bg-light-info">
                                                                        {!! nl2br($item->message) !!}
                                                                    </h6>
                                                                </div>
                                                                <div class="chat-time mt-2">{{ $item->created_at->format('h:i a')}}</div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul> --}}
                                                
                                            </div>
                                            <div class="card-footer bg-white border-0 mt-3">
                                                <form action="{{ route('panel.services.chat.store') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
                                                    <input type="hidden" name="type" id="type" value="0">
                                                    <input type="hidden" name="workstream_id" id="workstream_id" value="{{ $workStream->id }}">
                                                    <div class="row mt-3">
                                                        <div class="col-md-11">
                                                            <textarea type="text" placeholder="Type here..." name="message" id="message" rows="1" class="form-control" style="background: #F0F0F0;" required></textarea>
                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-center">
                                                            <button type="submit" class="btn btn-icon btn-theme" id="send" style="top: 25px;right:25px;"><i class="fa fa-paper-plane"></i></button>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="input-group input-wrap"> --}}
                                                        {{-- <input type="file" id="imgupload" style="display:none"/> 
                                                        <button id="OpenImgUpload" class="btn btn-accent" style="top: 0; right: 50px" type="button">
                                                            <i class="ik ik-paperclip"></i>
                                                        </button> --}}
                                                    {{-- </div> --}}
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                        <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="pills-attachment-tab">
                                            <div id="ajax-container-attachment">
                                                <iframe src="{{ url('/laravel-filemanager') }}?empty=true" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="pills-portfolio-tab">
                                            
                                               <div class="table-responsive">
                                                    <table id="table" class="table">
                                                        <thead>
                                                            <tr>
                                                                {{-- <th class="no-export">Actions</th>  --}}
                                                                <th  class="text-center no-export">#PID<div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>             
                                                                <th class="col_2"> Title </th>                        
                                                                {{-- <th class="col_4"> Buy Link </th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                             
                                                        <?php
                                                        //  $portfolio_arr=  json_decode($order->service_data);
                                                        //  foreach($portfolio_arr as $key=> $value){ ?>
                                                         {{-- <tr>
                                                            {{-- <td class="no-export">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                                            </td> --}}
                                                            {{-- <td class="text-center no-export">#{{getPrefixZeros($value->id)}}</td>
                                                            <td class="col_2">
                                                                <a class="text-primary" href="{{$value->buy_link != '' ? $value->buy_link : 'javascript:void(0)'}}">{{$value->title}}</a>
                                                            </td> --}}
                                                            {{-- <td class="col_4">
                                                                {{-- <a class="btn btn-outline-primary" href="{{$value->buy_link}}">Click</a> 
                                                                <a class="btn btn-outline-primary" href="https://www.google.com/">Click</a>
                                                            </td> -
                                                         </tr> --}}

                                                        <?php?>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                        </div> 
                                        <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="pills-detail-tab">
                                            <div id="ajax-container-detail">
                                              {{-- <div class="col-lg-12 col-md-12">
                                                <h5>{{ucfirst($service->title)}}</h5>
                                                <div class="d-flex">
                                                    <i class="ik ik-clock" style="font-size: 18px; margin-top:3px"></i>
                                                    @php
                                                    $createDate = new DateTime(now());
                                                    $currentdate = $createDate->format('Y-m-d');
                                                    @endphp
                                                    <span class="ml-2">
                                                        <label class="m-0">Order Date</label><br/>
                                                        {{$order->date}}
                                                    </span>
                                                    <span class="ml-4">
                                                        <label class="m-0">Current Date</label><br/>
                                                        {{$currentdate}}
                                                    </span> 
                                                    @php 
                                                    $color = '';
                                                     if($order->date > $currentdate){
                                                        $dot = 'success';
                                                     }
                                                     if($order->date == $currentdate) {
                                                        $dot = 'warning';
                                                     }
                                                     if($order->date < $currentdate){
                                                        $dot = 'danger';
                                                     }
                                                    @endphp
                                                    <span class="dot bg-{{$dot}}" style="margin:2px 0 0 14px;"></span>
                                                   
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-12 col-md-12 mt-3">
                                                {{-- <h5>Remark:</h5>
                                                <p style="font-size: 15px;">{{$order->remarks}}</p> --}}
                                                <table id="table" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="col_2"> Remark </th>                        
                                                            <th class="col_4"> Value </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="col_2"> Remark </td>                        
                                                            <td class="col_4"> {{$order->remarks}} </td>
                                                        </tr>
                                                   
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>   
                            </div>
                        </div>

                        
                </div>
                <!--  chatbox end -->
            </div>
    </div>
    {{-- model start --}}
    {{-- <button type="button" class="btn btn-primary" id="confirmStatusModel" data-toggle="modal" data-target="#exampleModal">model</button> --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Hands up!</h5>
              <button type="button" id="modelCloseCross" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h6>Are you sure to change the status? </h6>
              <ul>
                <li>
                    <p class="p-0 m-0">
                        It will trigger a notification to user.
                      </p>
                </li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="orderStatusFormSubmitBtn">Confirm</button>
            </div>
          </div>
        </div>
      </div>
      {{-- model end --}}
    <!-- push external js -->
    @include('panel.services.include.attachment')
@endsection
@push('script')
   {{-- for embeded filemanager --}}
   <script>
    //chat box
    $('.scrollable').animate({ scrollTop: $('.scrollable').prop("scrollHeight")}, 10);
    // $(document).ready(function(){
    //     $('#send').click(function(){
    //         $('.scrollable').animate({ scrollTop: $('.scrollable').prop("scrollHeight")}, 1000);
    //     })
    // })



    $(document).ready(function(){
      $('#orderStatus').on('change',function(){
        $('#exampleModal').modal('show');
      })

      $('#modelCloseCross').click(function(){
        $('#exampleModal').modal('hide');
      })

      $('#modelCloseBtn').click(function(){
        $('#exampleModal').modal('hide');
      })
       
      $('#orderStatusFormSubmitBtn').click(function(){
        $('#orderStatusForm').submit()
        $('#exampleModal').modal('hide');
      })
   })
    var lfm = function(id, type, options) {
        let button = document.getElementById(id);

        button.addEventListener('click', function () {
            var route_prefix = (options && options.prefix) ? options.prefix : "{{ url('/laravel-filemanager') }}";
            var target_input = document.getElementById(button.getAttribute('data-input'));
            var target_preview = document.getElementById(button.getAttribute('data-preview'));
           
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
            var file_path = items.map(function (item) {
                return item.url;
            }).join(',');

            // set the value of the desired input to image url
            target_input.value = file_path;
            target_input.dispatchEvent(new Event('change'));

            // clear previous preview
            target_preview.innerHtml = '';

            // set or change the preview image src
            items.forEach(function (item) {
                let img = document.createElement('img')
                img.setAttribute('style', 'height: 5rem')
                img.setAttribute('src', item.thumb_url)
                target_preview.appendChild(img);
            });

            // trigger change event
            target_preview.dispatchEvent(new Event('change'));
            };
        });
    };

    var route_prefix = "url-to-filemanager";
    lfm('lfm', 'image', {prefix: "{{ url('/laravel-filemanager') }}"});
    lfm('lfm2', 'file', {prefix: "{{ url('/laravel-filemanager') }}"});
   
   


</script>
@endpush