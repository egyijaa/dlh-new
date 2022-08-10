<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Pontianak Laboratory Information System | POLIS</title>	

		<meta name="keywords" content="Pontianak Laboratory Information System | POLIS" />
		<meta name="description" content="Pontianak Laboratory Information System | POLIS">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ url('frontend/logopemkot.webp') }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ url('frontend/logopemkot.webp') }}">

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

		{{-- databale --}}
		<link rel="stylesheet" href="{{ url('frontend/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


		<!-- Demo CSS -->
		<link rel="stylesheet" href="{{ url('frontend/css/demos/demo-renewable-energy.css') }}">

		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="{{ url('frontend/css/skins/skin-renewable-energy.css') }}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ url('frontend/css/custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ url('frontend/vendor/modernizr/modernizr.min.js') }}"></script>

		<style>
			.float{
			position:fixed;
			width:60px;
			height:60px;
			bottom:50px;
			right:15px;
			background-color:#25d366;
			color:#FFF;
			border-radius:50px;
			text-align:center;
		  font-size:30px;
			box-shadow: 2px 2px 3px #999;
		  z-index:100;
		}
		
		.my-float{
			margin-top:16px;
		}
		  </style>

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


		<script src="{{ url('frontend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('frontend/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('frontend/vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ url('frontend/vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ url('frontend/vendor/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ url('frontend/vendor/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ url('frontend/js/theme.js') }}"></script>

		<!-- Demo -->
		<script src="{{ url('frontend/js/demos/demo-renewable-energy.js') }}"></script>
		<script src="{{ url('frontend/js/views/view.contact.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ url('frontend/js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ url('frontend/js/theme.init.js') }}"></script>
		@stack('scripts')

		<script>
            $(function () {
              $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
          </script>
	</body>
</html>
