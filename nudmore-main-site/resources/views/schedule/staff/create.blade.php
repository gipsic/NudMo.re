@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Schedule</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'schedule/staff/create', 'class' => 'form-horizontal']) !!}
                        {!! Form::token() !!}

                        <div class="form-group{{ $errors->has('doctor_number') ? ' has-error' : '' }}">
                            {!! Form::label('doctor_number', 'Doctor Number', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('doctor_number', old('doctor_number'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                @if ($errors->has('doctor_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('doctor_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">
                            {!! Form::label('date_time', 'Date and time', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('date_time', old('date_time'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                @if ($errors->has('date_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Create Schedule', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
