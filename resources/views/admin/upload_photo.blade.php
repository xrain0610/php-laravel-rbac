@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('common.changephoto')}}</h5>
				<div class="ibox-tools">
				</div>
			</div>
			<div class="ibox-content"> 
				<form method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.selectphoto')}}</label>
						<div class="col-sm-7"><input type="file" name="photo" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('photo'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('photo')}}</label>
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