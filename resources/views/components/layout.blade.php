<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
	<title>{{ $title }} &mdash; Inventaris Sekolah</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.css') }}" />

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap4.css" />

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
	<link rel="stylesheet" href="{{ url('assets/css/components.css') }}" />
	<!-- <link rel="stylesheet" href="{{ url('css/modal-consistent.css') }}" /> -->
	<link rel="stylesheet" href="{{ url('css/dashboard-clean.css') }}" />
	<link rel="stylesheet" href="{{ url('css/chart-visible.css') }}" />
	<link rel="stylesheet" href="{{ url('css/stat-cards-fix.css') }}" />
	<link rel="stylesheet" href="{{ url('css/icon-styles.css') }}" />
	<link rel="stylesheet" href="{{ url('css/icon-force.css') }}" />
	<link rel="stylesheet" href="{{ url('css/icon-simple.css') }}" />
	<link rel="stylesheet" href="{{ url('css/pie-chart-fix.css') }}" />
	<link rel="stylesheet" href="{{ url('css/logout-button.css') }}" />
	<!-- CSS untuk fix modal data barang -->
	<link rel="stylesheet" href="{{ url('css/modal-data-barang-fix.css') }}" />
	<link rel="stylesheet" href="{{ url('css/chart-text-white.css') }}" />

	<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/1.4.0/css/tom-select.bootstrap4.min.css" />
</head>

<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<form class="form-inline mr-auto">
					<ul class="navbar-nav mr-3">
						<li>
							<a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
						</li>
					</ul>
				</form>
				<ul class="navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1" />
							<div class="d-sm-none d-lg-inline-block">Halo, {{ auth()->user()->name }}</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-title">Akun sejak: {{ auth()->user()->diffForHumanDate(auth()->user()->created_at) }}
							</div>
							@can('mengatur profile')
							<a href="{{ route('profile.index') }}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
								Pengaturan Profil </a>
							@endcan
							<div class="dropdown-divider"></div>
							{{--
							<a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}">
								<i class="fas fa-sign-out-alt"></i>
								{{ __('Logout') }}
							</a>
							--}}
							<form id="logout-form" action="{{ route('logout') }}" method="POST">
								@csrf

								<button type="submit" class="dropdown-item has-icon btn-link text-danger logout">
									Logout
								</button>
							</form>
						</div>
					</li>
				</ul>
			</nav>

			<div class="main-sidebar">
				<aside id="sidebar-wrapper">
					<div class="sidebar-brand">
						<a href="{{ route('home') }}">INVENTARIS SEKOLAH</a>
					</div>
					<div class="sidebar-brand sidebar-brand-sm">
						<a href="{{ route('home') }}">IS</a>
					</div>
					<ul class="sidebar-menu">
						<li class="menu-header">Dashboard</li>
						<li class="nav-item dropdown{{ request()->routeIs('home') ? ' active' : '' }}">
							<a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
						</li>
						<li class="menu-header">Manajemen</li>
						@can('lihat barang')
						<li class="nav-item dropdown{{ request()->routeIs('barang.index') ? ' active' : '' }}">
							<a href="{{ route('barang.index') }}" class="nav-link"><i class="fas fa-boxes-stacked"></i> <span>Data
									Barang</span></a>
						</li>
						@endcan @can('lihat bos')
						<li class="nav-item dropdown{{ request()->routeIs('bantuan-dana-operasional.index') ? ' active' : '' }}">
							<a class="nav-link" href="{{ route('bantuan-dana-operasional.index') }}"><i class="far fa-face-laugh"></i>
								<span>Data BOS</span></a>
						</li>
						@endcan @can('lihat ruangan')
						<li class="nav-item dropdown{{ request()->routeIs('ruangan.index') ? ' active' : '' }}">
							<a href="{{ route('ruangan.index') }}" class="nav-link"><i class="fas fa-map-location-dot"></i> <span>Data
									Ruangan</span></a>
						</li>
						@endcan @can('lihat pengguna')
						<li class="nav-item dropdown{{ request()->routeIs('pengguna.index') ? ' active' : '' }}">
							<a href="{{ route('pengguna.index') }}" class="nav-link"><i class="fas fa-users"></i> <span>Data
									Pengguna</span></a>
						</li>
						@endcan
						@can('lihat peminjaman')
						<li class="nav-item dropdown{{ request()->routeIs('peminjaman.*') ? ' active' : '' }}">
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-exchange-alt"></i> <span>Peminjaman Barang</span></a>
							<ul class="dropdown-menu">
								<li><a class="nav-link" href="{{ route('peminjaman.barang-masuk') }}">Peminjaman</a></li>
								<li><a class="nav-link" href="{{ route('peminjaman.barang-keluar') }}">Pengembalian</a></li>
							</ul>
						</li>
						@endcan
						<li class="menu-header">Pengaturan</li>
						@can('mengatur profile')
						<li class="nav-item dropdown{{ request()->routeIs('profile.index') ? ' active' : '' }}">
							<a href="{{ route('profile.index') }}" class="nav-link"><i class="fas fa-cog"></i> <span>Pengaturan
									Profil</span></a>
						</li>
						@endcan @can('lihat peran dan hak akses')
						<li class="nav-item dropdown{{ request()->routeIs('peran-dan-hak-akses.index') ? ' active' : '' }}">
							<a href="{{ route('peran-dan-hak-akses.index') }}" class="nav-link"><i class="fas fa-user-shield"></i>
								<span>Peran & Hak Akses</span></a>
						</li>
						@endcan
					</ul>

					<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
						<form id="logout-form" action="{{ route('logout') }}" method="POST">
							<button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split logout">
								<i class="fas fa-fw fa-sign-out-alt"></i>
								Logout
							</button>
							@csrf
						</form>
					</div>
				</aside>
			</div>

			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>{{ $page_heading }}</h1>
					</div>

					{{ $slot }}
				</section>
			</div>
		</div>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ url('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ url('assets/js/popper.min.js') }}"></script>
	<script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('assets/js/jquery.nicescroll.min.js') }}"></script>
	<script src="{{ url('assets/js/moment.min.js') }}"></script>
	<script src="{{ url('assets/js/stisla.js') }}"></script>

	<!-- JS Libraies -->
	<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap4.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<!-- Template JS File -->
	<script src="{{ url('assets/js/scripts.js') }}"></script>
	<script src="{{ url('assets/js/custom.js') }}"></script>
	<script src="{{ url('js/dashboard-simple.js') }}"></script>
	<script src="{{ url('js/chart-helper.js') }}"></script>
	<script src="{{ url('js/stat-cards-fix.js') }}"></script>
	<script src="{{ url('js/icon-fix.js') }}"></script>
	<script src="{{ url('js/icon-force.js') }}"></script>
	<script src="{{ url('js/pie-chart-fix.js') }}"></script>

	<!-- Page Specific JS File -->
	<script src="{{ url('assets/js/page/index-0.js') }}"></script>

	<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

	<script src="{{ asset('js/scripts.js') }}"></script>

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

	<script>
		$(document).ready(function () {
        $(".delete-button").click(function (e) {
          e.preventDefault();
          Swal.fire({
            title: "Hapus?",
            text: "Data tidak akan bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            reverseButtons: true,
          }).then((result) => {
            if (result.value) {
              $(this).parent().submit();
            }
          });
        });

        $(".logout").click(function (e) {
          e.preventDefault();
          
          // Tambahkan efek ripple
          const button = this;
          const ripple = document.createElement('span');
          const rect = button.getBoundingClientRect();
          const size = Math.max(rect.width, rect.height);
          const x = e.clientX - rect.left - size / 2;
          const y = e.clientY - rect.top - size / 2;
          
          ripple.style.width = ripple.style.height = size + 'px';
          ripple.style.left = x + 'px';
          ripple.style.top = y + 'px';
          ripple.classList.add('ripple');
          
          button.appendChild(ripple);
          
          // Hapus ripple setelah animasi selesai
          setTimeout(() => {
            ripple.remove();
          }, 600);
          
          // Hapus semua modal yang mungkin terbuka
          $('.modal').modal('hide');
          $('.modal-backdrop').remove();
          
          // Tambahkan loading state
          $(button).addClass('loading');
          
          // Gunakan konfirmasi browser native yang bersih dan tidak akan konflik dengan CSS apapun
          if (confirm("Keluar?\n\nAnda akan keluar dari aplikasi Inventaris Sekolah.\n\nKlik 'OK' untuk keluar atau 'Cancel' untuk batal.")) {
            $(this).closest('form').submit();
          } else {
            // Hapus loading state jika dibatalkan
            $(button).removeClass('loading');
          }
        });
      });
	</script>
	@stack('modal')
	@stack('js')
</body>

</html>