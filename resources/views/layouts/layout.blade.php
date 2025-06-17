<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no"/>
	<meta name="theme-color" content="#000000"/>
	<meta http-equiv="Content-Language" content="ru">
	<meta name="robots" content="{{ $robots }}">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="company-alias" content="{{ $companyAlias }}">
	<meta name="company-name" content="{{ $companyName }}">
	<meta name="company-type" content="{{ $companyType }}">

	<meta name="page" content="{{ $page }}">


	<!--этот файл загружается чтоб ослиный браузер понимал html5-->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
    <![endif]-->

	<link rel="shortcut icon" href="/public/favicon.ico"/>
	
	<title>{{ $pageTitle }}</title> 

	<link href= {{ $css_main }} rel="stylesheet">
	@yield('link_css')

</head>	
		
<body>

	@yield('content')

	<script type="text/javascript" src={{ $js_vendors }}></script>
    @yield('script_js')


</body>
</html>
