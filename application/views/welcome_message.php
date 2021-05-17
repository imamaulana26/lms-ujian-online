<?php $this->load->view('admin/layouts/v_header'); ?>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- <div class="login-logo">
			<b>Admin</b>LTE
		</div> -->
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<form action="<?= site_url('dashboard/auth') ?>" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Sign In</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->
</body>

</html>
