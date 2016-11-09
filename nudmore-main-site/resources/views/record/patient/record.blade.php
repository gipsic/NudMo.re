@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{!! $record->topic !!}</div>
                <div class="panel-body">
                    <p>{!! $record->patient()->first()->user()->first()->title !!} {!! $record->patient()->first()->user()->first()->name !!} {!! $record->patient()->first()->user()->first()->surname !!}</p>
                    <p>{!! $record->date_time !!}</p>
                    <p>{!! $record->detail !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
