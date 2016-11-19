@extends('layouts.app')

@section('content')
<div class="container content-wrapper">
	<h3>ยินดีต้อนรับเข้าสู่ Nudmore</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-3">
						<img src="/img/user01.jpg" alt="Image" class="media-object img-circle img-responsive">
					</div>
					<div class="col-lg-9">
						<h4> สวัสดี {{$current_user->name}} {{$current_user->surname}} </h4>
						<p class="m0"> (คลิกเลือกแถบเมนูทางด้านซ้าย เพื่อทำรายการ) </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
