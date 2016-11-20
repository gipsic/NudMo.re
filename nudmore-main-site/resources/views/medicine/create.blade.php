@extends('layouts.app')

@section('content')
<div class="container content-wrapper">
	<h3> สร้างข้อมูลยาใหม่ </h3>
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
			<div class="panel panel-default mt-xl">
				<div class="panel-body">
					{!! Form::open(['url' => 'medicine/create', 'role' => "form", 'data-parsley-validate', 'novalidate', 'class' => 'form-horizontal mb-lg']) !!}
					{!! Form::token() !!}

					<div class="row">
						<div class="mb col-md-6 col-md-offset-3 {{ $errors->has('name') ? 'has-error' : '' }}">
							{!! Form::label('name', 'ชื่อยา', ['class' => 'control-label']) !!}
							{!! Form::text('name', old('name'), ['class' => 'form-control', 'required', 'autofocus']) !!}
							@if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
						</div>
					</div>

					<div class="row">
						<div class="mb col-md-6 col-md-offset-3 {{ $errors->has('how_to_use') ? 'has-error' : '' }}">
							{!! Form::label('how_to_use', 'วิธีใช้ยา', ['class' => 'control-label']) !!}
							{!! Form::text('how_to_use', old('how_to_use'), ['class' => 'form-control', 'required', 'autofocus']) !!}
							@if ($errors->has('how_to_use'))<span class="help-block"><strong>{{ $errors->first('how_to_use') }}</strong></span>@endif
						</div>
					</div>

					<div class="row">
						<div class="clearfix"></div>
						<div class="col-md-4 col-md-offset-4 mt-xl">
							<div class="form-group">{!! Form::submit('บันทึกข้อมูลยาใหม่', ['class' => 'btn btn-primary btn-block']) !!}</div>
						</div>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

