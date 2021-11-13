<nav class="main-header navbar navbar-expand-md navbar-light navbar-white media-display">
	<div class="container">
		<!-- Right navbar links -->
		<div>
			<ul class="order-1 order-md-3 navbar-nav navbar-no-expand media-float">
				<li class="nav-item dropdown">
					<a href="#" class="nav-link" style="line-height: 1;">
						<i class="fa fa-envelope"></i>
					</a>
				</li>
				<li class="nav-item dropdown" style="line-height: 1;">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><small class="badge badge-notify text-center"></small></a>
				</li>
				<li class="nav-item dropdown" style="line-height: 1;">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-clipboard-list"></i><small class="badge badge-notify text-center">7</small></a>

				</li>
				<li class="nav-item dropdown" style="line-height: 1;">
					<a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fas fa-user-circle"></i></a>
					<ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
						<li><a href="#" class="dropdown-item">Profile</a></li>
						<li><a href="#" class="dropdown-item">Log Out</a></li>
					</ul>
				</li>
			</ul>
			<img class="media-logo-show" src="http://localhost/lms-anak-panah/assets/images/mylogo.png" alt="logo" style="display: none; width: 20%; float:right">
		</div>
	</div>
</nav>


<div class="jumbotron text-center m-0 p-4">
	<div class="row">
		<div class="offset-md-1 col-md-2 col-sm media-header">
			<img class="img-fluid img-thumbnail rounded-circle" src="http://localhost/lms-anak-panah//assets/filesiswa/2010180/logo_banyakjenis-01.png" style="width: 50%">
		</div>
		<div class="col-md-3 col-sm" style="padding-top: 1em">
			<h3 class="text-left media-align-center"><?= $this->session->userdata('nama'); ?></h3>
			<p class="text-left text-muted media-align-center">Kelas X IPS</p>
		</div>

		<div class="offset-md-1 col-md-3 col-sm media-logo-none" style="padding-top: 1em">
			<!-- <p class="text-left">PKBM ANAK PANAH HS</p> -->
			<img src="http://localhost/lms-anak-panah/assets/images/mylogo.png" alt="logo" style="width: 50%;">
		</div>
	</div>
</div>
<div class="dropdown-divider mb-0"></div>

<nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="z-index: 0">
	<div class="container">
		<div class="offset-1 col-sm-10 media-nav">
			<div class="glider-contain">
				<div class="glider">
					<a href="http://localhost/lms-anak-panah/dashboard" class="nav-link" id="home">Home</a>
					<a href="http://localhost/lms-anak-panah/jadwal" class="nav-link" id="schedule">Kalender</a>
					<a href="http://localhost/lms-anak-panah/course" class="nav-link" id="course">Course</a>
					<a href="http://localhost/lms-anak-panah/kisikisi" class="nav-link" id="kisikisi">Kisi-kisi</a>
					<a href="http://localhost/lms-anak-panah/keuangan_siswa" class="nav-link" id="schedule">Keuangan</a>
					<a href="http://localhost/lms-anak-panah/dashboard/penilaian" class="nav-link" id="score">Score</a>
					<a href="#" class="nav-link" id="absensi">Absensi</a>
					<a href="#" class="nav-link">Ujian</a>
				</div>

				<button aria-label="Previous" class="glider-prev">&#8249;</button>
				<button aria-label="Next" class="glider-next">&#8250;</button>
			</div>
		</div>
	</div>
</nav>