@extends('layouts.app')

@section('content')
<div class="content-wrapper container">
	<h3> เพิ่มเวลาออกตรวจของแพทย์</h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">

				<div class="panel-heading white-text">กำหนดเวลาออกตรวจ</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'schedule/doctor/create', 'class' => 'form-horizontal']) !!}
					{!! Form::token() !!}

					<div class="form-group{{ $errors->has('doctor_number') ? ' has-error' : '' }}">
						{!! Form::label('doctor_number', 'แพทย์ผู้ทำการตรวจ', ['class' => 'col-md-3 control-label']) !!}
						<div class="col-md-9">
							<select name="doctor_number" required class="chosen-select input-md form-control">
								<option value=""> -- พิมพ์ ชื่อหรือรหัส แพทย์ เพื่อค้นหา --</option>
								@foreach($doctors as $doctor)
								<option value="{!! $doctor->doctor_number !!}">{!! $doctor->doctor_number !!} - {!! $doctor->user()->first()->title !!} {!! $doctor->user()->first()->name !!} {!! $doctor->user()->first()->surname !!}</option>
								@endforeach
							</select>
							@if ($errors->has('doctor_number'))<span class="help-block"><strong>{{ $errors->first('doctor_number') }}</strong></span>@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">
						{!! Form::label('date_time', 'เลือกวันและช่วงเวลา', ['class' => 'col-md-3 control-label']) !!}
						{!! Form::hidden('date_time', old('date_time'), ['id' => 'date_time', 'required', 'autofocus']) !!}
						<div class="col-md-5">
							{!! Form::date('dat', \Carbon\Carbon::tomorrow(), ['class' => 'form-control', 'id'=>'dat', 'required']) !!}
						</div>
						<div class="col-md-4">
							<select id="period" class="form-control col-md-9"><option value="09:00:00">09.00 น. - 11.30 น.</option><option value="13:00:00">13.00 น. - 15.30 น.</option></select>
						</div>
						<div class="col-md-9 col-md-offset-3">
							@if ($errors->has('date_time'))<span class="help-block"><strong>{{ $errors->first('date_time') }}</strong></span>@endif
						</div>
					</div>


					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							{!! Form::submit('บันทึกเวลาออกตรวจ', ['class' => 'btn btn-success btn-block']) !!}
						</div>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('footer_script')
   <!-- CHOSEN-->
   <link rel="stylesheet" href="{{ url('/vendor/chosen_v1.2.0/chosen.min.css') }}">
 <!-- CHOSEN-->
   <script src="{{ url('/vendor/chosen_v1.2.0/chosen.jquery.min.js') }}"></script>
<script>
	jQuery("#period, #dat").change(function(){
		var t = jQuery("#period").val();
		var d = jQuery("#dat").val();
		jQuery("#date_time").val(d+" "+t);
	}).trigger("change");
	$('.chosen-select').chosen();
</script>
@endsection


