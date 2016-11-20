@extends('layouts.app')

@section('content')
<div class="content-wrapper container">
	<h3>รายการนัดหมายของท่าน <a href="{{ url('/appointment/doctor/create/'.'') }}" class="btn btn-success pull-right"><i class="fa-plus fa"></i> เพิ่มรายการนัดหมายใหม่</a></h3>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-4">รหัสแพทย์: {!! $current_user->doctor()->first()->doctor_number !!}</div>
						<div class="col-md-8 text-right">{!! $current_user->title !!} {!! $current_user->name !!} {!! $current_user->surname !!}</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="datatable2" class="table table-striped table-hover">
							<thead>
								<tr>
									<th>วันเวลานัดหมาย</th>
									<th>รหัสผู้ป่วย</th>
									<th>ชื่อผู้ป่วย</th>
									<th>อาการ</th>
									<th> การจัดการ </th>
								</tr>
							</thead>
							<tbody>
								@foreach ($appointments as $appointment)
								<tr>
									<td>{!! $appointment->date_time !!}</td>
									<td>{!! $appointment->patient()->first()->patient_number !!}</td>
									<td>{!! $appointment->patient()->first()->user()->first()->title !!} {!! $appointment->patient()->first()->user()->first()->name !!} {!! $appointment->patient()->first()->user()->first()->surname !!}</td>
									<td>{!! $appointment->reason !!}</td>
									<td>
										{!! Form::open(['url' => '/appointment/doctor/'.$appointment->id.'/delete', 'method' => 'delete']) !!}
										{!! Form::token() !!}
										<a class="btn btn-labeled btn-danger deleteU"> <span class="btn-label"><i class="fa fa-times"></i> </span> ลบ </a>
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer_script')

<!-- DATATABLES-->
<link rel="stylesheet" href="{{ url('/vendor/datatables/media/css/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ url('/vendor/dataTables.fontAwesome/index.css') }}">
<!-- DATATABLES-->
<script src="{{ url('/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/vendor/datatables/media/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ url('/vendor/datatables-responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ url('/vendor/datatables-responsive/js/responsive.bootstrap.js') }}"></script>
<script>
	(function(window, document, $, undefined){
		var dtInstance2 = $('#datatable2').dataTable({
			'paging':   true,  // Table pagination
			'ordering': true,  // Column ordering
			'info':     true,  // Bottom left status text
			'responsive': true, // https://datatables.net/extensions/responsive/examples/
			// Text translation options
			// Note the required keywords between underscores (e.g _MENU_)
			oLanguage: {
				sSearch:      'Search all columns:',
				sLengthMenu:  '_MENU_ records per page',
				info:         'Showing page _PAGE_ of _PAGES_',
				zeroRecords:  'Nothing found - sorry',
				infoEmpty:    'No records available',
				infoFiltered: '(filtered from _MAX_ total records)'
			}
		});
		var inputSearchClass = 'datatable_input_col_search';
		var columnInputs = $('tfoot .'+inputSearchClass);

		// On input keyup trigger filtering
		columnInputs.keyup(function () {
			dtInstance2.fnFilter(this.value, columnInputs.index(this));
		});
		$(".deleteU").click(function(){
			var t = jQuery(this).parents("form");
			swal({
				title: "แน่ใจหรือไม่?",
				text: "",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "ใช่, ยืนยันการลบ!",
				cancelButtonText: "ไม่, ยกเลิกการลบ!",
				closeOnConfirm: false,
				closeOnCancel: false
			},
				 function(isConfirm){
				if (isConfirm) {
					swal("ลบแล้ว!", "", "success");
					t.submit();
				} else {
					swal("ยกเลิกแล้ว", "ข้อมูลเวลาออกตรวจไม่ถูกลบ :)", "error");
				}
			});

		});
	})(window, document, window.jQuery);
</script>


@endsection


