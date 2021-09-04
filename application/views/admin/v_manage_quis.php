<?php $this->load->view('admin/layouts/v_header'); ?>

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
							<div class="card">
								<div class="card-header">
									<button type="button" class="btn btn-primary btn-modal">
										Buat Quis
									</button>
								</div>
								<div class="card-body">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Program</th>
												<th>Kelas</th>
												<th>Nama Pelajaran</th>
												<th>Waktu Ujian</th>
												<th>Jumlah Peserta</th>
												<th>Bank Soal</th>
												<th class="text-center">Status</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php // var_dump($dt_program); die;
											foreach ($dt_program as $key => $val) {
												$n_peserta = $val['peserta_program'] == null ? 0 : count(unserialize($val['peserta_program'])); ?>
												<tr>
													<td><?= $key + 1 ?></td>
													<td><?= ucfirst($val['jns_program']) ?></td>
													<td><?= $val['kelas_nama'] ?></td>
													<td><?= $val['nm_mapel'] ?></td>
													<td><?= $val['waktu_pengerjaan'] . ' menit' ?></td>
													<td><?= $n_peserta ?> Siswa</td>
													<td>0 Soal</td>
													<td class="text-center">
														<?php if ($val['aktif'] == 0) { ?>
															<span class="badge badge-pill badge-success" onclick="change('<?= $val['id_program'] ?>')" style="cursor: pointer;">Active</span>
														<?php } else { ?>
															<span class="badge badge-pill badge-warning" onclick="change('<?= $val['id_program'] ?>')" style="cursor: pointer;">Inactive</span>
														<?php } ?>
													</td>
													<td class="text-center">
														<a class="text-warning mx-1" href="<?= site_url('manage-quis/peserta/' . $val['id_program']) . '/' . $val['jns_program'] ?>" data-toggle="tooltip" data-placement="top" title="Tambah Peserta" style="cursor: pointer;">
															<i class="fa fa-md fa-users"></i>
														</a>
														<span class="text-success mx-1" data-toggle="tooltip" data-placement="top" title="Ubah Module" style="cursor: pointer;" onclick="edit('<?= $val['id_program'] ?>')">
															<i class="fa fa-md fa-edit"></i>
														</span>
														<a class="text-primary mx-1" href="<?= site_url('guru/manage-quis/soal/' . $val['id_program'])  ?>" data-toggle="tooltip" data-placement="top" title="Kelola Soal" style="cursor: pointer;">
															<i class="fa fa-md fa-question-circle"></i>
														</a>
														<span class="text-danger mx-1" data-toggle="tooltip" data-placement="top" title="Hapus Module" style="cursor: pointer;">
															<i class="fa fa-md fa-trash"></i>
														</span>
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

		<!-- Modal -->
		<form id="form-module">
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal Kelola Quis</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="hidden" class="form-control" name="id_program" id="id_program">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Program</label>
								<div class="col-sm-4">
									<select class="form-control" name="program" id="program">
										<option value="" selected disabled>Pilih Program</option>
										<option value="offline">Offline</option>
										<option value="online">Online</option>
										<option value="uts">UTS</option>
										<option value="uas">UAS</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Nama Kelas</label>
								<div class="col-sm-4">
									<select class="form-control" name="kelas" id="kelas">
										<option value="" selected disabled>Pilih Kelas</option>
										<?php foreach ($dtkelas as $kls) { ?>
											<option value="<?= $kls['kelas_id'] ?>"><?= $kls['kelas_nama'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">Nama Pelajaran</label>
								<div class="col-sm-6">
									<select class="form-control" name="id_mapel" id="id_mapel"></select>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">Waktu Ujian</label>
								<div class="col-sm-3">
									<select class="form-control" name="waktu_ujian" id="waktu_ujian">
										<option value="30">30 menit</option>
										<option value="45">45 menit</option>
										<option value="60">60 menit</option>
										<option value="120">120 menit</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-3 offset-2">
									<span class="btn btn-primary" onclick="submit()">Submit Module</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!-- Main Footer -->
		<?php $this->load->view('admin/layouts/v_footer'); ?>
	</div>
	<!-- ./wrapper -->
</body>

<script>
	var method = "add";

	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip({
			container: '.content'
		});
		// trigger on kelas dropdown
		$('#kelas').on('change', function() {
			$.ajax({
				url: "<?= site_url('guru/module_quis/get_mapel') ?>",
				type: "POST",
				data: {
					id: $(this).val()
				},
				dataType: "JSON",
				success: function(respon) {
					$('#id_mapel').html(respon.data_mapel);
				}
			});
		});

		$('.btn-modal').on('click', function() {
			method = "add";
			$('#exampleModal').modal('show');
			$('#form-module')[0].reset();

			$('select').attr('disabled', false);
			$('#id_mapel').html('<option value="" selected disabled>Pilih Mata Pelajaran</option>');
		});
	});

	function change(id) {
		$.ajax({
			url: '<?= site_url('guru/manage_quis/change_sts/') ?>' + id,
			type: "POST",
			dataType: 'JSON',
			success: function(respon) {
				Swal.fire({
					icon: 'success',
					title: 'Success',
					text: respon.msg,
					timer: 1500,
					allowOutsideClick: false,
					timerProgressBar: false,
					showConfirmButton: false
				}).then((result) => {
					if (result.dismiss === Swal.DismissReason.timer) {
						location.reload();
					}
				});
			}
		});
	}

	function edit(id) {
		method = "update";
		$.ajax({
			url: "<?= site_url('guru/manage_quis/get_quis/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(respon) {
				$('#exampleModal').modal('show');
				$('#id_program').val(respon.id_program);
				$('#program').val(respon.jns_program);
				$('#kelas').val(respon.kelas_id).attr('disabled', true);
				$('#id_mapel').html('<option value="' + respon.id_pelajaran + '">' + respon.nm_mapel + '</option>').attr('disabled', true);
				$('#id_ub').val(respon.modul_ub).attr('disabled', true);
				$('#waktu_ujian').val(respon.waktu_pengerjaan);
			}
		});
	}

	function submit() {
		var url = "";
		if (method == "add") {
			url = "<?= site_url('guru/manage_quis/submit_quis') ?>";
		} else {
			url = "<?= site_url('guru/manage_quis/update_quis') ?>";
		}

		$.ajax({
			url: url,
			type: "POST",
			data: $('#form-module').serialize(),
			dataType: 'JSON',
			success: function(hasil) {
				if (hasil.status == true) {
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
					})
				} else {
					Swal.fire({
						icon: 'warning',
						title: 'Gagal',
						text: hasil.msg,
						timer: 2000,
						allowOutsideClick: false,
						timerProgressBar: true,
						showConfirmButton: false
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							location.reload();
						}
					})
				}
			}
		});
	}
</script>


</html>
