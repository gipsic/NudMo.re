@extends('layouts.app')

@section('content')

<div class="content-wrapper container">
	<h3> สร้างรายการนัดหมายใหม่ </h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">

				<div class="panel-heading white-text">ขั้นตอนที่ 2: เลือกเวลาและระบุสาเหตุ/อาการ</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'appointment/patient/create', 'class' => 'form-horizontal']) !!}
					{!! Form::token() !!}

						{!! Form::hidden('patient_number', $current_user->patient()->first()->patient_number) !!}
						{!! Form::hidden('doctor_number', $doctor_number) !!}
					
					<div class="form-group">
						{!! Form::label('patientber', 'รหัสผู้ป่วย', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">
							{!! Form::text('patientber', $current_user->patient()->first()->patient_number, ['class' => 'form-control', 'readonly', 'autofocus']) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('doctorber', 'รหัสแพทย์ผู้ทำการตรวจ', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">
							{!! Form::text('doctorber', $doctor_number, ['class' => 'form-control', 'readonly', 'autofocus']) !!}
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



