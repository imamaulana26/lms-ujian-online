<?php $this->load->view('admin/layouts/v_header'); ?>

<body>
	<?php $this->load->view('siswa/layouts/navbar.php'); ?>
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
								<td class="pl-2"><?= $this->session->userdata('nama_mapel'); ?></td>
							</tr>
							<tr>
								<th class="pl-2">Nama Pengajar</th>
								<td class="pl-2"><?= $this->session->userdata('nama_pengajar'); ?></td>
							</tr>
							<tr>
								<th class="pl-2">Durasi Pengerjaan</th>
								<?php if ($status_ujian > 0) : ?>
									<td class="pl-2"><?= $soal['waktu_pengerjaan']; ?> menit</td>
								<?php else : ?>
									<td class="font-weight-bold pl-2">Waktu Ujian Telah Selesai</td>
								<?php endif; ?>
							</tr>
							<?php if ($status_ujian > 0 && $sisa_waktu > 0) : ?>
								<tr>
									<th class="pl-2">Sisa Waktu</th>
									<td class="pl-2"><?= $format_sisa_waktu; ?></td>
								</tr>
							<?php endif; ?>
						</table>

						<div class="d-flex justify-content-center mb-3">
							<a href="<?= site_url('siswa/dashboard') ?>" class="btn btn-default mr-2">Kembali</a>
							<form action="<?= site_url('siswa/test/kerjakan') ?>" method="POST">
								<input type="hidden" name="id_modul" id="id_modul" value="<?= $soal['id_modul'] ?>">
								<input type="hidden" name="waktu_tes" id="waktu_tes" value="<?= $soal['waktu_pengerjaan'] ?>">

								<?php if ($status_ujian > 0) : ?>
									<?php if ($sisa_waktu > 0) : ?>
										<button type="submit" class="btn btn-warning">Lanjut Mengerjakan</button>
									<?php else : ?>
										<button type="submit" class="btn btn-success">Mulai Kerjakan</button>
									<?php endif; ?>
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
