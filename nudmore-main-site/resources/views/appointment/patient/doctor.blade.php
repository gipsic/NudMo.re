@extends('layouts.app')

@section('content')
<div class="content-wrapper container">
	<h3> สร้างรายการนัดหมายใหม่ </h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">

				<div class="panel-heading white-text">ขั้นตอนที่ 1: เลือกแพทย์ที่ต้องการนัดหมาย</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'appointment/patient/create/selected', 'class' => 'form-horizontal']) !!}
					{!! Form::token() !!}

					<div class="form-group{{ $errors->has('doctor_number') ? ' has-error' : '' }}">
						{!! Form::label('doctor_number', 'แพทย์ผู้ทำการตรวจ', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-8">
							<select name="doctor_number" required class="chosen-select input-md form-control">
								<option value=""> -- พิมพ์ ชื่อหรือรหัส แพทย์ หรือ แผนก เพื่อค้นหา --</option>
								@foreach($doctors as $doctor)
								<option value="{!! $doctor->doctor_number !!}">[{!! $doctor->department !!}] {!! $doctor->doctor_number !!} - {!! $doctor->user()->first()->title !!} {!! $doctor->user()->first()->name !!} {!! $doctor->user()->first()->surname !!} </option>
								@endforeach
							</select>
							@if ($errors->has('doctor_number'))<span class="help-block"><strong>{{ $errors->first('doctor_number') }}</strong></span>@endif
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-4 col-md-offset-4">
							{!! Form::submit('ไปยังขั้นตอนต่อไป', ['class' => 'btn btn-success btn-block']) !!}
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



