@extends('layout.admin')
@section('css')
<link href="{{$static}}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@stop
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('admin.jing_edit')}}</h5>
				<div class="ibox-tools">
				</div>
			</div>
			<div class="ibox-content"> 
				<form method="post" class="form-horizontal" enctype="multipart/form-data"> 
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.title')}}</label>
						<div class="col-sm-7"><input type="text" name="title" value="{{$data['title']}}" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('title'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('title')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.author')}}</label>
						<div class="col-sm-7"><input type="text" name="author" value="{{$data['author']}}" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('author'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('author')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.text')}}</label>
						<div class="col-sm-7"><input type="text" name="text" value="{{$data['text']}}" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('text'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('text')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.audio')}}
						<a href="{{$uploads}}{{$data['audio']}}" target="_blank">({{trans('admin.seeit')}})</a>
					</label>
						<div class="col-sm-7"><input type="file" name="audio" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('audio'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('audio')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.img')}}
						<a href="{{$uploads}}{{$data['img']}}" target="_blank">({{trans('admin.seeit')}})</a>
					</label>
						<div class="col-sm-7"><input type="file" name="img" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('img'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('img')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">({{trans('common.canopt')}}){{trans('common.video')}}
						@if ($data['video'])
							<a href="{{$uploads}}{{$data['video']}}" target="_blank">({{trans('admin.seeit')}})</a>
						@endif
					</label>
						<div class="col-sm-7"><input type="file" name="video" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('video'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('video')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group" id="data_1"><label class="col-sm-2 control-label">{{trans('common.start')}}</label>
						<div class="col-sm-7"><div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="start" value="{{$data['start']}}" >
                    	</div>
                	</div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('start'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('start')}}</label>
		                @endif
		                @endif
					</div>
					<div class="hr-line-dashed"></div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group">
						<div class="col-sm-12 col-sm-offset-5">
							<button class="btn btn-primary" type="submit">{{trans('admin.editsave')}}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
@stop
@section('js')
<!-- Data picker -->
<script src="{{$static}}/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$('#data_1 .input-group.date').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});
</script>
@stop