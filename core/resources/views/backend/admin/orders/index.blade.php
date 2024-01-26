  @extends('backend.layouts.main') 
@section('title', 'Orders')
@section('content')
@php
/**
 * Order 
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
        ['name'=>'Orders', 'url'=> "javascript:void(0);", 'class' => 'active']
    ]
    @endphp
    <!-- push external head elements to head -->
    @push('head')
    @endpush
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{$type}} Orders</h5>
                            <span>List of Orders</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("backend.include.breadcrumb")
                </div>
            </div>
        </div>
        
        <form action="{{ route('panel.orders.index') }}" id="serviceCategoryForm" method="GET" id="TableForm">
            <input type="hidden" value="{{request()->get('type')}}" name="type">
            <div class="row">
                <!-- start message area-->
                <!-- end message area-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap justify-content-between">
                            <h3>{{$type}} Orders</h3>
                            <div class="d-flex flex-wrap justify-content-right">
                                <div class="form-group mb-0 mr-2">
                                    <span>From</span>
                                <label for=""><input type="date" id="from" name="from" class="form-control" value="{{request()->get('from')}}"></label>
                                </div>
                                <div class="form-group mb-0 mr-2"> 
                                    <span>To</span>
                                        <label for=""><input type="date" name="to" class="form-control" value="{{request()->get('to')}}"></label> 
                                </div>
                                @if(request()->get('type') == 'Service')
                                    <div class="form-group mb-0 mr-2">
                                        <select name="category_id" id="" class="form-control select2">
                                            <option value="0" readonly>Select Category</option>
                                            @foreach (orderStatus() as $item)
                                            <?php $cat_id = $_GET['category_id'] ?? 0; ?>
                                                <option value="{{$item['id']}}" name="{{ $item['name']}}" {{ $cat_id == $item['id'] ? 'selected':'' }}>
                                                {{$item['name']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> 
                                    @endif
                                    <div class="form-group mb-0 mr-2">
                                        <select name="payment_status" id="" class="form-control select2">
                                            <option value="" readonly>Select Payment Status</option>
                                                <option value="1" name="payment_status" @if(request()->has('payment_status') && request()->get('payment_status') == 1) selected @endif>
                                                Unpaid
                                                </option>
                                                <option value="2" name="payment_status" @if(request()->has('payment_status') && request()->get('payment_status') == 2) selected @endif>
                                                Paid
                                                </option>
                                        </select>
                                    </div>   
                                    <button type="submit" class="btn btn-icon btn-sm mr-2 btn-outline-warning" title="Filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                                    <a href="{{ route('panel.orders.index') }}" id="reset" data-url="{{ route('panel.orders.index') }}" class="btn btn-icon btn-sm btn-outline-danger mr-2" title="Reset"><i class="fa fa-redo" aria-hidden="true"></i></a>
                                    @if(request()->get('type') == 'Service')
                                        <a href="{{ route('panel.orders.create') }}" class="btn btn-icon btn-sm btn-outline-primary mr-2" title="Add New"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    @endif
                            </div>
                        </div>
                        <div id="ajax-container">
                            @if($type == 'Lead')
                                @include('backend.admin.orders.lead-load')
                            @else
                                @include('backend.admin.orders.load')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        <form>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{asset('backend/js/index-page.js')}}"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
   
        <script>
            function html_table_to_excel(type)
            {
                var table_core = $("#table").clone();
                var clonedTable = $("#table").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#table").html(clonedTable.html());
                var data = document.getElementById('table');

                var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
                XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
                XLSX.writeFile(file, 'OrderFile.' + type);
                $("#table").html(table_core.html());
                
            }

            $(document).on('click','#export_button',function(){
                html_table_to_excel('xlsx');
            })
        
        
            $(document).on('click','.asc',function(){
                var val = $(this).data('val');
                if(checkUrlParameter('asc')){
                url = updateURLParam('asc', val);
                }else{
                url =  updateURLParam('asc', val);
                }
                getData(url);
            });
            $(document).on('click','.desc',function(){
                var val = $(this).data('val');
                if(checkUrlParameter('desc')){
                url = updateURLParam('desc', val);
                }else{
                url =  updateURLParam('desc', val);
                }
                getData(url);
            });

            $('#reset').click(function(){
                var url = $(this).data('url');
                getData(url);
                window.history.pushState("", "", url);
                $('#TableForm').trigger("reset");
                //   $('#fieldId').select2('val',"");               // if you use any select2 in filtering uncomment this code
            // $('#fieldId').trigger('change');                  // if you use any select2 in filtering uncomment this code
            });

            $(document).on('click', '.mark-as-paid', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var msg = $(this).data('msg') ?? "You won't be able to revert back!";
                $.confirm({
                    draggable: true,
                    title: 'Are You Sure!',
                    content: msg,
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: 'Mark as paid',
                            btnClass: 'btn-red',
                            action: function () {
                                window.location.href = url;
                            }
                        },
                        close: function () {
                        }
                    }
                });
            });
            $(document).on('click', '.mark-as-unpaid', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var msg = $(this).data('msg') ?? "You won't be able to revert back!";
                $.confirm({
                    draggable: true,
                    title: 'Are You Sure!',
                    content: msg,
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: 'Mark as unpaid',
                            btnClass: 'btn-red',
                            action: function () {
                                window.location.href = url;
                            }
                        },
                        close: function () {
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection

