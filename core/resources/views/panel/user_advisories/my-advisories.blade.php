
@extends('backend.layouts.empty') 
@section('title', 'User Advisory')
@section('content')
@php
/**
 * User Advisory 
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
      }
        .parentForm:not(:first-of-type) {
            display: none
      }
        table {
        table-layout: fixed;
        width: 100%;
      }
      .wrapper .page-wrap .main-content{
        background-color: #fff;
      }
    </style>
    @endpush

    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12"> 
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-12">
                            <div class="page-header-title">
                                <i class="ik ik-grid bg-blue"></i>
                                <div class="d-inline">
                                    <h5>My Advisories</h5>
                                    <span>List of My Advisories</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <ul class="list-unstyled p-0">
                    @foreach($my_advisory_records as $my_advisory_record)
                    @php
                        $user_data = json_decode($my_advisory_record->user_detail);
                    @endphp
                    <li class="mb-3">
                        <div class="card card-body" style="background-color: #efefef;">
                            <div class="row" >
                                <div class="col-9 pl-15 pt-1 text-left">
                                    <h6 class="mb-0 pb-1"> 
                                        <i class="ik ik-user"></i> <a class="pr-0" href="{{route('user-advisory.show',$my_advisory_record->id)}}">{{$user_data->name ?? ''}}</a>
                                    </h6>
                                    <span class="pb-1"><i title="incoming request" class="ik pr-1  ik-corner-up-left"></i>#{{getPrefixZeros($my_advisory_record->user_id)}}</span>
    
                                    <br>
                                    <span class="pb-1"><i class="ik ik-clock"></i> {{getFormattedDate($my_advisory_record->created_at)}}</span>
                                </div>
                                <div class="col-3 d-flex justify-content-end">
                                    <span><a class="pr-0" href="{{route('user-advisory.show',$my_advisory_record->id)}}"><i class="fa-solid fa-arrow-right"></i></a></span>
                                    {{-- <button style="background: transparent;margin-left: -10px;" class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        <a href="{{route('user-advisory.show',$my_advisory_record->id)}}" title="Delete Proposal" class="dropdown-item ">
                                            <li class=" p-0">Advisory Show</li>
                                        </a>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>        
        </div>
    </div>
@endsection