@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h1>Record History of {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!}</h1>
                    <div class="row">
                        <a href="/record/staff/create/{!! $patient->patient_number !!}" class="btn btn-primary">Create Record</a>
                    </div>
                    @foreach ($records as $record)
                        <div class="row">
                            <div class="col-md-3">
                                {!! $record->date_time !!}
                            </div>
                            <div class="col-md-7">
                                {!! $record->topic !!}
                            </div>
                            <div class="col-md-2">
                            <a href="/record/staff/{!! $record->id !!}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
