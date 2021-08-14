<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?= $title; ?></title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url('assets/plugins/') . 'fontawesome-free/css/all.min.css' ?>">
	<!-- IonIcons -->
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/dist/') . 'css/adminlte.min.css' ?>">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- toogle -->
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<!-- datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
	<!-- SELECT 2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?= base_url('assets/plugins/') . 'jquery/jquery.min.js' ?>"></script>
	<!-- Popper -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
	<!-- Bootstrap -->
	<script src="<?= base_url('assets/plugins/') . 'bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
	<!-- toogle -->
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	<!-- AdminLTE -->
	<script src="<?= base_url('assets/dist/') . 'js/adminlte.js' ?>"></script>

	<!-- OPTIONAL SCRIPTS -->
	<!-- <script src="<?= base_url('assets/plugins/') . 'chart.js/Chart.min.js' ?>"></script> -->
	<!-- <script src="<?= base_url('assets/dist/') . 'js/demo.js' ?>"></script> -->
	<!-- <script src="<?= base_url('assets/dist/') . 'js/pages/dashboard3.js' ?>"></script> -->

	<!-- DataTables -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

	<!-- Sweetalert2 -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- select 2 -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<!-- CK editor JS -->
	<script src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
	<!-- Ekko Lightbox -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" crossorigin="anonymous"></script>

	<!-- Pages Script -->
	<script>
		$(document).ready(function() {
			const url = '<?= $this->uri->segment(1); ?>';

			$('.nav-link').removeClass('active');
			if (url == 'dashboard') {
				$('#' + url).addClass('active');
			} else {
				$('#' + url).addClass('active');
				$('#' + url).closest('ul').prev().addClass('active');
				$('#' + url).closest('ul').prev().parent('.has-treeview').addClass('menu-open');
			}
		});

		// $(function() {
		// 	$('[data-toggle="tooltip"]').tooltip()
		// })

		function CheckNumeric() {
			return event.keyCode >= 48 && event.keyCode <= 57;
		}
	</script>
</head>
