@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Record of {!! $patient->user()->first()->name !!} {!! $patient->user()->first()->surname !!}</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'record/staff/create', 'class' => 'form-horizontal']) !!}
                        {!! Form::token() !!}
                        {!! Form::hidden('patient_number', $patient->patient_number) !!}

                        <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
                            {!! Form::label('topic', 'Topic', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('topic', old('topic'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                @if ($errors->has('topic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                            {!! Form::label('detail', 'Detail', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('detail', old('detail'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                @if ($errors->has('detail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('detail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">
                            {!! Form::label('date_time', 'Date and time', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('date_time', \Carbon\Carbon::now(), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                @if ($errors->has('date_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Create Record', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
