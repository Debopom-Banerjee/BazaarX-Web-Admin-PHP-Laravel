@extends('backend.layouts.main') 
@section('title', 'Users')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <style>
            .select2-selection.select2-selection--single{
                width: 175px !important;
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
                            <h5>Transactions</h5>
                            <span>List of Transactions</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('panel.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Transactions</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex  justify-content-between">
                        <h3>Transactions</h3>
                    </div>
                    <div class="card-body">
                       <div id="ajax-container">
                           @include('user.load-balance')
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.modal.add-user-wallet')
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('backend/js/index-page.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js" integrity="sha512-BaXrDZSVGt+DvByw0xuYdsGJgzhIXNgES0E9B+Pgfe13XlZQvmiCkQ9GXpjVeLWEGLxqHzhPjNSBs4osiuNZyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
           $(document).on('click','.walletLogButton',function(){
                var user_record = $(this).data('id');
                $('#uuid').val(user_record);
                $('#walletModal').modal('show');
            });
           function html_table_to_excel(type)
            {
                var table_core = $("#user_table").clone();
                var clonedTable = $("#user_table").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#user_table").html(clonedTable.html());
                // console.log(clonedTable.html());
                var data = document.getElementById('user_table');

                var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
                XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
                XLSX.writeFile(file, 'UserFile.' + type);
                $("#user_table").html(table_core.html());
            }

            $(document).on('click','#export_button',function(){
                html_table_to_excel('xlsx');
            });
            
            $(document).on('click','#print_page',function(){
                // var data = $('#print_page').attr('data-rows'); 
                // console.log(data);
                $("#user_table").print();
            });
            
            $('#reset').click(function(){
                getData("{{ route('panel.admin.lead.index') }}");
                window.history.pushState("", "", "{{ route('panel.admin.lead.index') }}");
                $('#TableForm').trigger("reset");
                $('#lead_type_id').select2('val',"");           // if you use any select2 in filtering uncomment this code
                $('#lead_type_id').trigger('change');           // if you use any select2 in filtering uncomment this code
            });

            $('#getDataByRole').change(function(){
                if(checkUrlParameter('role')){
                    url = updateURLParam('role', $(this).val());
                }else{
                    url =  updateURLParam('role', $(this).val());
                }
                getData(url);
            });
            
       
    </script>
  
    @endpush
@endsection
