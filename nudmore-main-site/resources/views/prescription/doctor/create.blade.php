@extends('layouts.app')

@section('content')

<div class="content-wrapper container">
	<h3> ออกใบสั่งยาใหม่ </h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">

				<div class="panel-heading white-text">
					<div class="row">
						<div class="col-md-4">ใบสั่งยาใหม่</div>
						<div class="col-md-8 text-right">วันที่ออกใบสั่งยา: {{ \Carbon\Carbon::now() }}</div>
					</div>
				</div>

				<div class="panel-body">

					<div class="row mt-sm form-group">
						<div class="col-md-5 text-right"><h4>ชื่อยา</h4></div>
						<div class="col-md-3 col-md-offset-1"><h4>ปริมาณที่ใช้</h4></div>
					</div>
					<hr />
					{!! Form::open(['url' => 'prescription/doctor/'.$patient->id.'/create', 'class' => 'form-horizontal']) !!}
					{!! Form::token() !!}

					{!! Form::hidden('date_time', \Carbon\Carbon::now() ) !!}
					@foreach ($medicines as $medicine)
					<div class="row mt-sm form-group">
						{!! Form::label('medicine', $medicine->name, ['class' => 'col-md-5 control-label']) !!}

						<div class="col-md-3 col-md-offset-1">
							{!! Form::number('medicine[]', 0, ['class' => 'form-control', 'required', 'autofocus']) !!}
						</div>

					</div>
					@endforeach
					<hr />
					<div class="form-group">
						<div class="col-md-4 col-md-offset-4">
							{!! Form::submit('บันทึกข้อมูลใบสั่งยา', ['class' => 'btn btn-success btn-block']) !!}
						</div>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


