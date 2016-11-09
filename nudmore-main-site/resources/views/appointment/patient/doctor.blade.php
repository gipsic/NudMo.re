@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Choose Doctor</div>
                <div class="panel-body">
                @foreach ($doctors as $doctor)
                    <div class="row">
                        <div class="col-md-2">
                        {!! $doctor->doctor_number !!}
                        </div>
                        <div class="col-md-8">
                        {!! $doctor->user()->first()->name !!} {!! $doctor->user()->first()->surname !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::open(['url' => 'appointment/patient/create/selected', 'class' => 'form-horizontal']) !!}
                                {!! Form::token() !!}
                                {!! Form::hidden('doctor_number', $doctor->doctor_number) !!}
                                {!! Form::submit('Select >>', ['class' => 'btn btn-success']) !!}
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
