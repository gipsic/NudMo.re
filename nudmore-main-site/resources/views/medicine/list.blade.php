@extends('layouts.app')

@section('content')
<div class="content-wrapper container">
	<h3>จัดการรายชื่อยา <a href="{{ url('/medicine/create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> สร้างข้อมูลยาใหม่</a></h3>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table id="datatable2" class="table table-striped table-hover">
							<thead>
								<tr>
									<th>ลำดับที่</th>
									<th>ชื่อยา</th>
									<th> การจัดการ </th>
								</tr>
							</thead>
							<tbody>
								@foreach ($medicines as $medicine)
								<tr>
									<td>{!! $medicine->id !!}</td>
									<td>{!! $medicine->name !!}</td>
									<td>
										{!! Form::open(['url' => '/medicine/'.$medicine->id.'/delete', 'method' => 'delete']) !!}
										{!! Form::token() !!}
										<a href="{{ url('/medicine/'.$medicine->id.'/edit') }}" class="btn btn-labeled btn-warning"> <span class="btn-label"><i class="fa fa-pencil-square-o"></i> </span> แก้ไข </a>
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
				text: "คุณจะไม่สามารถกู้คืนข้อมูลผู้ใช้รายนี้ได้อีก!",
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
					swal("ยกเลิกแล้ว", "ข้อมูลผู้ใช้ไม่ถูกลบ :)", "error");
				}
			});

		});


	})(window, document, window.jQuery);
</script>


@endsection
