@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{trans('admin.role_manage')}}</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getRoleadd')}}"><i class="fa fa-plus"></i> {{trans('admin.role_add')}}</a>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="display: block;">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{trans('common.name')}}</th>
                                    <th>{{trans('common.desc')}}</th>
                                    <th>{{trans('common.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $sub)
                                <tr id="{{$sub['id']}}">
                                    <td>{{$sub['name']}}</td>
                                    <td>{{$sub['desc']}}</td>
                                    <td>
                                        [<a data-container="body" data-toggle="popover" data-placement="left" data-content="
                                        @foreach ($sub->users as $user)
                                            {{$user->username}}-{{$user->name}} , 
                                        @endforeach
                                        @if (count($sub->users)==0)
                                            {{trans('admin.nomember')}}
                                        @endif
                                        " data-original-title="" title="" aria-describedby="popover{{$sub['id']}}">{{trans('admin.rolesuser')}}({{count($sub->users)}})</a>] 
                                        @if(!in_array($sub['id'],[1,2]))
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getRoleedit')}}?id={{$sub['id']}}">{{trans('common.edit')}}</a>] 
                                        [<a href="javascript:if(confirm('确认删除吗?'))window.location='{{action('\Pianke\Http\Controllers\AdminManagerController@getRoledel')}}?id={{$sub['id']}}'">{{trans('common.delete')}}</a>]
                                        @endif
                                    </td>
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