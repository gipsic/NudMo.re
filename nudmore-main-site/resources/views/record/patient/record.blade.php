@extends('layouts.app')

@section('content')
<div class="content-wrapper container">
	<h3> รายละเอียดการรักษา </h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">

				<div class="panel-heading white-text">
					ผู้ป่วย: {!! $record->patient()->first()->user()->first()->title !!} {!! $record->patient()->first()->user()->first()->name !!} {!! $record->patient()->first()->user()->first()->surname !!}
				</div>

				<div class="panel-body">
					<div class="row mt-sm">
						<div class="col-md-4 text-right">วันที่เข้ารักษา: </div>
						<div class="col-md-8"> {!! $record->date_time !!}</div>
					</div>
					<div class="row mt-sm">
						<div class="col-md-4 text-right">อาการ: </div>
						<div class="col-md-8"> {!! $record->topic !!}</div>
					</div>
					<div class="row mt-sm">
						<div class="col-md-4 text-right">รายละเอียดการรักษา: </div>
						<div class="col-md-8"> {!! $record->detail !!}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
