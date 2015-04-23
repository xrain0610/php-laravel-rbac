@extends('layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{trans('admin.user_add')}}</h5>
				<div class="ibox-tools">
				</div>
			</div>
			<div class="ibox-content"> 
				<form method="post" class="form-horizontal">
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.username')}}</label>
						<div class="col-sm-7"><input type="text" name="username" value="{{$uinfo->username}}" class="form-control">
						</div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('username'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('username')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.name')}}</label>
						<div class="col-sm-7"><input type="text" name="name" value="{{$uinfo->name}}" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('name'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('name')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.password')}}</label>
						<div class="col-sm-7"><input type="text" name="password"  value="" class="form-control" placeholder="[{{trans('admin.nochangepass')}}]"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('password'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('password')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.email')}}</label>
						<div class="col-sm-7"><input type="text" name="email" value="{{$uinfo->email}}" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('email'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('email')}}</label>
		                @endif
		                @endif
					</div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('common.cell')}}</label>
						<div class="col-sm-7"><input type="text" name="cell" value="{{$uinfo->cell}}" class="form-control"></div>
						@if (\Session::has('errors'))
						@if (\Session::get('errors')->has('cell'))
							<label class="col-sm-2 control-label" style="color:red;text-align:left;"><i class="fa fa-times"></i> {{\Session::get('errors')->first('cell')}}</label>
		                @endif
		                @endif
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group"><label class="col-sm-2 control-label">{{trans('admin.role')}}</label>
						<div class="col-sm-7"><select class="form-control m-b" name="role">
                              @foreach ($roles as $role)
                              @if ($role->id == $uinfo->roleid)
                              <option value="{{$role->id}}" selected="">{{$role->name}} - {{$role->desc}}</option>
                              @else
                              <option value="{{$role->id}}">{{$role->name}} - {{$role->desc}}</option>
                              @endif
                              @endforeach
                          </select>
                          </div>
                    </div>
                    <input type="hidden" name="id" value="{{$uinfo->id}}">
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