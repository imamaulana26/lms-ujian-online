<?php $this->load->view('admin/layouts/v_header'); ?>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand font-weight-bold" href="">Computer Basted-Test</a>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#"><?= $_SESSION['nm_user'] ?> <i class="fa fa-fw fa-user-circle"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<spam class="font-weight-bold">Detail Soal Ujian</spam>
			</div>
			<div class="card-body">
				<div class="row d-flex justify-content-center">
					<div class="col-md-6">
						<table class="table table-bordered table-sm">
							<tr>
								<th class="pl-2">Module</th>
								<td class="pl-2">UB-<?= $soal['modul_ub']; ?></td>
							</tr>
							<tr>
								<th class="pl-2">Mata Pelajaran</th>
								<td class="pl-2"><?= $soal['nm_mapel']; ?></td>
							</tr>
							<tr>
								<th class="pl-2">Nama Pengajar</th>
								<td class="pl-2"><?= $soal['nm_pengajar']; ?></td>
							</tr>
							<tr>
								<th class="pl-2">Durasi Pengerjaan</th>
								<td class="pl-2"><?= $soal['waktu_pengerjaan']; ?> menit</td>
							</tr>
							<?php if ($sisa_waktu > 0) : ?>
								<tr>
									<th class="pl-2">Sisa Waktu</th>
									<td class="pl-2"><?= $sisa_waktu; ?> menit</td>
								</tr>
							<?php endif; ?>
						</table>

						<div class="d-flex justify-content-center mb-3">
							<a href="<?= site_url('dashboard/test') ?>" class="btn btn-default mr-2">Kembali</a>
							<form action="<?= site_url('test/kerjakan') ?>" method="POST">
								<input type="hidden" name="id_modul" id="id_modul" value="<?= $soal['id_modul'] ?>">
								<input type="hidden" name="waktu_tes" id="waktu_tes" value="<?= $soal['waktu_pengerjaan'] ?>">
								<?php if ($sisa_waktu > 0) : ?>
									<button type="submit" class="btn btn-warning">Lanjut Mengerjakan</button>
								<?php else : ?>
									<button type="submit" class="btn btn-success">Mulai Kerjakan</button>
								<?php endif; ?>
							</form>
						</div>

						<p class="text-danger">
							<i>*) Lorem ipsum dolor sit amet, consectetur adipisicing elit.</i>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
