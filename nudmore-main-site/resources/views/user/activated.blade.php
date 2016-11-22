@extends('layouts.blank')

@section('content')

<div class="block-center mt-xl wd-xl">
	<!-- START panel-->
	
	@if($isSuccess)
		<div role="alert" class="alert alert-success"><strong>สำรเร็จแล้ว! </strong> ท่านได้ยืนยันการเปิดใช้งานบัญชีแล้ว สามารถเข้าสู่ระบบได้ทันที</div>
	@else
		<div role="alert" class="alert alert-warning"><strong>ขออภัย </strong> รหัสยืนยืนการเปิดใช้งานบัญชีและรหัสผ่านของท่านไม่ถูกต้องหรือถูกใช้ยืนยันไปแล้ว</div>
	@endif
	<div class="panel panel-flat">
		<div class="panel-heading text-center color-light-sky-blue">
			<a href="{{ url('/') }}">
				<img src="/img/logo.png" alt="Image" class="block-center img-rounded">
			</a>
		</div>
		<div class="panel-body">
			
			<p class="text-center pv">เข้าสู่ระบบเพื่อดำเนินการต่อ</p>
			{!! Form::open(['url' => '/login', 'class' => ' mb-lg']) !!}
                {!! Form::token() !!}
				<div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
					{!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'ชื่อผู้ใช้', 'required', 'autofocus']) !!}
					<span class="fa fa-user form-control-feedback text-muted"></span>
				</div>
				@if ($errors->has('username'))<span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>@endif
				<div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
					{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'รหัสผ่าน', 'required']) !!}
					<span class="fa fa-lock form-control-feedback text-muted"></span>
				</div>
				@if ($errors->has('password'))<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>@endif
				<div class="clearfix">
					<div class="checkbox c-checkbox pull-left mt0">
						<label>{!! Form::checkbox('remember') !!} <span class="fa fa-check"></span>จดจำรหัสผ่าน</label>
					</div>
					<div class="pull-right">
						<a href="{{ url('/password/reset') }}" class="text-muted">ลืมรหัสผ่าน?</a>
					</div>
				</div>
				{!! Form::submit('เข้าสู่ระบบ', ['class' => 'btn btn-block btn-primary mt-lg']) !!}
				<a href="{{ url('/register') }}" class="btn btn-block btn-default">สมัครสมาชิก</a>
			{!! Form::close() !!}
		</div>
	</div>
	<!-- END panel-->
	<div class="p-lg text-center">
		<span>&copy; 2016 - NudMo.re</span><br><span>ระบบนัดหมายแพทย์ NudMore</span>
	</div>
</div>

@endsection
