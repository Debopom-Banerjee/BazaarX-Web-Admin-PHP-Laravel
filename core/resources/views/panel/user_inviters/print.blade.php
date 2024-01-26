@extends('backend.layouts.empty') 
@section('title', 'User Inviters')
@section('content')
@php
/**
 * User Inviter 
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
   

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">                     
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                                <tr>                                      
                                    <th>User Id</th>
                                    <th>Inviter Id</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($user_inviters->count() > 0)
                                    @foreach($user_inviters as  $user_inviter)
                                        <tr>
                                            <td>{{$user_inviter['user_id'] }}</td>
                                             <td>{{$user_inviter['inviter_id'] }}</td>
                                                 
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">No Data Found...</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
