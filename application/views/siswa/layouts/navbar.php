<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand font-weight-bold" href="">Computer Basted-Test</a>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active dropdown">
					<button role="button" type="button" class="btn dropdown" data-toggle="dropdown">
						<?= $_SESSION['nm_user'] ?> <i class="fa fa-fw fa-user-circle"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right float-right">
						<a class="dropdown-item text-danger" href="<?= site_url('auth/logout') ?>">
							<i class="fa fa-fw fa-power-off"></i> Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
