@extends('layouts.app')

@section('content')
<div class="content-wrapper container">
	<h3> สร้างรายการนัดหมายใหม่ </h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3 mt">
			<div class="panel panel-info mt">

				<div class="panel-heading white-text">เลือกผู้ป่วย กำหนดเวลานัดหมาย และระบุสาเหตุของการนัดหมาย</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'appointment/doctor/create', 'class' => 'form-horizontal']) !!}
					{!! Form::token() !!}

					{!! Form::hidden('doctor_number', $current_user->doctor()->first()->doctor_number) !!}

					<div class="form-group{{ $errors->has('patient_number') ? ' has-error' : '' }}">
						{!! Form::label('patient_number', 'ผู้ป่วยที่เข้ารับการรักษา', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">
							<select name="patient_number" required class="chosen-select input-md form-control">
								<option value=""> -- พิมพ์ ชื่อหรือรหัส ผู้ป่วย เพื่อค้นหา --</option>
								@foreach($patients as $patient)
								<option value="{!! $patient->patient_number !!}">{!! $patient->patient_number !!} - {!! $patient->user()->first()->title !!} {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!}</option>
								@endforeach
							</select>
							@if ($errors->has('patient_number'))<span class="help-block"><strong>{{ $errors->first('patient_number') }}</strong></span>@endif
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('doctorber', 'รหัสแพทย์ผู้ทำการตรวจ', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">
							{!! Form::text('doctorber', $current_user->doctor()->first()->doctor_number, ['class' => 'form-control', 'readonly', 'autofocus']) !!}
						</div>
					</div>

					<div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">
						{!! Form::label('date_time', 'เวลาที่สะดวกเข้ารับการตรวจ', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">
							<select name="date_time" required class="chosen-select input-md form-control">
								<option value=""> -- เลือกเวลาที่สะดวกเข้ารับการตรวจ --</option>
								@foreach($available_schedules as $schedule)
								<option value="{!! $schedule->date_time !!}">{!! $schedule->date_time !!} to <?php $date_time = (new DateTime($schedule->date_time))->modify('+30 minutes')->modify('+2 hours'); echo $date_time->format('H:i:s'); ?> </option>
								@endforeach
							</select>
							@if ($errors->has('date_time'))<span class="help-block"><strong>{{ $errors->first('date_time') }}</strong></span>@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
						{!! Form::label('reason', 'สาเหตุของการนัดหมาย / อาการที่พบ', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">
							{!! Form::textarea('reason', old('reason'), ['class' => 'form-control', 'required', 'autofocus']) !!}
						</div>
						@if ($errors->has('reason'))<span class="help-block"><strong>{{ $errors->first('reason') }}</strong></span>@endif
					</div>

					<div class="form-group">
						<div class="col-md-4 col-md-offset-4">
							{!! Form::submit('สร้างนัดหมาย', ['class' => 'btn btn-success btn-block']) !!}
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

	$('.chosen-select').chosen();
</script>
@endsection




