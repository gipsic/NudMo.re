@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Prescription</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'prescription/doctor/'.$patient->id.'/create', 'class' => 'form-horizontal']) !!}
                        {!! Form::token() !!}

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

                        <div class = "form-group">
                            @foreach ($medicines as $medicine)
                            <div class="form-group">
                                {!! Form::label('medicine', $medicine->name, ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::number('medicine[]', 0, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Create Prescription', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
