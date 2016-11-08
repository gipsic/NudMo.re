@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h1>Welcome {{ $user->title }} {{ $user->name }} {{ $user->surname }}!!</h1>
                    <h4>Gender: {{ $user->gender }}</h4>
                    <h4>Date of birth: {{ $user->patient()->first()->birthdate }}</h4>
                    <p>Identity Number: {{ $user->identity_number }}</p>
                    <p>Patient Number: {{ $user->patient()->first()->patient_number }}</p>
                    <p>Email Address: {{ $user->email}}</p>
                    <p>Tel: {{ $user->patient()->first()->phone_number }}</p>
                    <p>Address: {{ $user->patient()->first()->address }}</p>
                    <p>Drug Allergy: {{ $user->patient()->first()->drug_allergy }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
