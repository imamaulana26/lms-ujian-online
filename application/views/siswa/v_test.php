<?php $this->load->view('admin/layouts/v_header'); ?>

<body>
	<?php $this->load->view('siswa/layouts/navbar.php'); ?>

	<div class="container my-3">
		<label>List Ujian Bulanan Siswa</label>
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
						<td class="text-center">Action</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<!-- <table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th>Module</th>
					<th>Mata Pelajaran</th>
					<th>Tgl. Test Mulai</th>
					<th>Tgl. Test Selesai</th>
					<th>Waktu Pengerjaan</th>
					<th>Nilai</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list_ujian as $key => $val) : ?>
					<tr>
						<td class="text-center"><?= ($key + 1) ?></td>
						<td>UB- <?= $val['modul_ub']; ?></td>
						<td><?= $val['nm_mapel']; ?></td>
						<td><?= $val['time_start'] != null ? $val['time_start'] : '-' ?></td>
						<td><?= $val['time_end'] != null ? $val['time_end'] : '-' ?></td>
						<td><?= $val['batas_waktu_tes'] != null ? $val['batas_waktu_tes'] : '-' ?></td>
						<td><?= $val['nilai'] != null ? $val['nilai'] : '0.00' ?></td>
						<td class="text-center">
							<?php if ($val['nilai'] != null) : ?>
								<span class="badge badge-danger">Selesai</span>
							<?php else : ?>
								<a href="<?= site_url('siswa/dashboard/detail_soal/' . $val['id_modul']) ?>">
									<span class="badge badge-success" style="cursor: pointer;">Kerjakan</span>
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table> -->

		<label>Program Quis Siswa</label>
		<!-- <table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th>Jenis Quis</th>
					<th>Mata Pelajaran</th>
					<th>Tgl. Test Mulai</th>
					<th>Tgl. Test Selesai</th>
					<th>Waktu Pengerjaan</th>
					<th>Nilai</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list_quis as $key => $val) { ?>
					<tr>
						<td class="text-center"><?= $key + 1; ?></td>
						<td><?= $val['jns_program']; ?></td>
						<td><?= $val['nm_mapel']; ?></td>
						<td>-</td>
						<td>-</td>
						<td><?= $val['waktu_pengerjaan']; ?> menit</td>
						<td>-</td>
						<td class="text-center">
							<a href="#">
								<span class="badge badge-success" style="cursor: pointer;">Kerjakan</span>
							</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table> -->
	</div>
</body>

</html>
