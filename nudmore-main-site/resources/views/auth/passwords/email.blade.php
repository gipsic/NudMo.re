@extends('layouts.blank')

<!-- Main Content -->
@section('content')
<div class="block-center mt-xl wd-xl">
	<!-- START panel-->
	<div class="panel panel-flat">
		<div class="panel-heading text-center color-light-sky-blue text-white">
			<p class=""><a href="{{ url('/') }}"><img src="/img/logo.png" alt="Image" class="block-center img-rounded"></a></p>
            ขอรหัสผ่านใหม่
		</div>
		<div class="panel-body">
			<p class="text-center pv">กรอกอีเมลเพื่อขอรับรหัสผ่านใหม่</p>
            @if (session('status')) <div class="alert alert-success"> {{ session('status') }} </div> @endif
			{!! Form::open(['url' => '/password/email', 'class' => ' mb-lg']) !!}
                 {{ csrf_field() }}
				<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
					{!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'อีเมล', 'required', 'autofocus']) !!}
					<span class="fa fa-user form-control-feedback text-muted"></span>
                    @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
				</div>
				{!! Form::submit('ส่งอีเมลสำหรับตั้งรหัสผ่านใหม่', ['class' => 'btn btn-block btn-primary mt-lg']) !!}
			{!! Form::close() !!}
		</div>
	</div>
	<!-- END panel-->
	<div class="p-lg text-center">
		<span>&copy; 2016 - NudMo.re</span><br><span>ระบบนัดหมายแพทย์ NudMore</span>
	</div>
</div>

@endsection

