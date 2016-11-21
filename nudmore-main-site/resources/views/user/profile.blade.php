@extends('layouts.app')

@section('content')
<div class="container content-wrapper">
	<h3> 
		@if ($current_user->id === $user->id) 
		โปรไฟล์ข้อมูลส่วนตัวของคุณ 
		<a href="{{ url('/profile/edit') }}" class="btn btn-success pull-right">แก้ไข้ข้อมูลส่วนตัว</a>
		@else 
		โปรไฟล์ข้อมูลส่วนตัวของผู้ใช้งาน ID {{ $user->id }}
		@if ($current_user->isAdministrator())
		<div class="pull-right">
			{!! Form::open(['url' => '/profile/'.$user->id.'/delete', 'method' => 'delete']) !!}
			{!! Form::token() !!}
			{!! Form::button('ลบผู้ใช้รายนี้', ['id' => 'deleteU','class' => 'btn btn-danger btn-block']) !!}
			{!! Form::close() !!}
		</div>
		<a href="{{ url('/profile/'.$user->id.'/edit') }}" class="btn btn-success mh pull-right">แก้ไข้ข้อมูลผู้ใช้</a>
		@endif
		@endif 
	</h3>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-2">
			<div class="panel panel-info mt-xl">
				<div class="panel-heading">ข้อมูลบัญชีผู้ใช้</div>
				<div class="panel-body form-horizontal">
					<div class="form-group row">
						{!! Form::label('username', 'ชื่อผู้ใช้งาน', ['class' => 'col-md-5 control-label']) !!}
						<div class="col-md-7"><input type="text" readonly value="{!! $user->username !!}" class="form-control" /></div>
					</div>
					<div class="form-group row">
						{!! Form::label('user_type', 'ประเภทผู้ใช้งาน', ['class' => 'col-md-5 control-label']) !!}
						<div class="col-md-7">{!! Form::text('user_type', 'ผู้ป่วย', ['class' => 'form-control', 'id'=>'user_type', 'readonly']) !!}</div>
					</div>
				</div>
			</div>
			<div class="panel panel-info mt-xl">
				<div class="panel-heading">ข้อมูลทางการแพทย์</div>
				<div class="panel-body form-horizontal">

					@if ($user->isDoctor())

					<div class="form-group row">
						{!! Form::label('username', 'รหัสแพทย์', ['class' => 'col-md-5 control-label']) !!}
						<div class="col-md-7">{!! Form::text('username', $user->doctor()->first()->doctor_number, ['class' => 'form-control', 'readonly', 'autofocus']) !!}</div>
					</div>

					<div class="form-group row">
						{!! Form::label('username', 'แผนก', ['class' => 'col-md-5 control-label']) !!}
						<div class="col-md-7">{!! Form::text('username', $user->doctor()->first()->department, ['class' => 'form-control', 'readonly', 'autofocus']) !!}</div>
					</div>
					<hr />
					@endif

					<div class="form-group row">
						{!! Form::label('username', 'รหัสผู้ป่วย', ['class' => 'col-md-5 control-label']) !!}
						<div class="col-md-7">{!! Form::text('username', $user->patient()->first()->patient_number, ['class' => 'form-control', 'readonly', 'autofocus']) !!}</div>
					</div>

					<div class="form-group row">
						{!! Form::label('username', 'ประวัติการแพ้ยา', ['class' => 'col-md-5 control-label']) !!}
						<div class="col-md-7">{!! Form::textarea('username', $user->patient()->first()->drug_allergy, ['class' => 'form-control', 'readonly', 'autofocus']) !!}</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-4 col-lg-offset-0">

			<div class="panel panel-info mt-xl">
				<div class="panel-heading">ข้อมูลส่วนบุคคล</div>
				<div class="panel-body form-horizontal">
					<div class="form-group row">
						{!! Form::label('name', 'ชื่อ นามสกุล', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">{!! Form::text('name', $user->title.' '.$user->name.' '.$user->surname, ['class' => 'form-control', 'readonly']) !!}</div>
					</div>

					<div class="form-group row">
						{!! Form::label('gender', 'เพศ', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">{!! Form::text('gender', $user->gender, ['class' => 'form-control', 'readonly']) !!}</div>
					</div>

					<div class="form-group row">
						{!! Form::label('blood_type', 'หมู่เลือด', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">{!! Form::text('blood_type', $user->patient()->first()->blood_type, ['class' => 'form-control', 'readonly']) !!}</div>
					</div>

					<div class="form-group row">
						{!! Form::label('identity_number', 'เลขประจำตัวประชาชน', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">{!! Form::text('identity_number', $user->identity_number, ['class' => 'form-control', 'readonly']) !!}</div>
					</div>

					<div class="form-group row">
						{!! Form::label('birthdate', 'วัน/เดือน/ปี เกิด', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">{!! Form::text('username', $user->patient()->first()->birthdate, ['class' => 'form-control', 'readonly']) !!}</div>
					</div>

					<div class="form-group row">
						{!! Form::label('phone_number', 'หมายเลขโทรศัพท์', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">{!! Form::text('phone_number', $user->patient()->first()->phone_number, ['class' => 'form-control', 'readonly']) !!}</div>
					</div>
					<div class="form-group row">
						{!! Form::label('email', 'อีเมล', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">{!! Form::text('email', $user->email, ['class' => 'form-control', 'readonly']) !!}</div>
					</div>

					<div class="form-group row">
						{!! Form::label('address', 'ที่อยู่', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">{!! Form::textarea('address', $user->patient()->first()->address, ['class' => 'form-control', 'readonly']) !!}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row hidden-lg">
		<div class="col-lg-8 col-lg-offset-2">
			<div class="form-group row">
				@if ($current_user->id === $user->id)
				<div class="col-md-4 col-md-offset-4">
					<a href="{{ url('/profile/edit') }}" class="btn btn-success btn-block">แก้ไข้ข้อมูลส่วนตัว</a>
				</div>
				@elseif ($current_user->isAdministrator())
				<div class="col-md-3 col-md-offset-3"><a href="{{ url('/profile/'.$user->id.'/edit') }}" class="btn btn-success btn-block">แก้ไข้ข้อมูลผู้ใช้</a></div>
				<div class="col-md-3">
					{!! Form::open(['url' => '/profile/'.$user->id.'/delete', 'method' => 'delete']) !!}
					{!! Form::token() !!}
					{!! Form::button('ลบผู้ใช้รายนี้', ['id' => 'deleteU','class' => 'btn btn-danger btn-block']) !!}
					{!! Form::close() !!}
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer_script')
<script>
	@if ($user->isAdministrator())
		jQuery("#user_type").val("ผู้ดูแลระบบ");
	@elseif ($user->isStaff())
	jQuery("#user_type").val("เจ้าหน้าที่");
	@elseif ($user->isDoctor())
	jQuery("#user_type").val("แพทย์");
	@elseif ($user->isNurse())
	jQuery("#user_type").val("พยาบาล");
	@elseif ($user->isPharmacist())
	jQuery("#user_type").val("เภสัชกร");
	@else
		jQuery("#user_type").val("ผู้ป่วย");
	@endif
	jQuery("#deleteU").click(function(){
		var t = jQuery(this).parents("form");
		swal({
			title: "แน่ใจหรือไม่?",
			text: "คุณจะไม่สามารถกู้คืนข้อมูลผู้ใช้รายนี้ได้อีก!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "ใช่, ยืนยันการลบ!",
			cancelButtonText: "ไม่, ยกเลิกการลบ!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm){
			if (isConfirm) {
				swal("ลบแล้ว!", "", "success");
				t.submit();
			} else {
				swal("ยกเลิกแล้ว", "ข้อมูลผู้ใช้ไม่ถูกลบ :)", "error");
			}
		});

	});
</script>
@endsection
