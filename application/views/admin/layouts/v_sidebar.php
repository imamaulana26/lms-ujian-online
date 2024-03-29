<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="<?= base_url('assets/dist/') . 'img/AdminLTELogo.png' ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminLTE 3</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('assets/dist/') . 'img/user2-160x160.jpg' ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= $this->session->userdata('nm_user'); ?></a>
			</div>
		</div> -->

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?= site_url('dashboard') ?>" class="nav-link" id="dashboard">
						<i class="fa fa-fw fa-desktop nav-icon"></i>
						<p>Dashboard</p>
					</a>
				</li>

				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Data Module
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= site_url('module-soal') ?>" class="nav-link" id="module-soal">
								<i class="far fa-circle nav-icon"></i>
								<p>Module Soal</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-copy"></i>
						<p>
							Management Soal
							<i class="fas fa-angle-left right"></i>
							<!-- <span class="badge badge-info right">6</span> -->
						</p>
					</a>
					<ul class="nav nav-treeview">
						<!-- <li class="nav-item">
							<a href="<?= site_url('dashboard/guru') ?>" class="nav-link" id="test">
								<i class="far fa-circle nav-icon"></i>
								<p>Buat Soal</p>
							</a>
						</li> -->
						<li class="nav-item">
							<a href="<?= site_url('management-soal/lihat-jawaban') ?>" class="nav-link" id="management-soal">
								<i class="far fa-circle nav-icon"></i>
								<p>Lihat Jawaban</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="<?= site_url('manage-quis') ?>" class="nav-link" id="manage-quis">
						<i class="nav-icon fas fa-copy"></i>
						<p>Manage Quis</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= site_url('logout') ?>" class="nav-link">
						<i class="fa fa-fw fa-power-off nav-icon"></i>
						<p>Logout</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
