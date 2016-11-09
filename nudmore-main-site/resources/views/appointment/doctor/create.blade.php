@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Appoinement</div>
                <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        @foreach ($patients as $patient)
                            <p>{!! $patient->patient_number !!} {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!}</p>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        @foreach ($available_schedules as $schedule)
                            <div class="row">
                                <div class="col-md-8">
                                {!! $schedule->date_time !!} to <?php $date_time = (new DateTime($schedule->date_time))->modify('+20 minutes'); echo $date_time->format('H:i:s'); ?>
                                </div>
                                <div class="col-md-4">
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        {!! Form::open(['url' => 'appointment/doctor/create', 'class' => 'form-horizontal']) !!}
                            {!! Form::token() !!}
                            {!! Form::hidden('doctor_number', $current_user->doctor()->first()->doctor_number) !!}
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
                            <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">
                                {!! Form::label('date_time', 'Date and time', ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::text('date_time', old('date_time'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('date_time'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('date_time') }}</strong>
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
