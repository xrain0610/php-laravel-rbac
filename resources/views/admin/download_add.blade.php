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
				<h5>{{trans('admin.link_add')}}</h5>
				<div class="ibox-tools">
				</div>
			</div>
			<div class="ibox-content"> 
				<form method="post" class="form-horizontal">
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.name')}}</label>
						<div class="col-sm-7"><input type="text" name="name" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('name'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('name')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.desc')}}</label>
						<div class="col-sm-7"><input type="text" name="desc" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('desc'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('desc')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group" id="data_1"><label class="col-sm-2 control-label">{{trans('admin.start_time')}}</label>
						<div class="col-sm-7"><div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="start" value="{{date('Ymd')}}">
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
							<button class="btn btn-primary" type="submit">{{trans('admin.link_add')}}</button>
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