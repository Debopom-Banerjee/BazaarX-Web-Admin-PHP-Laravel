@extends('backend.layouts.main') 
@section('title', 'Refer & Earn')
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
        ['name'=>'Refer & Earn', 'url'=> "javascript:void(0);", 'class' => 'active']
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
                            <h5>Refer & Earn</h5>
                            <span>List of Refer & Earn</span>
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
                            <h3>Refer & Earns</h3>
                        </div>
                        <div id="ajax-container">
                            @include('user.include.referral')
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

