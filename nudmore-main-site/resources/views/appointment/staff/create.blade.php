@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Choose Date and Time</div>
                <div class="panel-body">
                @foreach ($available_schedules as $schedule)
                    <div class="row">
                        <div class="col-md-4">
                        {!! $schedule->date_time !!} to <?php $date_time = (new DateTime($schedule->date_time))->modify('+30 minutes')->modify('+2 hours'); echo $date_time->format('H:i:s'); ?>
                        </div>

                        {!! Form::open(['url' => 'appointment/staff/create', 'class' => 'form-horizontal']) !!}
                            {!! Form::token() !!}
                            {!! Form::hidden('patient_number', $patient_number) !!}
                            {!! Form::hidden('doctor_number', $doctor_number) !!}
                            {!! Form::hidden('date_time', $schedule->date_time) !!}
                            <div class="col-md-4">
                                <div class="form-group' }}">
                                    {!! Form::label('reason', 'Reason', ['class' => 'col-md-4 control-label']) !!}

                                    <div class="col-md-6">
                                        {!! Form::text('reason', old('reason'), ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::submit('Make Appointment >>', ['class' => 'btn btn-success']) !!}         
                            </div>
                        {!! Form::close() !!}
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
