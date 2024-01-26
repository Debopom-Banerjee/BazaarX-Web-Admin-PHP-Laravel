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
                            <h5>{{ request()->get('role') ?? ''}}</h5>
                            <span>{{ __('List of ')}}{{ request()->get('role') ?? ''}}</span>
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
                                <a href="#">{{ request()->get('role') ?? ''}}</a>
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
                        <h3>{{ request()->get('role') ?? ''}}</h3>
                        <form action="{{ route('panel.users.index') }}" id="requirementCategoryForm" method="GET" id="TableForm">
                            <div class="d-flex justicy-content-right">
                                
                                {{-- <div class="form-group mr-2">
                                    <span>Status:</span>
                                    <label for="status">
                                        <select required name="status" class="form-control select2">
                                            @foreach (getStatus() as $index => $item)
                                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option> 
                                            @endforeach
                                        </select>
                                    </label>
                                </div>  --}}
                                    
                                <div class="form-group mb-0 mr-2">
                                    <span>From:</span>
                                <label for=""><input type="date" name="from" class="form-control" value="{{request()->get('from')}}"></label>
                                </div>
                                <div class="form-group mb-0 mr-2"> 
                                    <span>To:</span>
                                        <label for=""><input type="date" name="to" class="form-control" value="{{request()->get('to')}}"></label> 
                                </div>
                                <button type="submit" class="btn btn-icon btn-sm mr-2 btn-outline-warning" title="Filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                                <a href="javascript:void(0);" id="reset" data-url="{{ route('panel.users.index') }}" class="btn btn-icon btn-sm btn-outline-danger mr-2" title="Reset"><i class="fa fa-redo" aria-hidden="true"></i></a>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                    <div id="ajax-container">
                        @include('user.load')
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
