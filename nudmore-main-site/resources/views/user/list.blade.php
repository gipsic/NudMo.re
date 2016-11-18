@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User List</div>
                <div class="panel-body">
                    <a href="/profile/create" class="btn btn-success">Create User</a>
                    @if ($current_user->isAdministrator())
                        @foreach ($users as $user)
                            <div class="row">
                                <div class="col-md-1">
                                    {!! $user->id !!}
                                </div>
                                <div class="col-md-4">
                                    {!! $user->name !!} {!! $user->surname !!}
                                </div>
                                <div class="col-md-4">
                                @if ($user->isAdministrator())
                                    Admin
                                @endif
                                @if ($user->isStaff())
                                    Staff
                                @endif
                                @if ($user->isDoctor())
                                    Doctor
                                @endif
                                @if ($user->isNurse())
                                    Nurse
                                @endif
                                @if ($user->isPharmacist())
                                    Pharmacist
                                @endif
                                @if ($user->isPatient())
                                    Patient
                                @endif
                                </div>
                                <div class="col-md-1">
                                <a href="/profile/{!! $user->id !!}" class="btn btn-primary">View</a>
                                </div>
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
                            </div>
                        @endforeach
                    @else
                        @foreach ($users as $user)
                            @if ($user->isPatient())
                                <div class="row">
                                    <div class="col-md-1">
                                        {!! $user->id !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! $user->name !!} {!! $user->surname !!}
                                    </div>
                                    <div class="col-md-4">
                                        Patient
                                    </div>
                                    <div class="col-md-1">
                                    <a href="/profile/{!! $user->id !!}" class="btn btn-primary">View</a>
                                    </div>
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
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
