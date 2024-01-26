@extends('backend.layouts.main') 
@section('title', 'Ticket')
@section('content')
@push('head')
<script src="{{ asset('backend/plugins/DataTables/datatables.min.js') }}"></script>
@endpush

@php
$breadcrumb_arr = [
    ['name'=>'Ticket', 'url'=> route('panel.admin.ticket.index'), 'class' => ''],
    ['name'=>'View Ticket', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('View Ticket')}}</h5>
                            <span>{{ __('View a record for Ticket')}}</span>
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
            <div class="col-md-12 col-lg-6 mx-auto">
                {{-- <div class="card ">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Ticket Details of {{ $ticket->title }} <span class="badge badge-primary">{{fetchFirst('App\Models\Category',$ticket->ticket_type_id,'name','--') }}</span>
                            
                    </h3>
                        <div class="d-flex">
                            <div>
                                @if ($ticket->is_closed == 1)
                                    <span class="rounded-pill badge badge-lg badge-success mr-2">{{ 'Active' }}</span>
                                @else
                                    <span class="rounded-pill badge badge-lg badge-danger mr-2">{{ 'Closed' }}</span>
                                @endif
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    <li class="dropdown-item p-0"><a href="{{ route('panel.admin.ticket.edit', $ticket->id) }}" title="Edit Ticket" class="btn btn-sm">Edit Ticket</a></li>
                                    <li class="dropdown-item p-0"><a href="javascript:void(0);" title="Make Client Reply"  data-toggle="modal" data-target="#clientReplyModal" class="btn btn-sm">Client Reply</a></li>
                                    @if ($ticket->is_closed == 1)
                                        <li class="dropdown-item p-0"><a href="{{ route('panel.admin.ticket.update.status', [$ticket->id, 0]) }}" title="Mark As Active" class="btn btn-sm">Mark As Closed</a></li>
                                    @else
                                        <li class="dropdown-item p-0"><a href="{{ route('panel.admin.ticket.update.status', [$ticket->id, 1]) }}" title="Mark As Closed" class="btn btn-sm">Mark As Active</a></li>
                                    @endif
                                    <li class="dropdown-item p-0"><a href="{{ route('panel.admin.ticket.delete', $ticket->id) }}" title="Delete Ticket" class="btn btn-sm delete-item">Delete</a></li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                    <div class="py-2" style="background-color:rgb(40, 40, 120);">
                        <div class="d-flex justify-content-around">
                            <div class="mr-3" style="font-size:16px; color:aliceblue;"><span style="color: antiquewhite">Client: </span>{{ $ticket->client_name }}</div>
                            <div class="mr-3" style="font-size:16px; color:aliceblue;"><span style="color: antiquewhite">Created At:</span> {{ getFormattedDate($ticket->created_at) }}</div>
                            <div class="mr-3" style="font-size:16px; color:aliceblue;"><span style="color: antiquewhite">Ticket Type:</span> {{fetchFirst('App\Models\Category',$ticket->ticket_type_id,'name','--') }}</div>
                            <div class="mr-3" style="font-size:16px; color:aliceblue;"><span style="color: antiquewhite">Assign To :</span> {{ NameById($ticket->assigned_to) ?? '--'}}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach (fetchGet('App\Models\TicketConversation', 'where', 'ticket_id', '=',$ticket->id) as $index => $item)
                        <div>
                            <div class="pl-5 ml-3 mt-2 d-flex justify-content-between">
                                <div class="row">
                                    <div class="col-md-4 pl-0">
                                        <img class="rounded-circle" width="35" style="object-fit: cover; width: 35px; height: 35px" src="{{ ($item->user_id && fetchFirst('App\User',$item->user_id,'avatar') != 'Not Available!') ? asset('storage/backend/users/'.fetchFirst('App\User',$item->user_id,'avatar')) : asset('backend/default/default-avatar.png') }}" alt=""><br>
                                        <small class="ml-2 mt-3 text-right">{{ getFormattedDate($item->created_at) }}</small>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex">
                                            <strong>{{ NameById($item->user_id) }}</strong>
                                            <p class="ml-4">{{  $item->comment }}</p>
                                        </div>
                                    </div>
                                </div> 
                                <a href="{{ route('panel.admin.ticket_conversation.delete', $item->id) }}" title="Delete Ticket" class="btn btn-sm btn-icon btn-danger delete-item"><i class="ik ik-trash"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> --}}

                <div class="card m-0 mb">
                    <div class="card-header pb-0">
                       <h5>Ticket Information:</h5> 
                    </div>
                    <div class="card-body p-2 pb-3 m-0">

                        <div class="mb-0">
                            <table class="table table-striped mb-0">
                                <tbody>
                                    
                                    <tr>
                                        <th colspan="2">Customer Name:</th>
                                        <td colspan="2">{{ $ticket->client_name ?? "N\A" }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Customer Email:</th>
                                        <td colspan="2">{{ $ticket->client_email ?? "N\A" }}</td>
                                    </tr>
                                   
                                   
                                    <tr>
                                        <th colspan="2">Comment:</th>
                                        <td colspan="2">{{ $ticket->comment ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">   
                                <form action="{{ route('panel.admin.ticket_conversation.store') }}" method="post">                                 
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <input type="hidden" name="user_id" value="{{ $ticket->user_id }}">
                                    <div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
                                        <label for="comment" class="control-label">{{ 'Admin Reply' }}</label>
                                        <textarea class="form-control" rows="5" name="comment" type="textarea" id="comment" placeholder="Send Your Reply" required>{{ isset($ticket->comment) ? $ticket->comment : ''}}</textarea>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary"><i class="ik ik-navigation"></i> Send reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 mx-auto">
                <div class="card chat-card">
                    <div class="card-header d-flex justify-content-between">
                         <div class="d-flex">
                            <h3 class="mr-2">#TICID{{ $ticket->id }}  </h3>
                            <div><span class="mr-2 badge badge-{{ getEnquiryStatus($ticket->status)['color'] }}">{{ getEnquiryStatus($ticket->status)['name'] }}</span>
                            </div>
                        </div>

                        <div class="d-flex">

                            @if(AuthRole() != "Admin")
                        <a class="btn btn-success mr-2" data-toggle="modal" data-target="#makeOrder"  href="javascript:void(0)">Create Custom Order</a>
                        @endif

                            @if($ticket->status != 1)
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    <li class="dropdown-item p-0"><a href="{{ route('panel.admin.ticket.edit', $ticket->id) }}" title="Update Status" class="btn btn-sm">Update Status</a></li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="py-2" style="background-color:rgb(40, 40, 120);">
                        <div class="d-flex justify-content-around">
                            <div class="mr-3" style="font-size:16px; color:aliceblue;"><span style="color: antiquewhite">Customer: </span>{{ $ticket->client_name }}</div>
                            <div class="mr-3" style="font-size:16px; color:aliceblue;"><span style="color: antiquewhite">Created At:</span> {{ getFormattedDate($ticket->created_at) }}</div>
                        </div>
                    </div>
                    
                    <div class="card-body scroll">
                        <div class="row my-1 chat">
                            @foreach (App\Models\UserConversation::where('type',"Enquiry")->where('type_id',$ticket->id)->get() as $index => $item)
                                @if ($item->user_id == auth()->id())
                                    <div class="col-md-11 py-2 chat-right mb-1">
                                            <div class="p-0 m-0">
                                                <span>
                                                    {{  $item->comment }}
                                                </span>
                                            </div>
                                            <small class="text-muted">{{ getFormattedDate($item->created_at) }}</small>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{ route('panel.admin.ticket_conversation.delete', $item->id) }}" title="Delete Enquiry" class="btn mt-2 btn-sm btn-icon btn-outline-danger delete-item"><i class="ik ik-trash"></i></a>
                                    </div>
                                @else
                                    <div class="col-md-11 py-2 chat-left mb-1">
                                            <div class="p-0 m-0">
                                                <span>
                                                    {{  $item->comment }}
                                                </span>
                                            </div>
                                            <small class="text-muted">{{ getFormattedDate($item->created_at) }}</small>
                                    </div>
                                @endif
                            @endforeach
                        </div> 
                        <div class="msg-card"></div>
                    </div>
                    <div class="card-footer">
                        
                            <div class="row">
                                <div class="col-md-12 col-lg-12">   
                                    <form action="#" method="post" class="ChatForm">                                 
                                        @csrf
                                        <input type="hidden" name="type_id" value="{{ $ticket->id }}" id="groupId">
                                        <input type="hidden" name="type" value="{{ 'Enquiry' }}" >
                                        <div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
                                            <label for="comment" class="control-label">{{ 'Reply' }}</label>
                                            <textarea class="form-control" rows="3" name="comment" id="message" type="textarea" placeholder="Send Your Reply" required>{{ isset($ticket->comment) ? $ticket->comment : ''}}</textarea>
                                        </div>
                                        <div class="form-group text-right mb-0">
                                            <button type="submit" class="btn btn-primary chat-btn"><i class="ik ik-navigation"></i> Send reply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Note Edit form --}}
    <div class="modal fade" id="clientReplyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Client Reply')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('panel.admin.ticket_conversation.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <input type="hidden" name="client_name" value="{{ $ticket->client_name }}">
                        <input type="hidden" name="client_email" value="{{ $ticket->client_email }}">
                        <div class="row">
                            <div class="col-md-12 mx-auto">
                                <div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
                                    <label for="comment" class="control-label">{{ 'Reply' }}</label>
                                    <textarea class="form-control" rows="5" name="comment" type="textarea" id="comment" placeholder="Enter Reply" required>{{ isset($note->comment) ? $note->comment : ''}}</textarea>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Note Modal End --}}
    <!-- push external js -->
    <script>
        $(document).ready(function() {

            var table = $('#ticket_table').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedHeader: true,
                scrollX: false,
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': ['nosort']
                }],
                dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                buttons: [
                    'colvis',
                    {
                        extend: 'copy',
                        className: 'btn-sm btn-info',
                        header: false,
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-sm btn-success',
                        header: false,
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-sm btn-warning',
                        header: true,
                        footer: true,
                        exportOptions: {
                            columns: ':visible',
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-sm btn-primary',
                        header: false,
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-sm btn-default',
                        header: true,
                        footer: false,
                        orientation: 'landscape',
                        exportOptions: {
                            columns: ':visible',
                            stripHtml: false
                        }
                    }
                ]

            });
        });
    </script>
@endsection
