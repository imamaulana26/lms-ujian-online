<?php $this->load->view('admin/layouts/v_header'); ?>
<style>
	.select2-selection__choice {
		background-color: #0069d9 !important;
	}

	.select2-selection__choice span {
		color: white !important;
	}
</style>

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
				<section id="section-kelola-soal">
					<form id="fm_soal" class="form-soal" action="<?= site_url('guru/kelola_soal/submit_soal') ?>" method="POST">
						<input name="modul" type="hidden" value="<?= $this->uri->segment(3) ?>">
						<!-- /.mengelola soal -->
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
										<textarea id="soal" name="soal_ujian" class="form-control editor"></textarea>

										<!-- <textarea class="form-control" name="soal_ujian" id="editorfr"></textarea> -->
										<!-- <textarea class="form-control" name="soal_ujian" id="editorfr" rows="3"></textarea> -->
										<!-- <textarea name="komentar" id="editorfr" rows="10" cols="45" placeholder="Type Here"></textarea> -->
									</div>
								</div>
								<!-- <div class="form-group">
												<label for="exampleFormControlTextarea1">Example textarea</label>
												<textarea  class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
											</div> -->

								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Lampiran</label>
									<div class="col-md-2">
										<select class="form-control" name="jns_lampiran" id="jns_lampiran">
											<option value="">No Attachment</option>
											<option value="gambar">Gambar</option>
											<option value="video">Video</option>
											<option value="audio">Audio</option>
										</select>
									</div>
									<div class="col-md-6 d-none">
										<input type="url" class="form-control" name="lampiran_soal" id="lampiran_soal" placeholder="masukan URL dari Google Drive">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Jenis Soal Ujian</label>
									<div class="col-md-3">
										<select class="form-control" name="jns_soal" id="jns_soal">
											<option value="" disabled selected>-- Pilih --</option>
											<?php $arr = array('Pilihan Ganda', 'True / False', 'Essay', 'Jawaban Singkat', 'Mencocokan Jawaban', 'Pilihan Ganda Kompleks');
											foreach ($arr as $key => $val) : ?>
												<option value="<?= $key ?>"><?= $val; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>

						<!-- /.mengelola jawaban tipe soal pilihan ganda -->
						<section class="pilihan-ganda">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col-md-2">
											<p class="col-form-label">Mengolah Jawaban <strong>Pilihan Ganda</strong></p>
										</div>
										<div class="col-md-2">
											<select class="form-control" name="list_jawaban_pg" id="list_jawaban_pg">
												<option value="" selected disabled>Pilih Type</option>
												<option value="teks">Teks</option>
												<option value="gambar">Gambar</option>
												<!-- <option value="video">Video</option>
												<option value="audio">Audio</option> -->
											</select>
										</div>
									</div>
								</div>
								<div class="card-body list-pilihan-ganda">
									<?php
									$n = range('a', 'd');
									for ($i = 0; $i < count($n); $i++) { ?>
										<div class="form-group row">
											<label class="col-md-2 col-form-label">Jawaban <?= strtoupper($n[$i]) ?></label>
											<div class="col-md-6 jawaban_teks">
												<textarea id="pg_jawaban<?= $n[$i] ?>" name="detail_jawaban_<?= $n[$i] ?>" class="form-control editor"></textarea>
												<!-- <input type="text" class="form-control detail_jawaban_pg" name="detail_jawaban_<?= $n[$i] ?>" id="detail_jawaban_<?= $n[$i] ?>"> -->
												<!-- <span class="btn btn-info" id="clickMe">test click</span> -->
											</div>
											<div class="col-md-6 jawaban_img">
												<input type="text" class="form-control" name="detail_jawaban_img_<?= $n[$i] ?>" placeholder="masukan URL dari Google Drive">
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
						</section>
						<!-- /.mengelola jawaban tipe soal pilihan ganda -->
						<section class="pilihan-ganda-kompleks">
							<div class="card">
								<div class="card-header">
									Mengelola Jawaban <b>Pilihan Ganda Kompleks</b>
								</div>
								<div class="card-body">
									<?php
									$n = range('a', 'd');
									for ($i = 0; $i < count($n); $i++) { ?>
										<div class="form-group row">
											<label class="col-md-2 col-form-label">Jawaban <?= strtoupper($n[$i]) ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="pilihan_kompleks_<?= $n[$i] ?>" id="pilihan_kompleks <?= $n[$i] ?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-2 col-form-label">Lampiran <?= strtoupper($n[$i]) ?></label>
											<div class="col-md-4">
												<input type="url" class="form-control" name="lampiran_soal_kompleks_<?= $n[$i] ?>" id="lampiran_soal_kompleks<?= $n[$i] ?>" placeholder="masukan URL dari Google Drive">
											</div>
											<div class="col-md-2">
												<select class="form-control" name="lampiran_tipe_kompleks_<?= $n[$i] ?>">
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
											<select class="js-example-basic-multiple" id="kunci_pilgan_kompleks" name="kunci_pg_kompleks[]" multiple="multiple" style="width: 100% ;">
												<?php for ($i = 0; $i < count($n); $i++) { ?>
													<option value="<?= $n[$i] ?>">Jawaban <?= strtoupper($n[$i]) ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</section>

						<!-- /.mengelola jawaban tipe soal True/False -->
						<section class="true-false">
							<div class="card">
								<div class="card-header">
									Mengelola Jawaban <b>True / False</b>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-md-1 col-form-label">Pernyataan Ke-1</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="truefalse[0][pernyataan]" id="pernyataan[]" placeholder="Pernyataan Ke-1">
										</div>
										<label class="col-md-1 col-form-label">Benar / Salah</label>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="truefalse[0][jwb]jawaban1" id="inlineRadio1" value="true">
											<label class="form-check-label" for="inlineRadio1">Benar</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="truefalse[0][jwb]jawaban1" id="inlineRadio2" value="false">
											<label class="form-check-label" for="inlineRadio2">Salah</label>
										</div>
										<div class="col-sm-1" id="add">
											<span class="btn btn-default btn_add_tf"><i class="fa fa-fw fa-plus"></i></span>
										</div>
									</div>

									<div class="clone_tf"></div>
								</div>
							</div>
						</section>

						<!-- /.mengelola jawaban tipe soal Jawaban Singkat -->
						<section class="jawaban-singkat">
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
						</section>

						<!-- /.mengelola jawaban tipe soal -->
						<section class="multi-choices">
							<div class="card">
								<div class="card-header">
									Mengelola Jawaban <b>Mencocokan Jawaban</b>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-md-1 col-form-label">Baris 1</label>
										<div class="col-md-3">
											<input type="text" class="form-control" name="row[]" id="row[]" placeholder="baris ke 1">
										</div>
										<label class="col-md-1 col-form-label">Kolom 1</label>
										<div class="col-md-3">
											<input type="text" class="form-control" name="cols[]" id="cols[]" placeholder="Jawaban baris ke 1">
										</div>
										<div class="col-sm-1" id="add">
											<span class="btn btn-default btn_add"><i class="fa fa-fw fa-plus"></i></span>
										</div>
									</div>
									<div class="clone"></div>
								</div>
							</div>
						</section>

						<section class="submit-soal">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-center">
										<button class="btn btn-lg btn-primary btn-submit">Submit Soal Ujian</button>
									</div>
								</div>
							</div>
						</section>
					</form>
				</section>

				<!-- List Bank Soal -->
				<section class="section-bank-soal">
					<div class="card">
						<div class="card-header">
							Daftar Bank Soal
						</div>
						<div class="card-body">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Detail Soal</th>
										<th>Jenis Soal</th>
										<th>Kunci Jawaban</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $jns_soal = array(1 => 'Pilihan Ganda', 'True / False', 'Essay', 'Jawaban Singkat', 'Mencocokan Jawaban', 'Pilihan Ganda Kompleks');
									foreach ($bank_soal as $key => $val) :
										$soal_id = $val['soal_id'];
									?>

										<tr>
											<td><?= $key + 1 ?></td>
											<td>
												<?= htmlspecialchars_decode($val['soal_detail']) ?><br>

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
											<td><?= $jns_soal[$val['soal_tipe']] ?></td>
											<td>
												<?php if ($val['soal_tipe'] == 1) :


												?>
													<?php foreach (json_decode($val['soal_pg']) as $pg) {
														if ($pg->kunci_jawaban == $val['soal_kunci']) { ?>
															<?php $jawaban = $pg->jawaban;
															if ($pg->tipe != 'teks') {
																$exp1 = explode("/", $pg->jawaban);
																$link1 = "https://drive.google.com/thumbnail?id=" . $exp1[5];
																$link2 = "https://drive.google.com/uc?export=view&id=" . $exp1[5];
															?>

																<label><?= strtoupper($pg->kunci_jawaban) . '. '; ?><a href="<?= $link2 ?>" data-toggle="lightbox">
																		<img src="<?= $link1 ?>" class="img-fluid">
																	</a></label>
															<?php } else { ?>
																<label><?= strtoupper($pg->kunci_jawaban) . '. ' . htmlspecialchars_decode($jawaban); ?></label>
													<?php }
														}
													} ?>
												<?php endif; ?>

												<?php if ($val['soal_tipe'] == 2) : ?>
													<!-- true false -->
													<?php foreach (unserialize($val['soal_kunci']) as $key1 => $val1) : ?>
														<label><?= $val1['pernyataan'] . ' : ' . $val1['jwb']; ?></label><br>
													<?php endforeach; ?>
													<!-- <label><?= strtoupper($val['soal_kunci']); ?></label> -->
												<?php endif; ?>

												<?php if ($val['soal_tipe'] == 4) : ?>
													<!-- jawaban singkat -->
													<label><?= strtoupper($val['soal_kunci']); ?></label>
												<?php endif; ?>


												<?php if ($val['soal_tipe'] == 5) : ?>
													<!-- mencocokan jawaban -->
													<?php foreach (unserialize($val['soal_kunci']) as $key2 => $val2) : ?>
														<label><?= $val2['row'] . ' : ' . $val2['column']; ?></label><br>
													<?php endforeach; ?>
												<?php endif; ?>
												<?php if ($val['soal_tipe'] == 6) : ?>
													<!-- kompleks -->
													<?php foreach (json_decode($val['soal_kunci']) as $key3 => $val3) : ?>
														<?php
														if (($ky3 = array_search($val3, array_column(json_decode($val['soal_pg']), 'pilihan'))) !== false) {
														?>
															<label><?= json_decode($val['soal_pg'])[$ky3]->pilihan . '. ' . json_decode($val['soal_pg'])[$ky3]->ket; ?></label><br>
														<?php } ?>

													<?php endforeach; ?>

												<?php endif; ?>

											</td>

											<td class="text-center">
												<a class="text-success mx-1">
													<i class="fa fa-md fa-edit"></i>
												</a>
												<span class="text-danger mx-1">
													<!-- <i class="fa fa-md fa-trash"></i> -->
													<a href="javascript:void(0)" style="color: #dc3545;" onclick="hapus_soal(<?= $soal_id ?>)"><i class="fa fa-md fa-trash"></i></a>
												</span>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<?php $this->load->view('admin/layouts/v_footer'); ?>
	</div>
	<!-- ./wrapper -->
</body>

<script>
	$(document).ready(function() {
		$(".pilihan-ganda, .true-false, .jawaban-singkat, .multi-choices, .submit-soal, .pilihan-ganda-kompleks").css('display', 'none');

		$('#jns_lampiran').on('change', function() {
			let val = $(this).val();

			if (val != "") {
				$('#lampiran_soal').parent().removeClass('d-none');
			} else {
				$('#lampiran_soal').parent().addClass('d-none');
			}
		});

		// trigger on btn-create
		$('.btn-action').on('click', function() {
			if ($('.btn-action').text() == "Create") {
				if ($('#kelas').val() != null && $('#id_mapel').val() != null && $("#id_ub").val() != null) {
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
				$(".pilihan-ganda, .true-false, .jawaban-singkat, .multi-choices, .submit-soal , .pilihan-ganda-kompleks").css('display', 'none');
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
			let arr = ['pilihan-ganda', 'true-false', 'essay', 'jawaban-singkat', 'multi-choices', 'pilihan-ganda-kompleks'];
			let val = $(this).val();

			$(".pilihan-ganda, .list-pilihan-ganda, .true-false, .jawaban-singkat, .multi-choices , .pilihan-ganda-kompleks").css('display', 'none');
			if (arr[val] == 'pilihan-ganda') {
				$('#list_jawaban_pg').on('change', function() {
					if ($(this).val() != "") {
						$('.list-pilihan-ganda').removeAttr('style');
					}

					if ($(this).val() == "teks") {
						$('.jawaban_teks').removeClass('d-none');
						$('.jawaban_img').addClass('d-none');
						// $('.detail_jawaban_pg').attr('placeholder', 'masukan URL dari Google Drive');
					} else {
						$('.jawaban_teks').addClass('d-none');
						$('.jawaban_img').removeClass('d-none');
						// $('.detail_jawaban_pg').removeAttr('placeholder');
					}
				});
			}
			$("section." + arr[val]).removeAttr('style');
			$('.submit-soal').css('display', 'block');
		});


		// load library select 2
		$('#kunci_pilgan_kompleks').select2();
	});
</script>

<!-- ckeditor -->
<script>
	$(".editor").each(function() {
		let id = $(this).attr('id');
		CKEDITOR.replace(id);
	});
</script>

<script>
	var i = 0;
	var j = 0;
	$('.btn_add').click(function() {
		var html = '';
		html += `<div class="form-group row">
						<label class="col-md-1 col-form-label">Baris ` + (i + 2) + `</label>
						<div class="col-md-3">
						<input type="text" class="form-control" name="row[]" id="row[]" placeholder="baris ke ` + (i + 2) + `">
						</div>
						<label class="col-md-1 col-form-label">Kolom ` + (i + 2) + `</label>
						<div class="col-md-3">
						<input type="text" class="form-control" name="cols[]" id="cols[]" placeholder="Jawaban baris ke ` + (i + 2) + `">
						</div>
						<div class="col-sm-1">
							<span class="btn btn-default btn_delete"><i class="fa fa-fw fa-minus"></i></span>
						</div>
					</div>`;

		if (i < 4) {
			$('.clone').append(html);
			i++;
		} else {
			Swal.fire({
				title: 'Oops!',
				icon: 'warning',
				text: 'Kamu Melewati Batas Kolom!'
			});
		}
	});

	$('#fm_soal').on('click', '.btn_delete', function() {
		$(this).parent().parent().remove();
		i--;
	});

	//button add true / false
	$('.btn_add_tf').click(function() {
		var html = '';
		html += `<div class="form-group row">
						<label class="col-md-1 col-form-label">Pernyataan Ke- ` + (j + 2) + `</label>
						<div class="col-md-6">
						<input type="text" class="form-control" name="truefalse[` + (j + 1) + `][pernyataan]" id="pernyataan[][]" placeholder="Pernyataan Ke- ` + (j + 2) + `">
						</div>

						<label class="col-md-1 col-form-label">Benar / Salah</label>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="truefalse[` + (j + 1) + `][jwb]jawaban` + (j + 2) + `" id="inlineRadio1" value="true">
							<label class="form-check-label" for="inlineRadio1">Benar</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="truefalse[` + (j + 1) + `][jwb]jawaban` + (j + 2) + `" id="inlineRadio2" value="false">
							<label class="form-check-label" for="inlineRadio2">Salah</label>
						</div>

						<div class="col-sm-1">
							<span class="btn btn-default btn_delete_tf"><i class="fa fa-fw fa-minus"></i></span>
						</div>
					</div>`;

		if (j < 4) {
			$('.clone_tf').append(html);
			j++;
		} else {
			Swal.fire({
				title: 'Oops!',
				icon: 'warning',
				text: 'Lampiran telah mencapai batas!'
			});
		}
	});
	$('#fm_soal').on('click', '.btn_delete_tf', function() {
		$(this).parent().parent().remove();
		j--;
	});
	//end button add true / false




	function hapus_soal(id) {
		Swal.fire({
			title: 'Hapus soal ini?',
			text: "Apakah Anda Yakin ingin menghapus soal ini?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			allowOutsideClick: false,
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?= site_url('guru/kelola_soal/hapus_soal/') ?>" + id,
					type: "POST",
					dataType: "JSON",
					success: function(res) {
						Swal.fire({
							icon: 'success',
							title: 'Sukses',
							text: 'Soal berhasil dihapus',
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
				});
			}
		})
	}
</script>

<!-- start flashdata -->
<?php if ($this->session->flashdata('msg') == 'success') : ?>
	<script type="text/javascript">
		Swal.fire({
			title: 'Success',
			text: 'Soal Berhasil Ditambahkan',
			icon: 'success',
		});
	</script>
<?php else : ?>

<?php endif; ?>
<!-- end of flashdata -->


</html>