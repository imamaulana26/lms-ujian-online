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
				<form class="form-soal" action="<?= site_url('kelola_soal/submit_soal') ?>" method="POST">
					<div class="container-fluid">
						<!-- /.mengelola soal -->
						<section class="kelola-soal">
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											Mengelola Soal Ujian <label id="soal_mapel"></label>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Nama Kelas</label>
												<div class="col-md-10">
													<input type="text" readonly class="form-control-plaintext" value="<?= $module['kelas_nama'] ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Nama Pelajaran</label>
												<div class="col-md-10">
													<input type="text" readonly class="form-control-plaintext" value="<?= $module['nm_mapel'] ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Ulangan Bulanan</label>
												<div class="col-md-10">
													<input type="text" readonly class="form-control-plaintext" value="<?= 'UB ' . $module['modul_ub'] ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Waktu Ujian</label>
												<div class="col-md-10">
													<input type="text" readonly class="form-control-plaintext" value="<?= $module['waktu_pengerjaan'] . ' menit' ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Soal Ujian</label>
												<div class="col-md-10">
													<textarea name="soal_ujian" id="editorfr"></textarea>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Lampiran</label>
												<div class="col-md-6">
													<input type="url" class="form-control" name="lampiran_soal" id="lampiran_soal" placeholder="masukan URL dari Google Drive">
												</div>
												<div class="col-md-2">
													<select class="form-control" name="jns_lampiran" id="jns_lampiran">
														<option value="gambar">Gambar</option>
														<option value="video">Video</option>
														<option value="audio">Audio</option>
													</select>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Jenis Soal Ujian</label>
												<div class="col-md-3">
													<select class="form-control" name="jns_soal" id="jns_soal">
														<option value="" disabled selected>-- Pilih --</option>
														<?php $arr = array('Pilihan Ganda', 'True / False', 'Essay', 'Jawaban Singkat', 'Mencocokan Jawaban');
														foreach ($arr as $key => $val) : ?>
															<option value="<?= $key ?>"><?= $val; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<!-- /.mengelola jawaban tipe soal pilihan ganda -->
						<section class="pilihan-ganda">
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											Mengelola Jawaban <b>Pilihan Ganda</b>
										</div>
										<div class="card-body">
											<?php
											$n = range('a', 'd');
											for ($i = 0; $i < count($n); $i++) { ?>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Jawaban <?= strtoupper($n[$i]) ?></label>
													<div class="col-md-6">
														<input type="text" class="form-control" name="pilihan_<?= $n[$i] ?>" id="pilihan_<?= $n[$i] ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Lampiran <?= strtoupper($n[$i]) ?></label>
													<div class="col-md-4">
														<input type="url" class="form-control" name="lampiran_soal_<?= $i ?>" id="lampiran_soal_<?= $i ?>" placeholder="masukan URL dari Google Drive">
													</div>
													<div class="col-md-2">
														<select class="form-control" name="kelas">
															<option value="" selected disabled>Pilih Type</option>
															<option value="gambar">Gambar</option>
															<option value="video">Video</option>
															<option value="audio">Audio</option>
														</select>
													</div>
												</div>
											<?php } ?>
											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Kunci Jawaban</label>
												<div class="col-md-4">
													<select class="form-control" name="kunci_jawaban" id="kunci_jawaban">
														<option value="" selected disabled>-- Please Select --</option>
														<?php for ($i = 0; $i < count($n); $i++) { ?>
															<option value="<?= $n[$i] ?>">Jawaban <?= strtoupper($n[$i]) ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<!-- /.mengelola jawaban tipe soal True/False -->
						<section class="true-false">
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											Mengelola Jawaban <b>True / False</b>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label class="col-sm-2 col-form-control">Kunci Jawaban</label>
												<div class="col-sm-10">
													<div class="form-check my-1">
														<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
														<label class="form-check-label" for="gridRadios1" style="cursor: pointer;">
															True
														</label>
													</div>
													<div class="form-check my-1">
														<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
														<label class="form-check-label" for="gridRadios2" style="cursor: pointer;">
															False
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<!-- /.mengelola jawaban tipe soal Jawaban Singkat -->
						<section class="jawaban-singkat">
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											Mengelola Jawaban <b>Jawaban Singkat</b>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Kunci Jawaban</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="jawaban_singkat" id="jawaban_singkat" placeholder="Tuliskan jawaban singkat 1 kata">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<!-- /.mengelola jawaban tipe soal -->
						<section class="multi-choices">
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											Mengelola Jawaban <b>Mencocokan Jawaban</b>
										</div>
										<div class="card-body">
											<?php for ($i = 1; $i < 6; $i++) { ?>
												<div class="form-group row">
													<label class="col-md-1 col-form-label">Baris <?= $i ?></label>
													<div class="col-md-3">
														<input type="text" class="form-control" name="row_<?= $i ?>" id="row_<?= $i ?>" placeholder="baris ke <?= $i ?>">
													</div>
													<label class="col-md-1 col-form-label">Kolom <?= $i ?></label>
													<div class="col-md-3">
														<input type="text" class="form-control" name="cols_<?= $i ?>" id="cols_<?= $i ?>" placeholder="Jawaban baris ke <?= $i ?>">
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</section>

						<scrtion class="submit-soal">
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-body">
											<div class="d-flex justify-content-center">
												<button class="btn btn-lg btn-primary btn-submit">Submit Soal Ujian</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</scrtion>
					</div>
					<!-- /.container-fluid -->
				</form>
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						...
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Footer -->
		<?php $this->load->view('admin/layouts/v_footer'); ?>
	</div>
	<!-- ./wrapper -->
</body>

<script>
	$(document).ready(function() {
		$(".pilihan-ganda, .true-false, .jawaban-singkat, .multi-choices, .submit-soal").css('display', 'none');
		
		// trigger on btn-create
		$('.btn-action').on('click', function() {
			if ($('.btn-action').text() == "Create") {
				if ($('#kelas').val() != null && $('#id_mapel').val() != null && $("#id_ub").val() != null) {
					$(".kelola-soal").css('display', 'block');

					let mapel = $("#id_mapel option:selected").text();
					$('#soal_mapel').text(mapel);

					$('#kelas, #id_mapel, #id_ub').css({
						'pointer-events': 'none',
						'background-color': '#f2f4f6'
					});
					$(this).addClass('btn-warning').removeClass('btn-primary').text('Cancel');
				} else {
					Swal.fire({
						title: 'Oops!',
						text: "Keriteria Soal Ujian belum terpilih",
						icon: 'warning',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Oke',
						allowOutsideClick: false
					})
				}
			} else {
				//triger cancel
				$(".kelola-soal, .pilihan-ganda, .true-false, .jawaban-singkat, .multi-choices, .submit-soal").css('display', 'none');
				$('#kelas, #id_mapel, #id_ub').attr('disabled', false).css('cursor', 'auto');
				$(this).addClass('btn-primary').removeClass('btn-warning').text('Create');
				// let mapel = $("#id_mapel option:selected").text();

				$('input, textarea').val('');
				$('select').prop('selectedIndex', 0);
				$('#id_mapel').html('<option value="" selected disabled>Pilih Mata Pelajaran</option>');
			}
		});

		// trigger on jns_soal dropdown
		$('#jns_soal').on('change', function() {
			let arr = ['pilihan-ganda', 'true-false', 'essay', 'jawaban-singkat', 'multi-choices'];
			let val = $(this).val();

			$(".pilihan-ganda, .true-false, .jawaban-singkat, .multi-choices").css('display', 'none');
			$("section." + arr[val]).removeAttr('style');
			$('.submit-soal').css('display', 'block');
		});

		$(function() {
			$(".form-soal").submit(function() {
				$.ajax({
					url: $(this).attr("action"),
					data: $(this).serialize(),
					type: $(this).attr("method"),
					dataType: 'JSON',
					success: function(hasil) {
						console.log(hasil);
					}
				})
				return false;
			});
		});

		// load library ckeditor
		CKEDITOR.replace('editorfr');
	});
</script>


</html>
