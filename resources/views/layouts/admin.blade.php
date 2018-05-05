<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('styles')
</head>

<body>

@include('admin.includes._nav')
    
<div class="container-fluid" id="app">
	<div class="row">

        @include('admin.includes._sidebar')
        
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @yield('content')
        </main>
		
	</div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>