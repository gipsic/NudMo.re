@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Prescription: {!! $prescription->id !!}</div>

                <div class="panel-body">
                    @foreach ($dispenses as $dispense)
                        <div class="row">
                            <div class="col-md-10">
                                {!! $dispense->medicine()->first()->name !!}
                            </div>
                            <div class="col-md-2">
                                {!! $dispense->quantity !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
