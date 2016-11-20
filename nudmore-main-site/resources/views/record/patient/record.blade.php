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
					<div class="row mt">
						<div class="col-md-4 text-right">วันที่เข้ารักษา: </div>
						<div class="col-md-8"> {!! $record->date_time !!}</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">น้ำหนัก: </div>
						<div class="col-md-8"> {!! $record->weight !!} กิโลกรัม</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">ส่วนสูง: </div>
						<div class="col-md-8"> {!! $record->height !!} เซนติเมตร</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">อุณหภูมิ: </div>
						<div class="col-md-8"> {!! $record->temperature !!} องศาเซลเซียส</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">อัตราการเต้นของหัวใจ: </div>
						<div class="col-md-8"> {!! $record->heart_rate !!}</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">ความดันโลหิตซีสโตลิค: </div>
						<div class="col-md-8"> {!! $record->systolic_blood_pressure !!}</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">ความดันโลหิตไดแอสโตลิค: </div>
						<div class="col-md-8"> {!! $record->diastolic_blood_pressure !!}</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">อาการ: </div>
						<div class="col-md-8"> {!! $record->topic !!}</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">รหัสโรค: </div>
						<div class="col-md-8"> {!! $record->icd10 !!}</div>
					</div>
					<div class="row mt">
						<div class="col-md-4 text-right">รายละเอียดการรักษา: </div>
						<div class="col-md-8"> {!! $record->detail !!}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
