@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome {{ $user->title }} {{ $user->name }} {{ $user->surname }}!!</div>

                <div class="panel-body">
                    <h4>Gender: {{ $user->gender }}</h4>
                    <h4>Date of birth: {{ $user->patient()->first()->birthdate }}</h4>
                    <p>Identity Number: {{ $user->identity_number }}</p>
                    <p>Patient Number: {{ $user->patient()->first()->patient_number }}</p>
                    <p>Email Address: {{ $user->email}}</p>
                    <p>Tel: {{ $user->patient()->first()->phone_number }}</p>
                    <p>Address: {{ $user->patient()->first()->address }}</p>
                    <p>Drug Allergy: {{ $user->patient()->first()->drug_allergy }}</p>

                    @if ($current_user->id === $user->id)
                    <div class="col-md-1">
                        <a href="/profile/edit" class="btn btn-success">Edit</a>
                    </div>
                    @elseif ($current_user->isAdministrator())
                        <div class="col-md-1">
                        <a href="/profile/{!! $user->id !!}/edit" class="btn btn-success">Edit</a>
                        </div>
                        <div class="col-md-1">
                        @if ($user->id != $current_user->id)
                            {!! Form::open(['url' => '/profile/'.$user->id.'/delete', 'method' => 'delete']) !!}
                                {!! Form::token() !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
