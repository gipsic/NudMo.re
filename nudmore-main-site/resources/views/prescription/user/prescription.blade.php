@extends('layouts.app')

@section('content')

<div class="content-wrapper container">
	<h3> รายละเอียดใบสั่งยา หมายเลข {!! $prescription->id !!} </h3>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">

				<div class="panel-heading white-text">
					<div class="row">
						<div class="col-md-4">ใบสั่งยาหมายเลข: {!! $prescription->id !!}</div>
						<div class="col-md-8 text-right">วันที่ออกใบสั่งยา: {!! $prescription->created_at !!}</div>
					</div>
				</div>

				<div class="panel-body">
					<div class="row mt">
						<div class="col-md-3"><strong>ชื่อยา</strong></div>
						<div class="col-md-6"><strong>วิธีใช้</strong></div>
						<div class="col-md-3 text-center"><strong>ปริมาณที่ใช้</strong></div>
					</div>
					@foreach ($dispenses as $dispense)
					<div class="row mt-sm">
						<div class="col-md-3">
							{!! $dispense->medicine()->first()->name !!}
						</div>
						<div class="col-md-6">
							{!! $dispense->medicine()->first()->how_to_use !!}
						</div>
						<div class="col-md-3 text-center">
							{!! $dispense->quantity !!}
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
