<?php $this->load->view('admin/layouts/v_header'); ?>
<style>
	.select2-selection__choice {
		background-color: #0069d9 !important;
	}

	.select2-selection__choice span {
		color: white !important;
	}
</style>

<body class="hold-transition sidebar-mini text-sm">
	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('admin/layouts/v_navbar'); ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('admin/layouts/v_sidebar'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row my-2">
						<div class="col-sm-6">
							<h1 class="text-dark"><?= $title; ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<?php foreach ($breadcrumb as $val) {
									echo $val;
								} ?>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg">
							<a href="<?= site_url('manage-quis') ?>" class="btn btn-sm btn-primary mb-3">Kembali</a>
							<div class="card">
								<div class="card-header">
									<div class="form-group row mb-0">
										<label class="col-sm-2">Jenis Program</label>
										<div class="col-md-10">
											<p><?= ucfirst($dt_program[0]['jns_program']) ?></p>
										</div>
									</div>

									<div class="form-group row mb-0">
										<label class="col-sm-2">Nama Kelas</label>
										<div class="col-md-10">
											<p><?= $dt_program[0]['kelas_nama'] ?></p>
										</div>
									</div>

									<div class="form-group row mb-0">
										<label class="col-sm-2">Mata Pelajaran</label>
										<div class="col-md-10">
											<p><?= $dt_program[0]['nm_mapel'] ?></p>
										</div>
									</div>

									<div class="form-group row mb-0">
										<label class="col-sm-2">Waktu Pengerjaan</label>
										<div class="col-md-10">
											<p><?= $dt_program[0]['waktu_pengerjaan'] . ' Menit' ?></p>
										</div>
									</div>
								</div>
								<div class="card-body">
									<label>Daftar Peserta Test</label>
									<form action="<?= site_url('guru/manage_quis/save_peserta') ?>" method="post">
										<input name="id_modul" type="hidden" value="<?= $this->uri->segment('3') ?>">
										<select class="select2" name="peserta[]" multiple="multiple" style="width: 100%; ">
											<?php foreach ($peserta as $key => $val) {
												$select = $val['selected'] == 1 ? 'selected' : ''; ?>
												<option value="<?= $val['nis'] ?>" <?= $select ?>><?= $val['nama'] ?></option>
											<?php }  ?>
										</select>
										<button type="submit" class="btn btn-primary mt-3">Simpan</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<?php $this->load->view('admin/layouts/v_footer'); ?>
	</div>
	<!-- ./wrapper -->
</body>

<script>
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>

</html>
