@extends('layouts.blank')

@section('content')

<div class="block-center mt-xl wd-xl">
	<!-- START panel-->
	<div class="panel panel-flat">
		<div class="panel-heading text-center color-light-sky-blue">
			<a href="login.html#">
				<img src="img/logo.png" alt="Image" class="block-center img-rounded">
			</a>
		</div>
		<div class="panel-body">
			<p class="text-center pv">ลงชื่อเข้าใช้เพื่อดำเนินการต่อ</p>
			{!! Form::open(['url' => 'login', 'class' => ' mb-lg']) !!}
                        {!! Form::token() !!}
				<div class="form-group has-feedback">
					<input id="inputUsername" type="username" placeholder="ชื่อผู้ใช้" autocomplete="off" required 
						   class="form-control">
					<span class="fa fa-user form-control-feedback text-muted"></span>
				</div>
				<div class="form-group has-feedback">
					<input id="inputPassword" type="password" placeholder="รหัสผ่าน" required class="form-control">
					<span class="fa fa-lock form-control-feedback text-muted"></span>
				</div>
				<div class="clearfix">
					<div class="checkbox c-checkbox pull-left mt0">
						<label>
							<input type="checkbox" value="" name="remember">
							<span class="fa fa-check"></span>จดจำรหัสผ่าน</label>
					</div> <a class="btn btn-link" href>
					<div class="pull-right"><a href="recover.html" class="text-muted">ลืมรหัสผ่าน?</a>
					</div>
				</div>
				<button type="submit" class="btn btn-block btn-primary mt-lg">เข้าสู่ระบบ</button>
				<a href="{{ url('/register') }}" class="btn btn-block btn-default">สมัครสมาชิก</a>
			{!! Form::close() !!}
		</div>
	</div>
	<!-- END panel-->
	<div class="p-lg text-center">
		<span>&copy;</span>
		<span>2016</span>
		<span>-</span>
		<span>NudMo.re</span>
		<br>
		<span>ระบบนัดหมายแพทย์ NudMore</span>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'login', 'class' => 'form-horizontal']) !!}
                        {!! Form::token() !!}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', 'Username', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('username', old('username'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control', 'required']) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('remember') !!} Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
