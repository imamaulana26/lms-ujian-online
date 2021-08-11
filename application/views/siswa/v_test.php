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
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th>Module</th>
					<th>Mata Pelajaran</th>
					<th>Tgl. Test Mulai</th>
					<th>Tgl. Test Selesai</th>
					<th>Batas Waktu Pengerjaan</th>
					<th>Nilai</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<!-- <?= var_dump($list_ujian); ?> -->
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
								<a href="<?= site_url('dashboard/detail_soal/' . $val['id_modul']) ?>">
									<span class="badge badge-success" style="cursor: pointer;">Kerjakan</span>
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
