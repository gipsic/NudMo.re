@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Schedule list</div>

                <div class="panel-body">
                    <div class="row">
                        <a href="/schedule/staff/create" class="btn btn-primary">Create Schedule</a>
                    </div>
                    @foreach ($schedules as $schedule)
                        <div class="row">
                            <div class="col-md-3">
                                {!! $schedule->date_time !!}
                            </div>
                            <div class="col-md-2">
                                {!! $schedule->doctor_number !!}
                            </div>
                            <div class="col-md-5">
                                {!! $schedule->doctor()->first()->user()->first()->name !!} {!! $schedule->doctor()->first()->user()->first()->surname !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::open(['url' => '/schedule/staff/'.$schedule->id.'/delete', 'method' => 'delete']) !!}
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
