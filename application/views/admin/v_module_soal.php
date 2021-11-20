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
										Buat Module
									</button>
								</div>
								<div class="card-body">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Kelas</th>
												<th>Nama Pelajaran</th>
												<th>UB</th>
												<th>Waktu Ujian</th>
												<th>Bank Soal</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($list_module as $key => $li) : ?>
												<tr>
													<td><?= ($key + 1) ?></td>
													<td><?= $li['kelas'] ?></td>
													<td><?= $li['mapel']; ?></td>
													<td><?= 'UB ' . $li['modul_ub']; ?></td>
													<td><?= $li['waktu'] . ' menit'; ?></td>
													<td><?= $li['bank_soal'] . ' soal'; ?></td>
													<td class="text-center">
														<span class="text-success mx-1" onclick="edit('<?= $li['id_modul'] ?>')" data-toggle="tooltip" data-placement="top" title="Ubah Module" style="cursor: pointer;">
															<i class="fa fa-md fa-edit"></i>
														</span>
														<a class="text-primary mx-1" href="<?= site_url('module-soal/soal/' . $li['id_modul']) ?>" data-toggle="tooltip" data-placement="top" title="Kelola Soal" style="cursor: pointer;">
															<i class="fa fa-md fa-question-circle"></i>
														</a>
														<span class="text-danger mx-1" onclick="hapus('<?= $li['id_modul'] ?>')" data-toggle="tooltip" data-placement="top" title="Hapus Module" style="cursor: pointer;">
															<i class="fa fa-md fa-trash"></i>
														</span>
													</td>
												</tr>
											<?php endforeach; ?>
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
		<form id="form-module" method="POST">
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal Kelola Module</h5>
							<input type="hidden" id="id_modul" name="idmodul_update">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Nama Kelas</label>
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
								<label for="inputPassword3" class="col-sm-2 col-form-label">Ulangan Bulanan</label>
								<div class="col-sm-3">
									<select class="form-control" name="id_ub" id="id_ub">
										<option value="" selected disabled>Pilih UB</option>
										<?php for ($i = 1; $i <= 12; $i++) : ?>
											<option value="<?= $i ?>">UB <?= $i ?></option>
										<?php endfor; ?>
									</select>
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
	var method = "";
	var url = "";

	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip({
			container: '.content'
		});
		// trigger on kelas dropdown
		$('#kelas').on('change', function() {
			$.ajax({
				url: "<?= site_url('guru/module_soal/get_mapel') ?>",
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

	function edit(id) {
		method = "update";
		$.ajax({
			url: "<?= site_url('kelola_module/get_module/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(respon) {
				$('#exampleModal').modal('show');
				$('#kelas').val(respon.kelas_id).attr('disabled', true);
				$('#id_mapel').html('<option value="' + respon.id_pelajaran + '">' + respon.nm_mapel + '</option>').attr('disabled', true);
				$('#id_ub').val(respon.modul_ub).attr('disabled', true);
				$('#waktu_ujian').val(respon.waktu_pengerjaan);
				$('#id_modul').val(respon.id_modul);
			}
		});
	}

	function submit() {
		if (method == "add") {
			url = "<?= site_url('kelola_module/submit_module') ?>";
		} else {
			url = "<?= site_url('kelola_module/edit_module') ?>";
		}

		$.ajax({
			url: url,
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
					})
				} else {
					if (hasil.status == false) {
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

				// console.log(hasil);
			}
		});
	}
</script>


</html>
