@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
        @foreach ($list as $item)
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{$item['name']}}</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="display: block;">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{trans('common.name')}}</th>
                                    <th>{{trans('common.desc')}}</th>
                                    <th>{{trans('admin.inmenu')}}</th>
                                    <th>{{trans('common.status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($item['list'] as $sub)
                                <tr id="{{$sub['id']}}">
                                    <td>{{$sub['name']}}</td>
                                    <td>{{$sub['desc']}}</td>
                                    <td>
                                        @if ($sub['menu'] == '1')
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getPermenu')}}?id={{$sub['id']}}&i={{$sub['menu']}}" style="color:green" title="{{trans('admin.clickhide')}}">{{trans('admin.show')}}</a>] 
                                        @else
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getPermenu')}}?id={{$sub['id']}}&i={{$sub['menu']}}" style="color:red" title="{{trans('admin.clickshow')}}">{{trans('admin.hide')}}</a>]
                                        @endif 
                                    </td>
                                    <td>
                                        @if ($sub['status'] == '1')
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getPeract')}}?id={{$sub['id']}}&s={{$sub['status']}}" style="color:green" title="{{trans('admin.clickunactive')}}">{{trans('common.active')}}</a>]
                                        @else
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminManagerController@getPeract')}}?id={{$sub['id']}}&s={{$sub['status']}}" style="color:red" title="{{trans('admin.clickactive')}}">{{trans('common.unactive')}}</a>]
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
        @endforeach
</div>
@stop