<?php $this->load->view('admin/layouts/v_header'); ?>

<body class="hold-transition sidebar-collapse layout-top-nav">
	<div class="preloader d-none">

		<div class="loading">

			<div class="spinner-border" role="status">

				<span class="sr-only">Loading...</span>

			</div>

		</div>

	</div>
	<?php $this->load->view('siswa/layouts/navbar.php'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container">
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<div class="content">
			<div class="container">
				<!-- Tagihan -->
				<div class="row">
					<div class="offset-1 col-sm-10 media-nav">
						<!-- Index Prestasi -->
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h5 class="card-title m-0"><i class="fas fa-fw fa-clipboard-list fa-lg"></i> List Ujian Bulanan Siswa</h5>
							</div>
							<div class="card-body">
								<div class="row">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th>Mata Pelajaran</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($list_ujian as $key => $val) : ?>
												<tr>
													<td class="text-center"><?= ($key + 1) ?></td>
													<td><?= $val['nm_mapel']; ?></td>
													<td class="text-center">
														<form action="<?= site_url('siswa/list_ub/') ?>" method="post">
															<input type="hidden" value="<?= $val['id_pelajaran']; ?>" name="id_pel">
															<input type="hidden" value="<?= $val['nm_mapel']; ?>" name="nama_mapel">
															<input type="hidden" value="<?= $val['nm_pengajar'] ?>" name="nama_pengajar">
															<!-- <a type="submit" href="<?= site_url('list-ub/' . $val['id_pelajaran']) ?>" class="badge badge-primary">Lihat UB</a> -->
															<button type="submit" class="badge badge-primary">Lihat UB</button>
														</form>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
	<!-- /.content-wrapper -->
</body>

</html>