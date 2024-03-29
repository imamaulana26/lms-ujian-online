<?php $this->load->view('admin/layouts/v_header'); ?>

<body class="hold-transition sidebar-mini text-sm">
	<style>
		body.swal2-shown>[aria-hidden="true"] {
			filter: blur(5px);
		}
	</style>
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
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark"><?= $jawaban[0]['siswa_nama'] ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Soal</li>
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
							<div class="card">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Nilai Ujian</label>
										<div class="col-md-10 d-flex">
											<input type="text" readonly class="form-control-plaintext" id="nilai_before" value="<?= $jawaban[0]['nilai'] ?>">
											<div class="btn btn-success col-md-2" onclick="edit('<?= $jawaban[0]['id_log'] ?>')" id="update">Update Nilai</div>
										</div>

									</div>

									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Nama Pelajaran</label>
										<div class="col-md-10">
											<input type="text" readonly class="form-control-plaintext" value="<?= $jawaban[0]['nm_mapel'] ?>">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Ulangan Bulanan</label>
										<div class="col-md-10">
											<input type="text" readonly class="form-control-plaintext" value="<?= $jawaban[0]['modul_ub'] ?>">
										</div>
									</div>
								</div>
							</div>
							<!-- /.card -->
						</div>
					</div>

					<div class="row">
						<div class="col-lg">
							<div class="card">
								<div class="card-body">
									<table class="table" id="table_id">
										<thead>
											<tr>
												<th scope="col" width="20px">Soal Nomor</th>
												<th scope="col">Soal Detail</th>
												<th scope="col">Tipe Soal</th>
												<th scope="col">Kunci Jawaban</th>
												<th scope="col">Jawaban Siswa</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($dt_jawaban as $key => $val) {
											?>
												<tr>
													<td><?= $key + 1 ?></td>
													<td>
														<?= $val['soal_detail'] ?><br>

														<?php if (!empty($val['soal_lampiran'])) {
															$sourcelink = $val['soal_lampiran'];
															$unsersource = unserialize($sourcelink);
															$dtlink = $unsersource['link'];
															$exp = explode("/", $dtlink);
															if ($unsersource['tipe'] == 'gambar') {
																$link = "https://drive.google.com/thumbnail?id=" . $exp[5];
																echo '<img src="' . $link . '" alt="lampirangambar" width="100"> <br>';
															} elseif ($unsersource['tipe'] == 'audio') {
																$link = "https://docs.google.com/uc?export=download&id=" . $exp[5];
																echo '<audio controls="controls"> <source src="' . $link . '"></audio> <br>';
															} elseif ($unsersource['tipe'] == 'video') {
																$link = "https://drive.google.com/file/d/" . $exp[5] . "/preview";
																echo '<iframe width="50%" height="auto" src="' . $link . '"></iframe> <br>';
															}
														} ?>
													</td>
													<td>
														<?php if ($val['soal_tipe'] == 1) : ?>
															<label>Pilihan Ganda</label>
														<?php elseif ($val['soal_tipe'] == 2) : ?>
															<label>True / False</label>
														<?php elseif ($val['soal_tipe'] == 3) : ?>
															<label>Esay</label>
														<?php elseif ($val['soal_tipe'] == 4) : ?>
															<label>Jawaban Singkat</label>
														<?php elseif ($val['soal_tipe'] == 5) : ?>
															<label>Mencocokan Jawaban<br>
															<?php endif; ?>
															<!-- <?= $jns_soal[$val['soal_tipe']] ?> -->
													</td>
													<td>
														<?php if ($val['soal_tipe'] == 1) : ?>
															<?php foreach (unserialize($val['soal_pg']) as $pg) {
																if ($pg['kunci_jawaban'] == $val['soal_kunci']) { ?>
																	<label><?= strtoupper($pg['kunci_jawaban']) . '. ' . $pg['jawaban']; ?></label>
															<?php }
															} ?>
														<?php endif; ?>

														<?php if ($val['soal_tipe'] == 2 || $val['soal_tipe'] == 4) : ?>
															<label><?= strtoupper($val['soal_kunci']); ?></label>
														<?php endif; ?>

														<?php if ($val['soal_tipe'] == 5) : ?>
															<?php foreach (unserialize($val['soal_kunci']) as $key1 => $val1) : ?>
																<label><?= $val1['row'] . ' : ' . $val1['column']; ?></label><br>
															<?php endforeach; ?>
														<?php endif; ?>
													</td>
													<td>
														<?php if ($val['soal_tipe'] == 5) {
															foreach ($val['jwb_siswa'] as $jwb) {
																echo $jwb['row'] . ' : ' . $jwb['column'] . '<br>';
															}
														} else {
															echo $val['jwb_siswa'];
														} ?>
													</td>

												</tr>
											<?php } ?>
										</tbody>
									</table>
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

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->

		<!-- Main Footer -->
		<?php $this->load->view('admin/layouts/v_footer'); ?>
	</div>
	<!-- ./wrapper -->
</body>

<script>
	function edit(id) {
		// method = "update";
		$.ajax({
			url: "<?= site_url('manage_soal/get_dtnilai/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(respon) {
				$('#exampleModal').modal('show');
				$('#id_log').val(respon.id_log);
				$('#nm_mapel').val(respon.nm_mapel);
				$('#ub').val(respon.modul_ub);
				$('#nilai').val(respon.nilai);
			}
		});
	}

	function submit() {
		$.ajax({
			url: "<?= site_url('manage_soal/update_nilai') ?>",
			type: "POST",
			data: {
				idlog_update: $('#id_log').val(),
				nilai_update: $('#nilai').val()
			},
			dataType: 'JSON',
			success: function(hasil) {
				if (hasil.jenis == 'update') {
					Swal.fire({
						icon: 'success',
						title: 'Sukses',
						text: hasil.msg,
						timer: 2000,
						allowOutsideClick: false,
						timerProgressBar: true,
						showConfirmButton: false
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							location.reload();
						}
					});
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Oops!',
						text: 'Data nilai gagal diperbarui',
						timer: 2000,
						allowOutsideClick: false,
						timerProgressBar: true,
						showConfirmButton: false
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							location.reload();
						}
					});
				}
			}
		});
	}

	$('#update').on('click', function() {
		var nilai = $('#nilai_before').val();
		Swal.fire({
			title: 'Update Nilai',
			input: "number",
			inputPlaceholder: 'Masukan Nilai Terbaru',
			inputValue: nilai,
			inputAttributes: {
				max: 100,
				step: 1,
				pattern: "[0-9]{10}"
			},
			inputValidator: (value) => {
				if (value > 100) {
					return 'Nilai Tidak Boleh Lebih Dari 100'
				}
				if (value < 0) {
					return 'Nilai Tidak Boleh Minus'
				}
				if (value == 0) {
					return 'Nilai Tidak Boleh Kosong'
				}
			},
			confirmButtonText: `Update`,
			showLoaderOnConfirm: true,
			preConfirm: (update) => {
				$.ajax({
					url: "<?= site_url('guru/manage_soal/update_nilai/') ?>",
					type: "POST",
					data: {
						id_log: <?= $jawaban[0]['id_log'] ?>, // id_log
						nilai: update //nilai yang di update
					},
					dataType: "JSON",
					success: function(hasil) {
						Swal.fire({
							position: 'Center',
							icon: 'success',
							title: 'Murid Berhasil Di update',
							showConfirmButton: false,
							allowOutsideClick: false,
							timer: 1500
						}).then(function() {
							window.location.reload();
						})
					}
				});
			}
		})

	});
</script>

</html>