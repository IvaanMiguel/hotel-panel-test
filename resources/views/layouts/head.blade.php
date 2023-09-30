
<meta charset="utf-8" />
<title>
	<?php
		$title = "";
		$url = $_SERVER["REQUEST_URI"];
		$url != "/"? $title = "Panel Administrativo | Hotel" : "Sign In | Hotel";  
		echo $title;
	?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Sign In | Hotel - Admin" name="description" />
<meta content="DevcoBaja" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{ $slot }}

<!-- Layout config Js -->
<script src="{{ asset('assets/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- gridjs css -->
<link rel="{{ asset('stylesheet" href="assets/libs/gridjs/theme/mermaid.min.css') }}">

<!--Swiper slider css-->
<link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
