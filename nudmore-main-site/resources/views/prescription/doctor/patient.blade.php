@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Prescription List of {!! $patient->user()->first()->title !!} {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!}</div>
                <a href="/prescription/doctor/{!! $patient->id !!}/create" class="btn btn-primary">Create Prescription</a>
                <div class="panel-body">
                    @foreach ($prescriptions as $prescription)
                        <div class="row">
                            <div class="col-md-2">
                                {!! $prescription->id !!}
                            </div>
                            <div class="col-md-8">
                                {!! $prescription->date_time !!}
                            </div>
                            <div class="col-md-2">
                            <a href="/prescription/{!! $prescription->id !!}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
