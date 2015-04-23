@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{trans('admin.jing_manage')}}</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <a href="{{action('\Pianke\Http\Controllers\AdminJingController@getAdd')}}"><i class="fa fa-plus"></i> {{trans('admin.jing_add')}}</a>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="display: block;">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{trans('common.title')}}</th>
                                    <th>{{trans('common.author')}}</th>
                                    <th>{{trans('common.text')}}</th>
                                    <th>{{trans('common.media')}}</th>
                                    <th>{{trans('admin.start')}}</th>
                                    <th>{{trans('common.status')}}</th>
                                    <th>{{trans('common.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $sub)
                                <tr id="{{$sub['id']}}" @if(\Cache::get('jing_lastest') == $sub['id']) style="background-color:#afeeee;" @endif>
                                    <td><a href="{{action('\Pianke\Http\Controllers\JingController@getPlay')}}?id={{$sub['id']}}" target="_blank">{{$sub['title']}}</a></td>
                                    <td>{{$sub['author']}}</td>
                                    <td>{{$sub['text']}}</td>
                                    <td>
                                        <a href="{{$uploads}}{{$sub['audio']}}" target="_blank">{{trans('common.audio')}}</a> 
                                        <a href="{{$uploads}}{{$sub['img']}}" target="_blank">{{trans('common.img')}}</a> 
                                        @if(!empty($sub['video']))
                                        <a href="{{$uploads}}{{$sub['video']}}" target="_blank">{{trans('common.video')}}</a> 
                                        @endif
                                    </td>
                                    <td>{{$sub['start']}}</td>
                                    <td>
                                        @if ($sub['status'] == '1')
                                        <a href="{{action('\Pianke\Http\Controllers\AdminJingController@getStatus')}}?id={{$sub['id']}}&s={{$sub['status']}}" style="color:green" title="{{trans('admin.clickunactive')}}">{{trans('common.active')}}</a>
                                        @else
                                        <a href="{{action('\Pianke\Http\Controllers\AdminJingController@getStatus')}}?id={{$sub['id']}}&s={{$sub['status']}}" style="color:red" title="{{trans('admin.clickactive')}}">{{trans('common.unactive')}}</a>
                                        @endif 
                                    </td>
                                    <td>
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminJingController@getEdit')}}?id={{$sub['id']}}">{{trans('common.edit')}}</a>] 
                                        [<a href="javascript:if(confirm('{{trans('admin.confirmdel')}}'))window.location='{{action('\Pianke\Http\Controllers\AdminJingController@getDel')}}?id={{$sub['id']}}'">{{trans('common.delete')}}</a>] 
                                        [<a href="javascript:if(confirm('{{trans('admin.confirmpush')}}'))window.location='{{action('\Pianke\Http\Controllers\AdminJingController@getPush')}}?id={{$sub['id']}}'">{{trans('admin.push')}}</a>] 
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