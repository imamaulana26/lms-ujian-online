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
		<div class="box-body">
			<div class="row">
				<label for="">Ulangan Bulanan</label>
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
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>0.00</td>
								<td class="text-center">
									<a href="<?= site_url('dashboard/detail_soal/' . $val['id_modul']) ?>">
										<span class="badge badge-success" style="cursor: pointer;">Kerjakan</span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<!-- <?php
						var_dump(
							$this->session->userdata()
						); ?>
				<?php
				if ($this->session->userdata('online_class') == 1 || $this->session->userdata('komunitas_class') == 1) {
				?> -->
				<label for="">Kelas Online</label>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Program</th>
							<th>Mata Pelajaran</th>
							<th>Tgl. Test Mulai</th>
							<th>Tgl. Test Selesai</th>
							<th>Batas Waktu Pengerjaan</th>
							<th>Nilai</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
						</tr>
					</tbody>
				</table>
				<label for="">Kelas Ofline</label>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Program</th>
							<th>Mata Pelajaran</th>
							<th>Tgl. Test Mulai</th>
							<th>Tgl. Test Selesai</th>
							<th>Batas Waktu Pengerjaan</th>
							<th>Nilai</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
						</tr>
					</tbody>
				</table>
				<label for="">UTS</label>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Program</th>
							<th>Mata Pelajaran</th>
							<th>Tgl. Test Mulai</th>
							<th>Tgl. Test Selesai</th>
							<th>Batas Waktu Pengerjaan</th>
							<th>Nilai</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
						</tr>
					</tbody>
				</table>
				<label for="">UAS</label>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Program</th>
							<th>Mata Pelajaran</th>
							<th>Tgl. Test Mulai</th>
							<th>Tgl. Test Selesai</th>
							<th>Batas Waktu Pengerjaan</th>
							<th>Nilai</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
						</tr>
					</tbody>
				</table>
				<!-- <?php } ?> -->
			</div>
		</div>
	</div>
</body>

</html>