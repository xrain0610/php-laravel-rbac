@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{trans('admin.link_list')}} - {{trans('admin.allcount')}}[IOS: {{\Redis::connection('counter')->get('download_ios_all')}} ANDROID: {{\Redis::connection('counter')->get('download_android_all')}}]</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <a href="{{action('\Pianke\Http\Controllers\AdminDownloadController@getAdd')}}"><i class="fa fa-plus"></i> {{trans('admin.link_add')}}</a>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="display: block;">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{trans('common.name')}}</th>
                                    <th>{{trans('common.desc')}}</th>
                                    <th>{{trans('admin.link')}}</th>
                                    <th>{{trans('admin.start_time')}}</th>
                                    <th>{{trans('common.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $sub)
                                <tr id="{{$sub['id']}}">
                                    <td>{{$sub['name']}}</td>
                                    <td>{{$sub['desc']}}</td>
                                    <td>
                                        [<a href="{{$uploads}}{{$sub['qrcode']}}" target="_blank">{{trans('admin.qrcode')}}</a>] - {{$sub['link']}}
                                    </td>
                                    <td>{{$sub['start']}}</td>
                                    <td>
                                        [<a href="javascript:if(confirm('确认删除吗?'))window.location='{{action('\Pianke\Http\Controllers\AdminDownloadController@getDel')}}?id={{$sub['id']}}'">{{trans('common.delete')}}</a>] 
                                        [<a href="{{action('\Pianke\Http\Controllers\AdminDownloadController@getCounter')}}?id={{$sub['id']}}">{{trans('admin.counter')}}</a>]
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