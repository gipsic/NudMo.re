@extends('layouts.blank')

@section('content')
 
<div class="block-center mt-xl wd-xl">
	<!-- START panel-->
	<div class="panel panel-flat">
		<div class="panel-heading text-center color-light-sky-blue text-white">
            <p class=""><a href="{{ url('/') }}"><img src="/img/logo.png" alt="Image" class="block-center img-rounded"></a></p>
             ตั้งรหัสผ่านใหม่ 
		</div>
		<div class="panel-body">
            @if (session('status')) <div class="alert alert-success"> {{ session('status') }} </div> @endif
			{!! Form::open(['url' => '/password/email', 'class' => ' mb-lg']) !!}
                 {{ csrf_field() }}
				<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
					{!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'อีเมล', 'required', 'autofocus']) !!}
					<span class="fa fa-user form-control-feedback text-muted"></span>
                    @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
				</div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
					{!! Form::text('password', old('password'), ['class' => 'form-control', 'placeholder' => 'รหัสผ่าน', 'required', 'autofocus']) !!}
					<span class="fa fa-lock form-control-feedback text-muted"></span>
                    @if ($errors->has('password'))<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>@endif
				</div>
            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					{!! Form::text('password_confirmation', old('password_confirmation'), ['class' => 'form-control', 'placeholder' => 'ยืนยันรหัสผ่าน', 'required', 'autofocus']) !!}
					@if ($errors->has('password_confirmation'))<span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>@endif
				</div>
				{!! Form::submit('บันทึกรหัสผ่านใหม่', ['class' => 'btn btn-block btn-primary mt-lg']) !!}
			{!! Form::close() !!}
		</div>
	</div>
	<!-- END panel-->
	<div class="p-lg text-center">
		<span>&copy; 2016 - NudMo.re</span><br><span>ระบบนัดหมายแพทย์ NudMore</span>
	</div>
</div>

@endsection

