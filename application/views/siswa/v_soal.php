<?php $this->load->view('admin/layouts/v_header'); ?>

<style>
	.shrinkToFit {
		text-align: center !important;
	}

	.btn-nav {
		width: 35px !important;
		margin: 0.15rem;
	}

	.box label {
		display: flex;
		height: 53px;
		width: 100%;
		align-items: center;
		border: 1px solid lightgrey;
		border-radius: 5px;
		margin: 10px 0;
		padding-left: 11px;
		cursor: pointer;
		transition: all 0.3s ease
	}

	label:hover {
		background: #eee;
		cursor: pointer;
		border: 1px solid #aaa;
		padding: 4px;
	}

	.wrapper .box label {
		display: flex;
		height: 53px;
		width: 100%;
		align-items: center;
		border: 1px solid lightgrey;
		border-radius: 5px;
		margin: 10px 0;
		padding-left: 11px;
		cursor: pointer;
		transition: all 0.3s ease
	}

	.box input[type="radio"]:checked+label {
		background-color: #bbb;
	}

	.box input[type="checkbox"]:checked+label {
		background-color: #bbb;
	}

	#type4>tbody>tr>td>input {
		display: inherit;
	}

	.box label .text {
		color: #333;
		font-size: 18px;
		font-weight: 400;
		padding-left: 10px;
		transition: color 0.3s ease
	}


	.box input[type="radio"] {
		display: none
	}

	.box input[type="checkbox"] {
		display: none
	}

	/* hilangkan semua konten */
	.tabcontent {
		display: none;
	}

	.tabcontent .active {
		display: block;
		display: show;
	}

	.ndfHFb-c4YZDc-i5oIFb.ndfHFb-c4YZDc-e1YmVc .ndfHFb-c4YZDc-Wrql6b {
		background: red;
		height: 40px;
		top: 12px;
		left: auto;
		padding: 0
	}

	input[type="radio"] {
		appearance: none;
		border: 1px solid #d3d3d3;
		width: 30px;
		height: 30px;
		content: none;
		outline: none;
		margin: 0;
	}

	input[type="radio"]:checked {
		appearance: none;
		outline: none;
		padding: 0;
		content: none;
		border: none;
	}

	input[type="radio"]:checked::before {
		position: absolute;
		color: green !important;
		content: "\00A0\2713\00A0" !important;
		border: 1px solid #d3d3d3;
		font-weight: bolder;
		font-size: 21px;
	}
</style>

<body>
	<?php $this->load->view('siswa/layouts/navbar.php'); ?>

	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-md-10 offset-1">
				<div class="d-flex mb-2">
					<div class="col-md-6">
						Soal Nomor <span class="font-weight-bold" id="nomor"></span>
					</div>
					<div class="col-md-6">
						Sisa Waktu : <span class="font-weight-bold" id="waktu"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<form method="post" action="<?= site_url('siswa/test/check_form') ?>">
							<div class="card">
								<div class="card-header">
									Mata pelajaran : <?= $nm_soal['nm_mapel']; ?>
								</div>
								<div class="card-body">
									<!-- content  -->
									<?php $id = 1;
									foreach ($soal_acak as $key => $value) : ?>
										<div class="tabcontent" id="content<?= $id ?>">
											<div class="soal mb-3">
												<?php if (!empty($value['soal_lampiran'])) :
													$sourcelink = $value['soal_lampiran'];
													$unsersource = unserialize($sourcelink);
													$dtlink = $unsersource['link'];
													$exp = explode("/", $dtlink);
													if ($unsersource['tipe'] == 'gambar') :
														$link = "https://drive.google.com/thumbnail?id=" . $exp[5];
														echo '<img src="' . $link . '" alt="lampirangambar" width="500" height="600"> <br>';
													elseif ($unsersource['tipe'] == 'audio') :
														$link = "https://docs.google.com/uc?export=download&id=" . $exp[5];
														echo '<audio controls="controls"> <source src="' . $link . '"></audio> <br>';
													elseif ($unsersource['tipe'] == 'video') :
														$link = "https://drive.google.com/file/d/" . $exp[5] . "/preview";
														echo '<iframe width="50%" height="auto" src="' . $link . '"></iframe> <br>';
													endif;
												endif; ?>

												<?= htmlspecialchars_decode($value['soal_detail']) ?>
											</div>

											<div class="jawaban">
												<input type="hidden" value="<?= $id_logsoal ?>" name="id_log">
												<?php // Pilihan ganda
												if ($value['soal_tipe'] == 1) :
													// die;
													$pg = json_decode($value['soal_pg'], true);
													shuffle($pg);
													$n = range('a', 'd');
													foreach ($pg as $key1 => $jwbn) :
														$uid = $key1 + 1; ?>
														<?php
														$dtlink1 = $jwbn['jawaban'];
														$exp1 = explode("/", $dtlink1);

														if ($jwbn['tipe'] == 'teks') { ?>
															<div class="box">
																<input type="radio" id="radio<?= $value['soal_id'] . $uid ?>" name="answer[<?= $value['soal_id'] ?>][jwb]" value="<?= $n[$key1] ?>" required>
																<label style="height: auto;" for="radio<?= $value['soal_id'] . $uid ?>"><?= htmlspecialchars_decode($jwbn['jawaban']) ?></label>
															</div>
														<?php } elseif ($jwbn['tipe'] == 'gambar') {
															$link1 = "https://drive.google.com/thumbnail?id=" . $exp1[5];
															$link2 = "https://drive.google.com/uc?export=view&id=" . $exp1[5];
														?>
															<div class="box lightbox-gallery">
																<input type="radio" id="radio<?= $value['soal_id'] . $uid ?>" name="answer[<?= $value['soal_id'] ?>][jwb]" value="<?= $n[$key1] ?>" required>
																<label for="radio<?= $value['soal_id'] . $uid ?>" style="height: 100%;">
																	<a href="<?= $link2 ?>" data-toggle="lightbox">
																		<img src="<?= $link1 ?>" class="img-fluid">
																	</a>
																</label>
															</div>
														<?php }
														?>


													<?php endforeach; ?>
													<input type="hidden" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
												<?php // True or false
												elseif ($value['soal_tipe'] == 2) : ?>
													<input type="hidden" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
													<table class="table table-bordered table-sm table-hover">
														<thead>
															<tr>
																<th>Pernyataan</th>
																<th class="text-center" width="7%">Benar</th>
																<th class="text-center" width="7%">Salah</th>
															</tr>
														</thead>
														<tbody>
															<?php $dtjawab = unserialize($value['soal_kunci']);
															foreach ($dtjawab as $key1 => $value1) { ?>
																<tr>
																	<td><?= $value1['pernyataan'] ?></td>
																	<td class="text-center"><input type="radio" name="answer[<?= $value['soal_id'] ?>][jwb][<?= $key1 ?>]" value="true" required>
																	</td>
																	<td class="text-center"><input type="radio" name="answer[<?= $value['soal_id'] ?>][jwb][<?= $key1 ?>]" value="false" required>
																	</td>
																</tr>

															<?php } ?>
														</tbody>
													</table>

												<?php // Esay
												elseif ($value['soal_tipe'] == 3) : ?>
													<input type="hidden" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
													<div class="box">
														<textarea class="editor form-control" id="type3" rows="3" name="answer[<?= $value['soal_id'] ?>][jwb]" required></textarea>
													</div>

												<?php // Jawaban singkat
												elseif ($value['soal_tipe'] == 4) : ?>
													<input type="hidden" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
													<input type="text" name="answer[<?= $value['soal_id'] ?>][jwb]" required>
												<?php // Mencocokan Jawaban 
												elseif ($value['soal_tipe'] == 5) : ?>
													<input type="hidden" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">

													<?php $dtmulti = unserialize($value['soal_kunci']);
													foreach ($dtmulti as $dtpecah) :
														$colfix[] = $dtpecah['column'];
														$rowfix[] = $dtpecah['row'];
													endforeach;
													shuffle($colfix); ?>

													<div class="box">
														<table class="table table-striped" id="type4">
															<thead>
																<tr>
																	<th scope="col">#</th>
																	<?php
																	foreach ($colfix as $value2) : ?>
																		<th scope="col"><?= $value2 ?></th>
																	<?php endforeach; ?>
																</tr>
															</thead>
															<tbody>
																<?php foreach ($rowfix as $key2 => $value3) : ?>
																	<tr>
																		<th><?= $value3 ?></th>
																		<?php for ($i = 0; $i < count($rowfix); $i++) :
																		?>
																			<td><input type="radio" name="answer[<?= $value['soal_id'] ?>][jwb][<?= $value3 ?>]" value="<?= $colfix[$i] ?>" required>
																			</td>
																		<?php endfor; ?>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												<?php // Pilgan Kompleks
												elseif ($value['soal_tipe'] == 6) : ?>
													<input type="hidden" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
													<input type="radio" name="<?= $value['soal_id'] ?>" class="d-none" id="<?= $value['soal_id'] ?>" required>
													<?php $dtpgkompleks = json_decode($value['soal_pg'], true);
													foreach ($dtpgkompleks as $key4 => $value4) { ?>
														<div class="box">
															<input type="checkbox" name="answer[<?= $value['soal_id'] ?>][jwb][<?= $key4 ?>]" id="<?= $value4['pilihan'] . $value['soal_id'] ?>" onclick="document.getElementById('<?= $value['soal_id'] ?>').click();" value="<?= $value4['pilihan'] ?>">
															<label class="form-check-label" for="<?= $value4['pilihan'] . $value['soal_id'] ?>"><?= $value4['ket'] ?></label>
														</div>
													<?php } ?>
												<?php endif; ?>
											</div>
										</div>
									<?php $id++;
									endforeach; ?>
									<!-- end of content -->
								</div>
								<div class="card-footer">
									<div class="bd-highlight text-center">
										<span class="btn btn-sm btn-primary btn-prev" style="float: left;" onclick="prev()"><i class="fa fa-chevron-circle-left"></i> Soal Sebelumnya</span>
										<span class="btn btn-sm btn-primary btn-next" style="float: right;" onclick="next()">Soal Selanjutnya <i class="fa fa-chevron-circle-right"></i></span>
										<button type="submit" class="btn btn-success btn-submit">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-md-2">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title font-weight-bold">Daftar Soal</h5>
							</div>
							<div class="card-body">
								<nav class="multiTabs">
									<?php for ($i = 0; $i < count($soal_acak); $i++) : ?>
										<a class="btn btn-sm btn-default btn-nav" href="javascript:void(0)" data-trigger='content<?= $i + 1 ?>' id="nav-content<?= $i + 1 ?>"><?= $i + 1 ?></a>
									<?php endfor; ?>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>


<script>
	var currentTab = 1;
	$('#nomor').text(1);
	$("#content1").show();
	$('#nav-content1').removeClass('btn-default').addClass('btn-primary');

	$('.btn-submit').addClass('invisible');
	$('.btn-prev').addClass('invisible');

	$('input, textarea').on('change', function() {
		if ($(this).val() != "") {
			$('#nav-content' + currentTab).css({
				'color': '#fff',
				'background-color': '#28a745',
				'border-color': '#28a745',
				'box-shadow': 'none'
			});
		} else {
			$('#nav-content' + currentTab).css({
				'color': '#444',
				'background-color': '#f8f9fa',
				'border-color': '#ddd'
			});
		}
		show_btn_submit();
	});

	$(document).on('click', 'nav.multiTabs>a', function() {
		var TabId = $(this).attr('data-trigger');
		$('div#' + TabId + ' ').show();
		$('.btn-nav').removeClass('btn-primary').addClass('btn-default');
		$('#nav-' + TabId).removeClass('btn-default').addClass('btn-primary');

		currentTab = parseInt(TabId.replace("content", ""));
		$('#nomor').text(currentTab);
		$('.tabcontent:not(#' + TabId + ')').hide();

		toggle_btn_navigasi();
	});

	function show_btn_submit() {
		var validasi = $('input[type=text]:invalid, input[type=radio]:invalid, textarea:invalid').length;

		if (validasi > 0) {
			$('.btn-submit').addClass('invisible');
		} else {
			$('.btn-submit').removeClass('invisible');
		}
	}

	function next() {
		if (currentTab < <?= count($soal_acak) ?>) {
			$(".tabcontent").hide();
			currentTab++;
			$('#nomor').text(currentTab);

			$('.btn-nav').removeClass('btn-primary').addClass('btn-default');
			$('#nav-content' + currentTab).removeClass('btn-default').addClass('btn-primary');
			$("#content" + (currentTab)).show();
		}

		toggle_btn_navigasi();
	}

	function prev() {
		if (currentTab > 1) {
			$(".tabcontent").hide();
			currentTab--;
			$('#nomor').text(currentTab);

			$('.btn-nav').removeClass('btn-primary').addClass('btn-default');
			$('#nav-content' + currentTab).removeClass('btn-default').addClass('btn-primary');
			$("#content" + (currentTab)).show();
		}

		toggle_btn_navigasi();
	}

	function toggle_btn_navigasi() {
		if (currentTab == <?= count($soal_acak) ?>) {
			$('.btn-next').addClass('invisible');
			$('.btn-prev').removeClass('invisible');
		} else if (currentTab == 1) {
			$('.btn-prev').addClass('invisible');
			$('.btn-next').removeClass('invisible');
		} else {
			$('.btn-next').removeClass('invisible');
			$('.btn-prev').removeClass('invisible');
		}
	}
</script>


<script>
	// Set the date we're counting down to
	// var countDownDate = new Date("August 20 2021 17:25:37").getTime();
	var countDownDate = new Date("<?= $bts_waktu ?>").getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

		// ambil waktu hari ini
		var now = new Date().getTime();

		// hitung rentang waktu
		var distance = countDownDate - now;

		// hitung waktu
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// tampilkan waktu
		document.getElementById("waktu").innerHTML = ('0' + hours).slice(-2) + ":" +
			('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2);

		// waktu selesai
		if (distance < 0) {
			window.location.href = '<?= site_url('siswa/dashboard/detail_soal/' . $kd_modul) ?>';
			clearInterval(x);
		}
	}, 1000);
</script>

<!-- ckeditor -->
<script>
	$(".editor").each(function() {
		let id = $(this).attr('id');
		CKEDITOR.replace(id);
	});
</script>

</html>