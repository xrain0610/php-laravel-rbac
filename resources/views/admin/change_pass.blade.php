@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('common.changepass')}}</h5>
				<div class="ibox-tools">
				</div>
			</div>
			<div class="ibox-content"> 
				<form method="post" class="form-horizontal">
					<div class="form-group"><label class="col-lg-2 control-label">{{trans('common.username')}}</label>

                                    <div class="col-lg-7"><p class="form-control-static">{{$uinfo->username}}</p></div>
                                </div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.oldpass')}}</label>
						<div class="col-sm-7"><input type="password" name="oldpass" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('oldpass'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('oldpass')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.newpass')}}</label>
						<div class="col-sm-7"><input type="password" name="newpass" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('newpass'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('newpass')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.conpass')}}</label>
						<div class="col-sm-7"><input type="password" name="conpass" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('conpass'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('conpass')}}</label>
		                @endif
		                @endif
					</div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="hr-line-dashed"></div>
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