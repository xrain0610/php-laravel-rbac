@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{$name}} - {{$link}}</h5>
                    <div class="ibox-tools">
                            {{trans('admin.allcount')}}[IOS: {{$ios?$ios:0}} ANDROID: {{$android?$android:0}}]
                    </div>
                </div>
                <div class="ibox-content" style="display: block;">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{trans('admin.date')}}</th>
                                <th>ANDROID</th>
                                <th>IOS</th>
                                <th>{{trans('admin.allcount')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $sub)
                            <tr>
                                <td>{{$sub['date']}}</td>
                                <td>{{$sub['android']?$sub['android']:0}}</td>
                                <td>{{$sub['ios']?$sub['ios']:0}}</td>
                                <td>{{$sub['total']}}</td>
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