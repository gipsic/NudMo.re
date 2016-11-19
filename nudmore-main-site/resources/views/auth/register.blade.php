@extends('layouts.blank')

@section('content')

<div class="container">
	<div class="row mt-xl">
		<div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
			<div class="panel mt-xl">
				<div class="panel-heading text-center color-light-sky-blue">
					<p class="text-center"><a href="{{ url('/') }}"><img src="/img/logo.png" alt="Image" class="block-center img-rounded"></a></p>
					<span class="text-white">สมัครสมาชิกเพื่อใช้งานระบบ</span>
				</div>

				<div class="panel-body">
					{!! Form::open(['url' => 'register', 'role' => "form", 'data-parsley-validate', 'novalidate', 'class' => 'form-horizontal mb-lg']) !!}
					{!! Form::token() !!}

					<div class="row">
						<div class="mb col-md-6 {{ $errors->has('username') ? 'has-error' : '' }}">
							{!! Form::label('username', 'ชื่อผู้ใช้งาน', ['class' => 'control-label']) !!}
							{!! Form::text('username', old('username'), ['class' => 'form-control', 'required', 'autofocus']) !!}
							@if ($errors->has('username'))<span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>@endif
						</div>

						<div class="mb col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
							{!! Form::label('email', 'อีเมล', ['class' => 'control-label']) !!}
							{!! Form::text('email', old('email'), ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
						</div>
					</div>
					<div class="row">
						<div class="mb col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
							{!! Form::label('password', 'รหัสผ่าน', ['class' => 'control-label']) !!}
							{!! Form::password('password', ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('password'))<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>@endif
						</div>

						<div class="mb col-md-6">
							{!! Form::label('password-confirm', 'ยืนยันรหัสผ่าน', ['class' => 'control-label']) !!}
							{!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-3 {{ $errors->has('title') ? ' has-error' : '' }}">
							{!! Form::label('title', 'คำนำหน้า', ['class' => 'control-label']) !!}
							{!! Form::text('title', old('title'), ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('title'))<span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>@endif
						</div>

						<div class="mb col-md-4 {{ $errors->has('name') ? ' has-error' : '' }}">
							{!! Form::label('name', 'ชือ', ['class' => 'control-label']) !!}
							{!! Form::text('name', old('name'), ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
						</div>

						<div class="mb col-md-5 {{ $errors->has('surname') ? ' has-error' : '' }}">
							{!! Form::label('surname', 'นามสกุล', ['class' => 'control-label']) !!}
							{!! Form::text('surname', old('surname'), ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('surname'))<span class="help-block"><strong>{{ $errors->first('surname') }}</strong></span>@endif
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-3 {{ $errors->has('gender') ? ' has-error' : '' }}">
							{!! Form::label('gender', 'เพศ', ['class' => 'control-label']) !!}
							{!! Form::select('gender', ['ชาย' => 'ชาย', 'หญิง' => 'หญิง'], old('gender'), ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('gender'))<span class="help-block"><strong>{{ $errors->first('gender') }}</strong></span>@endif
						</div>

						<div class="mb col-md-4 {{ $errors->has('identity_number') ? ' has-error' : '' }}">
							{!! Form::label('identity_number', 'หมายเลขบัตรประจำตัวประชาชน', ['class' => 'control-label']) !!}
							{!! Form::text('identity_number', old('identity_number'), ['pattern' => '[0-9]{13}','class' => 'form-control', 'required']) !!}
							@if ($errors->has('identity_number'))<span class="help-block"><strong>{{ $errors->first('identity_number') }}</strong></span>@endif
						</div>

						<div class="mb col-md-2 {{ $errors->has('blood_type') ? ' has-error' : '' }}">
							{!! Form::label('blood_type', 'หมู่เลือด', ['class' => 'control-label']) !!}
							{!! Form::select('blood_type', ['A'=>'A', 'B'=>'B', 'O'=>'O', 'AB'=>'AB'], old('blood_type'), ['class' => 'form-control', 'required']) !!}

							@if ($errors->has('blood_type'))<span class="help-block"><strong>{{ $errors->first('blood_type') }}</strong></span>@endif
						</div>

						<div class="mb col-md-3 {{ $errors->has('birthdate') ? ' has-error' : '' }}">
							{!! Form::label('birthdate', 'วัน/เดือน/ปี เกิด', ['class' => 'control-label']) !!}
							{!! Form::date('birthdate', \Carbon\Carbon::now(), ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('birthdate'))<span class="help-block"><strong>{{ $errors->first('birthdate') }}</strong></span>@endif
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-6 {{ $errors->has('address') ? ' has-error' : '' }}">
							{!! Form::label('address', 'ที่อยู่', ['class' => 'control-label']) !!}
							{!! Form::text('address', old('address'), ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('address'))<span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>@endif
						</div>

						<div class="mb col-md-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
							{!! Form::label('phone_number', 'หมายเลขโทรศัพท์', ['class' => 'control-label']) !!}
							{!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('phone_number'))<span class="help-block"><strong>{{ $errors->first('phone_number') }}</strong></span>@endif
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-6 {{ $errors->has('drug_allergy') ? ' has-error' : '' }}">
							{!! Form::label('drug_allergy', 'ประวัติการแพ้ยา', ['class' => 'control-label']) !!}
							{!! Form::text('drug_allergy', old('drug_allergy'), ['class' => 'form-control']) !!}
							@if ($errors->has('drug_allergy'))<span class="help-block"><strong>{{ $errors->first('drug_allergy') }}</strong></span>@endif
						</div>

						<div class="col-md-6">
							<label> </label>
							<div class="checkbox c-checkbox mt text-right">
								<label>{!! Form::checkbox('agreed' ,'yes',false,['required']) !!} <span class="fa fa-check"></span>ฉันยอมรับ<a href="register.html#">ข้อตกลงและเงื่อนไขการให้บริการ</a> </label>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="clearfix"></div>
						<div class="col-md-4 col-md-offset-4 mt-xl">
							<div class="form-group">{!! Form::submit('สมัครสมาชิก', ['class' => 'btn btn-primary btn-block']) !!}</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-4 col-md-offset-4">
							<p class="pt-lg text-center">มีบัญชีผู้ใช้อยู่แล้ว? <a href="{{ url('') }}" class="">เข้าสู่ระบบ</a></p>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
