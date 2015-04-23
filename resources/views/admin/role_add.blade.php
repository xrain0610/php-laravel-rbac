@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('admin.role_add')}}</h5>
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
					<div class="hr-line-dashed"></div>
					@foreach ($plist as $p)
					<div class="form-group"><label class="col-sm-2 control-label">{{$p['name']}}</label>
                        <div class="col-sm-10">
                        @foreach ($p['list'] as $subp)
                     	<label class="checkbox-inline" title="{{$subp['desc']}}"><input type="checkbox" name="permissions[]" value="{{$subp['id']}}" id="inlineCheckbox{{$subp['id']}}">{{$subp['name']}}</label> 
                        @endforeach
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    @endforeach
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group">
						<div class="col-sm-12 col-sm-offset-5">
							<button class="btn btn-primary" type="submit">{{trans('admin.role_add')}}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
@stop