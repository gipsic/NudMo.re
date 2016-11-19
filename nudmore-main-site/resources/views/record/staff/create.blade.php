@extends('layouts.app')

@section('content')
<div class="content-wrapper container">
	<h3> เพิ่มประวัติการรักษาของ {!! $patient->user()->first()->title !!} {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!} </h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">

				<div class="panel-heading white-text">
					<div class="row">
						<div class="col-md-4">เพิ่มประวัติการรักษา</div>
						<div class="col-md-8 text-right">วันที่วันที่เข้ารักษา: {{ \Carbon\Carbon::now() }}</div>
					</div>
				</div>
				<div class="panel-body">
                    {!! Form::open(['url' => 'record/staff/create', 'class' => 'form-horizontal']) !!}
                        {!! Form::token() !!}
                        {!! Form::hidden('patient_number', $patient->patient_number) !!}
                        {!! Form::hidden('date_time', \Carbon\Carbon::now()) !!}

                        <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
                            {!! Form::label('topic', 'อาการ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('topic', old('topic'), ['class' => 'form-control', 'required', 'autofocus']) !!}
                                @if ($errors->has('topic'))<span class="help-block"><strong>{{ $errors->first('topic') }}</strong></span>@endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                            {!! Form::label('detail', 'รายละเอียดการรักษา', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::textarea('detail', old('detail'), ['class' => 'form-control', 'required', 'autofocus']) !!}
                                @if ($errors->has('detail'))<span class="help-block"><strong>{{ $errors->first('detail') }}</strong></span>@endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('บันทึกข้อมูลการรักษา', ['class' => 'btn btn-success btn-block']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


