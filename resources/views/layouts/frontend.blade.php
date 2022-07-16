<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Pontianak Laboratory Information System | POLIS</title>	

		<meta name="keywords" content="WebSite Template" />
		<meta name="description" content="Porto - Multipurpose Website Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ url('frontend/img/favicon.ico') }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ url('frontend/img/apple-touch-icon.png') }}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ url('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/vendor/fontawesome-free/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/vendor/animate/animate.compat.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/vendor/magnific-popup/magnific-popup.min.css') }}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ url('frontend/css/theme.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/css/theme-elements.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/css/theme-blog.css') }}">
		<link rel="stylesheet" href="{{ url('frontend/css/theme-shop.css') }}">

		<!-- Demo CSS -->
		<link rel="stylesheet" href="{{ url('frontend/css/demos/demo-renewable-energy.css') }}">

		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="{{ url('frontend/css/skins/skin-renewable-energy.css') }}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ url('frontend/css/custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ url('frontend/vendor/modernizr/modernizr.min.js') }}"></script>

	</head>
	<body class="alternative-font-7">
        @yield('content')
		

		<!-- Vendor -->
		<script src="{{ url('frontend/vendor/jquery/jquery.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/jquery.cookie/jquery.cookie.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/jquery.validation/jquery.validate.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/lazysizes/lazysizes.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/isotope/jquery.isotope.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/vide/jquery.vide.min.js') }}"></script>
		<script src="{{ url('frontend/vendor/vivus/vivus.min.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ url('frontend/js/theme.js') }}"></script>

		<!-- Demo -->
		<script src="{{ url('frontend/js/demos/demo-renewable-energy.js') }}"></script>
		<script src="{{ url('frontend/js/views/view.contact.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ url('frontend/js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ url('frontend/js/theme.init.js') }}"></script>
	</body>
</html>
