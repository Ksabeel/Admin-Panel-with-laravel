<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    @include('admin._includes._head')
</head>
<body>

	@include('admin._includes._navbar')

	@include('admin._includes._sidebar')

	<div id="wrapper">
		@yield('content')
	</div>
	
	@include('admin._includes._footer');
</body>
</html>