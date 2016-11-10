@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profile</div>
                <div class="panel-body">
                    {!! Form::open(['url' => '/profile/edit', 'class' => 'form-horizontal']) !!}
                        {!! Form::token() !!}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', 'Username', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('username', $user->username, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control']) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password-confirm', 'Confirm Password', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', 'E-Mail Address', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('email', $user->email, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('title', $user->title, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            {!! Form::label('surname', 'Surname', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('surname', $user->surname, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            {!! Form::label('gender', 'Gender', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('gender', $user->gender, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('identity_number') ? ' has-error' : '' }}">
                            {!! Form::label('identity_number', 'Identity Number', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('identity_number', $user->identity_number, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('identity_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identity_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- {!! Form::hidden('patient_number', $user->patient()->first()->patient_number) !!} --}}

                        <div class="form-group{{ $errors->has('blood_type') ? ' has-error' : '' }}">
                            {!! Form::label('blood_type', 'Blood Type', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('blood_type', $user->patient()->first()->blood_type, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('blood_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('blood_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                            {!! Form::label('birthdate', 'Birth Date', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::date('birthdate', $user->patient()->first()->birthdate, ['class' => 'form-control', 'required']) !!}
                                
                                @if ($errors->has('birthdate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            {!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('address', $user->patient()->first()->address, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('phone_number', $user->patient()->first()->phone_number, ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('drug_allergy') ? ' has-error' : '' }}">
                            {!! Form::label('drug_allergy', 'Drug Allergy', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('drug_allergy', $user->patient()->first()->drug_allergy, ['class' => 'form-control']) !!}

                                @if ($errors->has('drug_allergy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('drug_allergy') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- {!! Form::hidden('administrator', $user->isAdministrator()) !!} --}}

                        {{-- {!! Form::hidden('staff', $user->isStaff()) !!} --}}

                        {{-- {!! Form::hidden('doctor', $user->isDoctor()) !!} --}}
                        {{-- {!! Form::hidden('doctor_number', $user->isDoctor() ? $user->doctor()->first()->doctor_number : '') !!} --}}
                        {{-- {!! Form::hidden('department', $user->isDoctor() ? $user->doctor()->first()->department : '') !!} --}}
                     
                        {{-- {!! Form::hidden('nurse', $user->isNurse()) !!} --}}

                        {{-- {!! Form::hidden('pharmacist', $user->isPharmacist()) !!} --}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
