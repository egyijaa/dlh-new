<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Pontianak Laboratory Information System | {{ auth()->user()->role == 1 ? 'Admin' : 'Pelanggan' ?? '' }}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ url('admin/img/icon.ico' ) }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ url('admin/js/plugin/webfont/webfont.min.js' ) }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ url('admin/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ url('admin/css/bootstrap.min.css' ) }}">
	<link rel="stylesheet" href="{{ url('admin/css/atlantis.min.css' ) }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ url('admin/css/demo.css' ) }}">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="/" class="logo">
					<img src="{{ url('frontend/img/demos/logopemkot.png') }}" style="width: 50px" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ url('admin/img/user.png') }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{ url('admin/img/user.png') }}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ auth()->user()->name }}</h4>
												<p class="text-muted">{{ auth()->user()->email }}</p><a 
												@if (auth()->user()->role == 0)
												href="{{ route('pelanggan.profil.changePassword', Auth::user()->id) }}"
												@else
												href="{{ route('admin.profil.changePassword', Auth::user()->id) }}"
												@endif
												
												class="btn btn-xs btn-secondary btn-sm">Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item"  href="{{ route('logout') }}"
										onclick="event.preventDefault();
													  document.getElementById('logout-form').submit();">Keluar</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		
		@if (auth()->user()->role == 1 )
		@include('component.sidebar_admin')
		
		@else
		@include('component.sidebar_pelanggan')
			
		@endif
		<!-- End Sidebar -->

		<div class="main-panel">
			@include('sweetalert::alert')
			@yield('content')
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto">
						2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>
		
	</div>
	<!--   Core JS Files   -->
	<script src="{{ url('admin/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ url('admin/js/core/popper.min.js') }}"></script>
	<script src="{{ url('admin/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ url('admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ url('admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ url('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


	<!-- Chart JS
	<script src="admin/js/plugin/chart.js/chart.min.js"></script> -->

	<!-- jQuery Sparkline
	<script src="admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script> -->

	<!-- Chart Circle
	<script src="admin/js/plugin/chart-circle/circles.min.js"></script> -->

	<!-- Datatables -->
	<script src="{{ url('admin/js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ url('admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- jQuery Vector Maps
	<script src="admin/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="admin/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script> -->

	<!-- Atlantis JS -->
	<script src="{{ url('admin/js/atlantis.min.js') }}"></script>

	@stack('scripts')

	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});
		});
	</script>
</body>
</html>