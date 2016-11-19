@extends('layouts.app')

@section('content')
<div class="content-wrapper container">
	<h3> เพิ่มเวลาออกตรวจของท่าน</h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">

				<div class="panel-heading white-text">กำหนดเวลาออกตรวจ</div>
				<div class="panel-body">
                    {!! Form::open(['url' => 'schedule/doctor/create', 'class' => 'form-horizontal']) !!}
                        {!! Form::token() !!}
                        {!! Form::hidden('doctor_number', $current_user->doctor->doctor_number) !!}

                        <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">
                            {!! Form::label('date_time', 'เลือกวันและช่วงเวลา', ['class' => 'col-md-3 control-label']) !!}
                            {!! Form::hidden('date_time', old('date_time'), ['id' => 'date_time', 'required', 'autofocus']) !!}
                            <div class="col-md-5">
								{!! Form::date('dat', \Carbon\Carbon::tomorrow(), ['class' => 'form-control', 'id'=>'dat', 'required']) !!}
                            </div>
                            <div class="col-md-4">
								<select id="period" class="form-control col-md-9"><option value="09:00:00">09.00 น. - 11.30 น.</option><option value="13:00:00">13.00 น. - 15.30 น.</option></select>
							</div>
                            <div class="col-md-9 col-md-offset-3">
                                @if ($errors->has('date_time'))<span class="help-block"><strong>{{ $errors->first('date_time') }}</strong></span>@endif
							</div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('บันทึกเวลาออกตรวจ', ['class' => 'btn btn-success btn-block']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer_script')

<script>
	jQuery("#period, #dat").change(function(){
		var t = jQuery("#period").val();
		var d = jQuery("#dat").val();
		jQuery("#date_time").val(d+" "+t);
	}).trigger("change");
</script>
@endsection


