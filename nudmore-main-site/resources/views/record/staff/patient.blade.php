@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h1>Record History</h1>
                    @foreach ($patients as $patient)
                        <div class="row">
                            <div class="col-md-2">
                                {!! $patient->patient_number !!}
                            </div>
                            <div class="col-md-6">
                                {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::open(['url' => '/record/staff']) !!}
                                    {!! Form::token() !!}
                                    {!! Form::hidden('patient_number', $patient->patient_number) !!}
                                    {!! Form::submit('View Record List', ['class' => 'btn btn-default']) !!}
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
