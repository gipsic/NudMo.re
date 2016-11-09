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
                        <div class="col-md-8">
                        {!! $schedule->date_time !!} to <?php $date_time = (new DateTime($schedule->date_time))->modify('+20 minutes'); echo $date_time->format('H:i:s'); ?>
                        </div>
                        <div class="col-md-4">
                            {!! Form::open(['url' => 'appointment/patient/create', 'class' => 'form-horizontal']) !!}
                                {!! Form::token() !!}
                                {!! Form::hidden('patient_number', $current_user->patient()->first()->patient_number) !!}
                                {!! Form::hidden('doctor_number', $doctor_number) !!}
                                {!! Form::hidden('date_time', $schedule->date_time) !!}
                                {!! Form::submit('Make Appointment >>', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
