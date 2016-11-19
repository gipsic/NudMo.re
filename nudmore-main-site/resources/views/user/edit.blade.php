@extends('layouts.app')

@section('content')
<div class="container content-wrapper">
	<h3> แก้ไขข้อมูลส่วนตัว </h3>
	<div class="row">

		<div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
			<div class="panel panel-default mt-xl">
				<div class="panel-body">
					{!! Form::open(['url' => 'profile/edit', 'role' => "form", 'data-parsley-validate', 'novalidate', 'class' => 'form-horizontal mb-lg']) !!}
					{!! Form::token() !!}

					<div class="row">
						<div class="mb col-md-6 {{ $errors->has('username') ? 'has-error' : '' }}">
							{!! Form::label('username', 'ชื่อผู้ใช้งาน', ['class' => 'control-label']) !!}
							{!! Form::text('username', $user->username, ['class' => 'form-control', 'required', 'autofocus']) !!}
							@if ($errors->has('username'))<span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>@endif
						</div>

						<div class="mb col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
							{!! Form::label('email', 'อีเมล', ['class' => 'control-label']) !!}
							{!! Form::text('email', $user->email, ['class' => 'form-control', 'required']) !!}
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
							{!! Form::text('title', $user->title, ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('title'))<span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>@endif
						</div>

						<div class="mb col-md-4 {{ $errors->has('name') ? ' has-error' : '' }}">
							{!! Form::label('name', 'ชือ', ['class' => 'control-label']) !!}
							{!! Form::text('name', $user->name, ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
						</div>

						<div class="mb col-md-5 {{ $errors->has('surname') ? ' has-error' : '' }}">
							{!! Form::label('surname', 'นามสกุล', ['class' => 'control-label']) !!}
							{!! Form::text('surname', $user->surname, ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('surname'))<span class="help-block"><strong>{{ $errors->first('surname') }}</strong></span>@endif
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-3 {{ $errors->has('gender') ? ' has-error' : '' }}">
							{!! Form::label('gender', 'เพศ', ['class' => 'control-label']) !!}
							{!! Form::select('gender', ['ชาย' => 'ชาย', 'หญิง' => 'หญิง'], $user->gender, ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('gender'))<span class="help-block"><strong>{{ $errors->first('gender') }}</strong></span>@endif
						</div>

						<div class="mb col-md-4 {{ $errors->has('identity_number') ? ' has-error' : '' }}">
							{!! Form::label('identity_number', 'หมายเลขบัตรประจำตัวประชาชน', ['class' => 'control-label']) !!}
							{!! Form::text('identity_number', $user->identity_number, ['pattern' => '[0-9]{13}','class' => 'form-control', 'required']) !!}
							@if ($errors->has('identity_number'))<span class="help-block"><strong>{{ $errors->first('identity_number') }}</strong></span>@endif
						</div>

						<div class="mb col-md-2 {{ $errors->has('blood_type') ? ' has-error' : '' }}">
							{!! Form::label('blood_type', 'หมู่เลือด', ['class' => 'control-label']) !!}
							{!! Form::select('blood_type', ['A'=>'A', 'B'=>'B', 'O'=>'O', 'AB'=>'AB'], $user->patient()->first()->blood_type, ['class' => 'form-control', 'required']) !!}

							@if ($errors->has('blood_type'))<span class="help-block"><strong>{{ $errors->first('blood_type') }}</strong></span>@endif
						</div>

						<div class="mb col-md-3 {{ $errors->has('birthdate') ? ' has-error' : '' }}">
							{!! Form::label('birthdate', 'วัน/เดือน/ปี เกิด', ['class' => 'control-label']) !!}
							{!! Form::date('birthdate', $user->patient()->first()->birthdate, ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('birthdate'))<span class="help-block"><strong>{{ $errors->first('birthdate') }}</strong></span>@endif
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-6 {{ $errors->has('address') ? ' has-error' : '' }}">
							{!! Form::label('address', 'ที่อยู่', ['class' => 'control-label']) !!}
							{!! Form::text('address', $user->patient()->first()->address, ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('address'))<span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>@endif
						</div>

						<div class="mb col-md-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
							{!! Form::label('phone_number', 'หมายเลขโทรศัพท์', ['class' => 'control-label']) !!}
							{!! Form::text('phone_number', $user->patient()->first()->phone_number, ['class' => 'form-control', 'required']) !!}
							@if ($errors->has('phone_number'))<span class="help-block"><strong>{{ $errors->first('phone_number') }}</strong></span>@endif
						</div>
					</div>
					<div class="row">
						<div class="mb col-md-6 {{ $errors->has('drug_allergy') ? ' has-error' : '' }}">
							{!! Form::label('drug_allergy', 'ประวัติการแพ้ยา', ['class' => 'control-label']) !!}
							{!! Form::text('drug_allergy', $user->patient()->first()->drug_allergy, ['class' => 'form-control']) !!}
							@if ($errors->has('drug_allergy'))<span class="help-block"><strong>{{ $errors->first('drug_allergy') }}</strong></span>@endif
						</div>

					</div>


					{{-- {!! Form::hidden('patient_number', $user->patient()->first()->patient_number) !!} --}}


					{{-- {!! Form::hidden('administrator', $user->isAdministrator()) !!} --}}

					{{-- {!! Form::hidden('staff', $user->isStaff()) !!} --}}

					{{-- {!! Form::hidden('doctor', $user->isDoctor()) !!} --}}
					{{-- {!! Form::hidden('doctor_number', $user->isDoctor() ? $user->doctor()->first()->doctor_number : '') !!} --}}
					{{-- {!! Form::hidden('department', $user->isDoctor() ? $user->doctor()->first()->department : '') !!} --}}

					{{-- {!! Form::hidden('nurse', $user->isNurse()) !!} --}}

					{{-- {!! Form::hidden('pharmacist', $user->isPharmacist()) !!} --}}

					<div class="row">

						<div class="clearfix"></div>
						<div class="col-md-4 col-md-offset-4 mt-xl">
							<div class="form-group">{!! Form::submit('บันทึกการแก้ไข', ['class' => 'btn btn-primary btn-block']) !!}</div>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
