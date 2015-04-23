@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content">
 <div class="row">
   <!-- 静静Android 统计-->
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">Android</span>
        <h5>{{trans('admin.jing')}}</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{$jing_android_count?$jing_android_count:0}}</h1>
        @if ($jing_android_count_per < 0)
          <div class="stat-percent font-bold text-danger">{{abs($jing_android_count_per)}}% <i class="fa fa-level-down"></i></div>
        @else 
          <div class="stat-percent font-bold text-info">{{$jing_android_count_per}}% <i class="fa fa-level-up"></i></div>
        @endif
        <small>{{trans('admin.play_count')}}</small>
      </div>
    </div>
  </div>
   <!-- 静静IOS 统计-->
   <div class="col-lg-4">
     <div class="ibox float-e-margins">
       <div class="ibox-title">
         <span class="label label-primary pull-right">IOS</span>
         <h5>{{trans('admin.jing')}}</h5>
       </div>
       <div class="ibox-content">
         <h1 class="no-margins">{{$jing_ios_count?$jing_ios_count:0}}</h1>
         @if ($jing_ios_count_per < 0)
         <div class="stat-percent font-bold text-danger">{{abs($jing_ios_count_per)}}% <i class="fa fa-level-down"></i></div>
         @else
         <div class="stat-percent font-bold text-info">{{$jing_ios_count_per}}% <i class="fa fa-level-up"></i></div>
         @endif
         <small>{{trans('admin.play_count')}}</small>
       </div>
     </div>
   </div>
   <!-- 静静分享 统计-->
   <div class="col-lg-4">
     <div class="ibox float-e-margins">
       <div class="ibox-title">
         <span class="label label-danger pull-right">{{trans('admin.share')}}</span>
         <h5>{{trans('admin.jing')}}</h5>
       </div>
       <div class="ibox-content">
         <h1 class="no-margins">{{$jing_share_count?$jing_share_count:0}}</h1>
         @if ($jing_share_count_per < 0)
         <div class="stat-percent font-bold text-danger">{{abs($jing_share_count_per)}}% <i class="fa fa-level-down"></i></div>
         @else
         <div class="stat-percent font-bold text-info">{{$jing_share_count_per}}% <i class="fa fa-level-up"></i></div>
         @endif
         <small>{{trans('admin.play_count')}}</small>
       </div>
     </div>
   </div>
   <!-- IOS APP下载 统计-->
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-info pull-right">IOS</span>
        <h5>{{trans('admin.download_count')}}</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{$ios_count?$ios_count:0}}</h1>
        @if ($ios_count_per < 0) 
          <div class="stat-percent font-bold text-danger">{{abs($ios_count_per)}}% <i class="fa fa-level-down"></i></div>
        @else 
          <div class="stat-percent font-bold text-info">{{$ios_count_per}}% <i class="fa fa-level-up"></i></div>
        @endif
        <small>{{trans('admin.today_download_count')}}</small>
      </div>
    </div>
  </div>
   <!-- Android APP下载 统计-->
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-primary pull-right">Android</span>
        <h5>{{trans('admin.download_count')}}</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{$android_count?$android_count:0}}</h1>
        @if ($android_count_per < 0) 
          <div class="stat-percent font-bold text-danger">{{abs($android_count_per)}}% <i class="fa fa-level-down"></i></div>
        @else 
          <div class="stat-percent font-bold text-info">{{$android_count_per}}% <i class="fa fa-level-up"></i></div>
        @endif
        <small>{{trans('admin.today_download_count')}}</small>
      </div>
    </div>
  </div>
</div>
</div>
@stop