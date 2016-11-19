@extends('layouts.app')

@section('content')
<div class="container content-wrapper">
	<h3> แก้ไขข้อมูลยา ID {{ $medicine->id }} </h3>
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
			<div class="panel panel-default mt-xl">
				<div class="panel-body">
					{!! Form::open(['url' => 'medicine/'.$medicine->id.'/edit', 'role' => "form", 'data-parsley-validate', 'novalidate', 'class' => 'form-horizontal mb-lg']) !!}
					{!! Form::token() !!}

					<div class="row">
						<div class="mb col-md-6 col-md-offset-3 {{ $errors->has('name') ? 'has-error' : '' }}">
							{!! Form::label('name', 'ชื่อยา', ['class' => 'control-label']) !!}
							{!! Form::text('name', $medicine->name, ['class' => 'form-control', 'required', 'autofocus']) !!}
							@if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
						</div>
					</div>

					<div class="row">
						<div class="clearfix"></div>
						<div class="col-md-4 col-md-offset-4 mt-xl">
							<div class="form-group">{!! Form::submit('บันทึกการแก้ไขข้อมูล', ['class' => 'btn btn-primary btn-block']) !!}</div>
						</div>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

