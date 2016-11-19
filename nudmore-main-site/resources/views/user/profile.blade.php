@extends('layouts.app')

@section('content')
<div class="container content-wrapper">
	<h3> โปรไฟล์ข้อมูลส่วนตัวของคุณ </h3>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default mt-xl">
				<div class="panel-body">
					<div class="row">
						<div class="mb col-md-6 {{ $errors->has('username') ? 'has-error' : '' }}">
							{!! Form::label('username', 'ชื่อผู้ใช้งาน', ['class' => 'control-label']) !!}
							<p>{{ $user->username }}</p>
						</div>

						<div class="mb col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
							{!! Form::label('email', 'อีเมล', ['class' => 'control-label']) !!}
							<p>{{ $user->email}}</p>
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-3 {{ $errors->has('title') ? ' has-error' : '' }}">
							{!! Form::label('title', 'คำนำหน้า', ['class' => 'control-label']) !!}
							<p>{{ $user->title}}</p>
						</div>

						<div class="mb col-md-4 {{ $errors->has('name') ? ' has-error' : '' }}">
							{!! Form::label('name', 'ชือ', ['class' => 'control-label']) !!}
							<p>{{ $user->name}}</p>
						</div>

						<div class="mb col-md-5 {{ $errors->has('surname') ? ' has-error' : '' }}">
							{!! Form::label('surname', 'นามสกุล', ['class' => 'control-label']) !!}
							<p>{{ $user->surname}}</p>
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-3">
							{!! Form::label('gender', 'เพศ', ['class' => 'control-label']) !!}
							<p>{{ $user->gender}}</p>
						</div>

						<div class="mb col-md-4">
							{!! Form::label('identity_number', 'หมายเลขบัตรประจำตัวประชาชน', ['class' => 'control-label']) !!}
							<p>{{ $user->identity_number}}</p>
						</div>

						<div class="mb col-md-2">
							{!! Form::label('blood_type', 'หมู่เลือด', ['class' => 'control-label']) !!}
							<p>{{ $user->patient()->first()->blood_type}}</p>
						</div>

						<div class="mb col-md-3">
							{!! Form::label('birthdate', 'วัน/เดือน/ปี เกิด', ['class' => 'control-label']) !!}
							<p>{{ $user->patient()->first()->birthdate}}</p>
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-6 {{ $errors->has('address') ? ' has-error' : '' }}">
							{!! Form::label('address', 'ที่อยู่', ['class' => 'control-label']) !!}
							<p>{{ $user->patient()->first()->address}}</p>
						</div>

						<div class="mb col-md-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
							{!! Form::label('phone_number', 'หมายเลขโทรศัพท์', ['class' => 'control-label']) !!}
							<p>{{ $user->patient()->first()->phone_number}}</p>
						</div>
					</div>
					<div class="row">

						<div class="mb col-md-6 {{ $errors->has('drug_allergy') ? ' has-error' : '' }}">
							{!! Form::label('drug_allergy', 'ประวัติการแพ้ยา', ['class' => 'control-label']) !!}
							<p>{{ $user->patient()->first()->drug_allergy}}</p>
						</div>

					</div>
					<div class="row">
						@if ($current_user->id === $user->id)
						<div class="col-md-4 col-md-offset-4 mt-xl">
							<a href="{{ url('/profile/edit') }}" class="btn btn-success btn-block">แก้ไข้ข้อมูลส่วนตัว</a>
						</div>
						@if ($user->id != $user->id)
						<div class="col-md-4 col-md-offset-2 mt-xl"><a href="{{ url('/profile/'.$user->id.'/edit') }}" class="btn btn-success btn-block">แก้ไข้ข้อมูลผู้ใช้</a></div>
						<div class="col-md-4 mt-xl">
							{!! Form::open(['url' => '/profile/'.$user->id.'/delete', 'method' => 'delete']) !!}
							{!! Form::token() !!}
							{!! Form::button('ลบผู้ใช้รายนี้', ['id' => 'deleteU','class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</div>
						@endif
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer_script')

<script>
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
		},
		function(isConfirm){
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
