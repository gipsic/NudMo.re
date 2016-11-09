@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h1>Appointment list</h1>
                    <div class="row">
                        <a href="/appointment/patient/create" class="btn btn-primary">Create Appointment</a>
                    </div>
                    @foreach ($appointments as $appointment)
                        <div class="row">
                            <div class="col-md-3">
                                {!! $appointment->date_time !!}
                            </div>
                            <div class="col-md-7">
                                {!! $appointment->doctor()->first()->user()->first()->name !!} {!! $appointment->doctor()->first()->user()->first()->surname !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::open(['url' => '/appointment/patient/'.$appointment->id.'/delete', 'method' => 'delete']) !!}
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
