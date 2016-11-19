


<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="Bootstrap Admin App + jQuery">
		<meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
		<title>{{ config('app.name', 'Laravel') }}</title>
		<!-- =============== VENDOR STYLES ===============-->
		<!-- FONT AWESOME-->
		<link rel="stylesheet" href="{{ url('/vendor/fontawesome/css/font-awesome.min.css') }}">
		<!-- SIMPLE LINE ICONS-->
		<link rel="stylesheet" href="{{ url('/vendor/simple-line-icons/css/simple-line-icons.css') }}">
		<!-- =============== BOOTSTRAP STYLES ===============-->
		<link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}" id="bscss">
		<!-- =============== APP STYLES ===============-->
		<link rel="stylesheet" href="{{ url('/css/app.css') }}" id="maincss">

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Scripts -->
		<script>
			window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(), ]); ?>
		</script>

	</head>

	<body>
		<div class="wrapper">


			@yield('content')

		</div>
		<!-- =============== VENDOR SCRIPTS ===============-->
		<!-- MODERNIZR-->
		<script src="{{ url('/vendor/modernizr/modernizr.custom.js') }}"></script>
		<!-- JQUERY-->
		<script src="{{ url('/vendor/jquery/dist/jquery.js') }}"></script>
		<!-- BOOTSTRAP-->
		<script src="{{ url('/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
		<!-- STORAGE API-->
		<script src="{{ url('/vendor/jQuery-Storage-API/jquery.storageapi.js') }}"></script>
		<!-- PARSLEY-->
		<script src="{{ url('/vendor/parsleyjs/dist/parsley.min.js') }}"></script>
		<!-- =============== APP SCRIPTS ===============-->
		<script src="{{ url('/js/app.js') }}"></script>
	</body>

</html>
