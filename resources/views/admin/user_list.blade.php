@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{trans('admin.user_manage')}}</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getUseradd')}}"><i class="fa fa-plus"></i> {{trans('admin.user_add')}}</a>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="display: block;">

                            <table class="table table-hover">
                                <thead>
                                <tr><th>#</th>
                                    <th>{{trans('common.username')}}</th>
                                    <th>{{trans('common.name')}}</th>
                                    <th>{{trans('admin.role')}}</th>
                                    <th>{{trans('common.email')}}</th>
                                    <th>{{trans('common.cell')}}</th>
                                    <th>{{trans('common.status')}}</th>
                                    <th>{{trans('common.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $sub)
                                <tr id="{{$sub['id']}}">
                                    <td>{{$sub['id']}}</td>
                                    <td>{{$sub['username']}}</td>
                                    <td>{{$sub['name']}}</td>
                                    <td title="{{$sub->role->desc}}">{{$sub->role->name}}</td>
                                    <td>{{$sub['email']}}</td>
                                    <td>{{$sub['cell']}}</td>
                                    <td>
                                        @if ($sub['status'] == '1')
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getUserstatus')}}?id={{$sub['id']}}&s={{$sub['status']}}" style="color:green" title="{{trans('admin.clickunactive')}}">{{trans('common.active')}}</a>] 
                                        @else
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getUserstatus')}}?id={{$sub['id']}}&s={{$sub['status']}}" style="color:red" title="{{trans('admin.clickactive')}}">{{trans('common.unactive')}}</a>] 
                                        @endif 
                                    </td>
                                    <td>[<a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getUseredit')}}?id={{$sub['id']}}">{{trans('common.edit')}}</a>] </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</div>
@stop