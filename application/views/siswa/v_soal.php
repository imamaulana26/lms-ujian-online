<?php $this->load->view('admin/layouts/v_header'); ?>

<style>
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

	/* #value-1:checked~.value-1,
    #value-2:checked~.value-2,
    #value-3:checked~.value-3,
    #value-4:checked~.value-4 {
        background: #9C27B0;
        border-color: #9C27B0
    } */
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
</style>

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

	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-md-10 offset-1">
				<div class="d-flex">
					<div class="col-md-6">
						<h5>Mata Pelajaran : <?= $nm_soal['nm_mapel']; ?></h5>
					</div>
					<div class="col-md-6">Waktu : <label id="waktu"></label>
					</div>

				</div>
				<div class="row">
					<div class="col-md-10">
						<form method="post" action="<?= site_url('siswa/test/check_form') ?>">
							<div class="card">
								<div class="card-header">
									<h5 class="font-weight-bold">
										Soal Nomor <span id="nomor"></span>
									</h5>
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

												<?= $value['soal_detail'] ?>
											</div>

											<div class="jawaban">
												<input type="hidden" value="<?= $id_logsoal ?>" name="id_log">
												<?php // Pilihan ganda
												if ($value['soal_tipe'] == 1) :
													$pg = unserialize($value['soal_pg']);
													shuffle($pg);
													$n = range('a', 'd');
													foreach ($pg as $key1 => $jwbn) :
														$uid = $key1 + 1; ?>
														<div class="box">
															<input type="radio" id="radio<?= $value['soal_id'] . $uid ?>" name="answer[<?= $value['soal_id'] ?>][jwb]" value="<?= $n[$key1] ?>" required>
															<label for="radio<?= $value['soal_id'] . $uid ?>"><?= $jwbn['jawaban'] ?></label>
														</div>
													<?php endforeach; ?>
													<input type="text" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
												<?php // True or false
												elseif ($value['soal_tipe'] == 2) : ?>
													<input type="text" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
													<div class="box">
														<input type="radio" id="radiotrue" name="answer[<?= $value['soal_id'] ?>][jwb]" value="true" required>
														<label for="radiotrue">True</label>
													</div>
													<div class="box">
														<input type="radio" id="radiofalse" name="answer[<?= $value['soal_id'] ?>][jwb]" value="false" required>
														<label for="radiofalse">False</label>
													</div>
												<?php // Esay
												elseif ($value['soal_tipe'] == 3) : ?>
													<input type="text" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
													<div class="box">
														<textarea class="form-control" id="type3" rows="3" name="answer[<?= $value['soal_id'] ?>][jwb]" required></textarea>
													</div>
												<?php // Jawaban singkat
												elseif ($value['soal_tipe'] == 4) : ?>
													<input type="text" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
													<input type="hidden" value="<?= $value['soal_tipe']  ?>" name="answer[<?= $value['soal_id'] ?>][tipe]">
													<input type="text" name="answer[<?= $value['soal_id'] ?>][jwb]" required>
												<?php // Mencocokan Jawaban 
												elseif ($value['soal_tipe'] == 5) : ?>
													<input type="text" value="<?= $value['soal_id']  ?>" name="answer[<?= $value['soal_id'] ?>][id]">
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
												<?php endif; ?>
											</div>
										</div>
									<?php $id++;
									endforeach; ?>
									<!-- end of content -->
								</div>
								<div class="card-footer">
									<div class="bd-highlight text-center">
										<span class="btn btn-primary btn-prev" style="float: left;" onclick="prev()">Sebelumnya</span>
										<span class="btn btn-primary btn-next" style="float: right;" onclick="next()">Selanjutnya</span>
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
										<a class="btn btn-default m-1" href="javascript:void(0)" data-trigger='content<?= $i + 1 ?>' id="nav-content<?= $i + 1 ?>"><?= $i + 1 ?></a>
									<?php endfor; ?>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- <h2>Data sementara</h2>
                <?php
				var_dump($_SESSION['username']);
				$datasementara = array(
					"2" => "a",
					"4" => "true",
					"5" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis obcaecati nam quia incidunt nemo ullam eligendi debitis beatae suscipit sequi minus aut repudiandae magni non, at, praesentium quod nostrum quibusdam?"
				);
				?> -->
				</div>
				<?php
				// echo '<pre>';
				// var_dump($datasementara);
				// echo '</pre>';
				?>
			</div>
		</div>
		<?php
		// $datajawabanserialize = array(
		//     "2" => "a",
		//     "4" => "true",
		//     "5" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis obcaecati nam quia incidunt nemo ullam eligendi debitis beatae suscipit sequi minus aut repudiandae magni non, at, praesentium quod nostrum quibusdam?"
		// );

		//nama file
		// $namaFile = 'dumyjawaban.txt';
		// //lokasi penyimpanan
		// $pathFile = "assets/filesiswa/" . $_SESSION['username'] . "/";
		// //membuat file
		// $file = fopen($pathFile . $namaFile, 'w');
		// // isi konten file
		// $konten = serialize($datajawabanserialize);
		// //menulis file
		// fwrite($file, $konten);
		// fclose($file);

		// //membaca file
		// $data = file_get_contents($pathFile . $namaFile);

		// mengembalikan data serialize
		// var_dump(unserialize($data));

		?>
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
		$('a.btn.m-1').removeClass('btn-primary').addClass('btn-default');
		$('#nav-' + TabId).removeClass('btn-default').addClass('btn-primary');

		currentTab = parseInt(TabId.replace("content", ""));
		$('#nomor').text(currentTab);
		$('.tabcontent:not(#' + TabId + ')').hide();

		toggle_btn_navigasi();
	});

	function show_btn_submit() {
		if ($('input:invalid, textarea:invalid').length > 0) {
			$('.btn-submit').addClass('invisible');
		} else {
			$('.btn-submit').removeClass('invisible');
		}
	}

	function next() {
		if (currentTab < <?= count($soal_acak) ?>) {
			// console.log("Current Tab: " + currentTab);
			$(".tabcontent").hide();
			currentTab++;
			$('#nomor').text(currentTab);

			$('a.btn.m-1').removeClass('btn-primary').addClass('btn-default');
			$('#nav-content' + currentTab).removeClass('btn-default').addClass('btn-primary');
			$("#content" + (currentTab)).show();
		}

		toggle_btn_navigasi();
	}

	function prev() {
		if (currentTab > 1) {
			// $('a.btn.m-1').removeClass('btn-primary').addClass('btn-default');
			// $('#nav-content' + currentTab--).removeClass('btn-default').addClass('btn-primary');

			$(".tabcontent").hide();
			currentTab--;
			$('#nomor').text(currentTab);

			$('a.btn.m-1').removeClass('btn-primary').addClass('btn-default');
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
	// console.log(new Date($.now()));

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
		document.getElementById("waktu").innerHTML = hours + "h " +
			minutes + "m " + seconds + "s ";

		// waktu selesai
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("waktu").innerHTML = "WAKTU ANDA SELESAI";
		}
	}, 1000);
</script>

</html>