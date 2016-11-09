@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Medicine List</div>

                <div class="panel-body">
                    <div class="row">
                        <a href="/medicine/create" class="btn btn-primary">Add Medicine</a>
                    </div>
                    @foreach ($medicines as $medicine)
                        <div class="row">
                            <div class="col-md-2">
                                {!! $medicine->id !!}
                            </div>
                            <div class="col-md-6">
                                {!! $medicine->name !!}
                            </div>
                            <div class="col-md-2">
                            <a href="/medicine/{!! $medicine->id !!}/edit" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col-md-2">
                            {!! Form::open(['url' => '/medicine/'.$medicine->id.'/delete', 'method' => 'delete']) !!}
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
