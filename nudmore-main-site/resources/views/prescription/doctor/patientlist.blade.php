@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Choose Patient</div>
                <div class="panel-body">
                    @foreach ($patients as $patient)
                        <div class="row">
                            <div class="col-md-2">
                                {!! $patient->patient_number !!}
                            </div>
                            <div class="col-md-8">
                                {!! $patient->user()->first()->title !!} {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!}
                            </div>
                            <div class="col-md-2">
                            <a href="/prescription/doctor/{!! $patient->id !!}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
