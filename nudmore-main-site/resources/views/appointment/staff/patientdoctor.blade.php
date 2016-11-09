@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Choose Patient and Doctor</div>
                <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        @foreach ($patients as $patient)
                            <p>{!! $patient->patient_number !!} {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!}</p>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        @foreach ($doctors as $doctor)
                            <p>{!! $doctor->doctor_number !!} {!! $doctor->user()->first()->name !!} {!! $doctor->user()->first()->surname !!}</p>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        {!! Form::open(['url' => 'appointment/staff/create/selected', 'class' => 'form-horizontal']) !!}
                            {!! Form::token() !!}
                            <div class="form-group{{ $errors->has('patient_number') ? ' has-error' : '' }}">
                                {!! Form::label('patient_number', 'Patient Number', ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::text('patient_number', old('patient_number'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('patient_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('patient_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('doctor_number') ? ' has-error' : '' }}">
                                {!! Form::label('doctor_number', 'Doctor Number', ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::text('doctor_number', old('doctor_number'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('doctor_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('doctor_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {!! Form::submit('Make Appointment >>', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection