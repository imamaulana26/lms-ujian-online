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

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">




	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?= base_url('assets/plugins/') . 'jquery/jquery.min.js' ?>"></script>
	<!-- Bootstrap -->
	<script src="<?= base_url('assets/plugins/') . 'bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
	<!-- AdminLTE -->
	<script src="<?= base_url('assets/dist/') . 'js/adminlte.js' ?>"></script>

	<!-- OPTIONAL SCRIPTS -->
	<script src="<?= base_url('assets/plugins/') . 'chart.js/Chart.min.js' ?>"></script>
	<script src="<?= base_url('assets/dist/') . 'js/demo.js' ?>"></script>
	<script src="<?= base_url('assets/dist/') . 'js/pages/dashboard3.js' ?>"></script>

	<!-- DataTables -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

	<!-- Sweetalert2 -->
	<script src="<?= base_url('assets/front-end/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
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

		function CheckNumeric() {
			return event.keyCode >= 48 && event.keyCode <= 57;
		}
	</script>
</head>