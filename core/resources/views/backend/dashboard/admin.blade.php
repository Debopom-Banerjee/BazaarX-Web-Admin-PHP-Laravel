@php
    $statistics_1 = [
        [ 'a' => route('panel.services.index'),'name'=>'Total Service','bg_color'=>'bg-primary', "count"=>App\Models\Service::count(),
        "icon"=>"<i class='ik ik-layers'></i>" ,'col'=>'3', 'color'=> 'primary'],

        [ 'a' => route('panel.orders.index',['today'=>'order']),'name'=>"Today's Order",'bg_color'=>'bg-success', "count"=>App\Models\Order::whereDate('created_at','=',now())->count(),
        "icon"=>"<i class='ik ik-shopping-cart'></i>" ,'col'=>'3', 'color'=> 'primary'],
        [ 'a' => route('panel.users.index'),'name'=>'Total Users', 'bg_color'=>'bg-warning',"count"=>App\User::role('User')->count(), "icon"=>"<i
            class='ik ik-user f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'primary'],
        [ 'a' => route('panel.users.index','?role=Partner'),'name'=>'Total Partner', 'bg_color'=>'bg-teal',"count"=>App\User::role('Partner')->count(), "icon"=>"<i
            class='ik ik-user f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'primary'],
    ];

    $statistics_2 = [
        [ 'a' => route('panel.orders.index',['category_id'=>0]),'name'=>'On Going','text-color'=>1, "count"=>App\Models\Order::whereNotIn('status',[3,4])->count(),
        "icon"=>"<i class='ik ik-play f-24'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>0],
        [ 'a' => route('panel.orders.index',['category_id'=>1]),'name'=>orderStatus(1)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',1)->count(),
        "icon"=>"<i class='ik ik-zap f-24'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>1],
        [ 'a' => route('panel.orders.index',['category_id'=>2]),'name'=>orderStatus(2)['name'], 'text-color'=>1,"count"=>App\Models\Order::where('status','=',2)->count(), "icon"=>"<i
            class='ik ik-file f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'primary',"value"=>2],
        [ 'a' => route('panel.orders.index',['category_id'=>3]),'name'=>orderStatus(3)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',3)->count(), "icon"=>"<i
            class='ik ik-zap-off f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'red',"value"=>3],
        [ 'a' => route('panel.orders.index',['category_id'=>4]),'name'=>orderStatus(4)['name'],'text-color'=>1, "count"=>App\Models\Order::where('status','=',4)->count(), 
        "icon"=>"<i class='ik ik-check-circle f-24'></i>" ,'col'=>'3', 'color'=> 'red',"value"=>4],
    ];

    $statistics_3 = [
    [ 'a' => route('panel.constant_management.article.index'),'name'=>'Total Articles','bg_color'=>'bg-primary', "count"=>App\Models\Article::count(),
    "icon"=>"<i class='ik ik-book-open'></i>" ,'col'=>'3', 'color'=> 'primary'],

    [ 'a' => route('backend.constant-management.sliders.index',["slidertype"=>3]),'name'=>"Total Videos",'bg_color'=>'bg-success', "count"=>App\Models\Slider::where('slider_type_id',3)->count(),
    "icon"=>"<i class='ik ik-youtube'></i>" ,'col'=>'3', 'color'=> 'primary'],
    [ 'a' => route('backend.constant-management.sliders.index',["slidertype"=>2]),'name'=>'Total Sliders', 'bg_color'=>'bg-warning',"count"=>App\Models\Slider::where('slider_type_id',2)->count(), "icon"=>"<i
        class='ik ik-triangle'></i>" ,'col'=>'3', 'color'=> 'primary'],
    // [ 'a' => route('panel.constant_management.article.index'),'name'=>'Total Users', 'bg_color'=>'bg-warning',"count"=>fetchAll('App\Models\Article')->count(), "icon"=>"<i
    // class='ik ik-file f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'primary'],

    // [ 'a' => route('panel.constant_management.user_enquiry.index'),'name'=>'Total Enquiry','bg_color'=>'bg-danger', "count"=>App\Models\UserEnquiry::count(), "icon"=>"<i
    //     class='ik ik-edit f-24 text-mute'></i>" ,'col'=>'3', 'color'=> 'red'],
     ];
  
@endphp

<div class="row clearfix">
    @foreach ($statistics_1 as $item_1)
        <a class="col-lg-3 col-md-6 col-sm-12" href="{{ $item_1['a'] }}">
            <div class="widget {{ $item_1['bg_color'] }}">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>{{ $item_1['name'] }}</h6>
                            <h2>{{ $item_1['count'] }}</h2>
                        </div>
                        <div class="icon">
                            {!! $item_1['icon'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    
</div>

<div class="container-fluid p-0">
    <h4>Order Milestone</h4>
</div>
<div class="row pp-main mb-4">
    @foreach ($statistics_2 as $item_2)
        <div class="col-lg  col-md col-sm-12">
            <a href="{{$item_2['a']}}" class="card card-body">
                <div class="pp-cont">
                    <div class="row align-items-center mb-20">
                        <div class="col-auto">
                            {!! $item_2['icon'] !!}
                        </div>
                        <div class="col text-right">
                            <h2 class="mb-0 text-primary">{{ $item_2['count'] }}</h2>
                        </div>
                    </div>
                    <div class="row align-items-center mb-15">
                        <div class="col-auto">
                            {{-- <p class="mb-0 text-dark" style="font-size: 15px;">{{ $item_2['name'] }}</p> --}}
                            <p class="mb-0 text-dark" style="font-size: 15px;">{{ $item_2['name'] }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>


<div class="container-fluid p-0">
    <h4>Other Statistics</h4>
</div>
<div class="row clearfix">
    @foreach ($statistics_3 as $item_3)
        <a class="col-lg-4 col-md-6 col-sm-12" href="{{ $item_3['a'] }}">
            <div class="widget ">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>{{ $item_3['name'] }}</h6>
                            <h2>{{ $item_3['count'] }}</h2>
                        </div>
                        <div class="icon">
                            {!! $item_3['icon'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    
</div>

  
@push('script')
@endpush
