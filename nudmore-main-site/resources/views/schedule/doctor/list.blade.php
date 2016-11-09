@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Schedule list</div>

                <div class="panel-body">
                    {!! $current_user->doctor->doctor_number !!}

                    <div class="row">
                        <a href="/schedule/doctor/create" class="btn btn-primary">Create Schedule</a>
                    </div>
                    @foreach ($schedules as $schedule)
                        <div class="row">
                            <div class="col-md-10">
                                {!! $schedule->date_time !!} to <?php $date_time = (new DateTime($schedule->date_time))->modify('+20 minutes'); echo $date_time->format('H:i:s'); ?>
                            </div>
                            <div class="col-md-2">
                                {!! Form::open(['url' => '/schedule/doctor/'.$schedule->id.'/delete', 'method' => 'delete']) !!}
                                    {!! Form::token() !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
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
