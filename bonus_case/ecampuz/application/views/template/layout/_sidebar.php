<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url() ?>" class="brand-link">
		<img src="<?= base_url() ?>assets/dist/img/<?= "AdminLTELogo.png" ?>?x=<?= time() ?>" alt="<?= "ECampuz" ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light"><?= "ECampuz" ?></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<a href="<?= isset($user_session->ud_img_url) ? $user_session->ud_img_url : base_url() . "assets/dist/img/avatar04.png"; ?><?= "?x=" . time() ?>" class="profile-img-clickable-sidebar">
					<img class="profile-user-img img-fluid img-circle" src="<?= isset($user_session->ud_img_url) ? $user_session->ud_img_url : base_url() . "assets/dist/img/avatar04.png"; ?><?= "?x=" . time() ?>" alt="<?= isset($user_session->user_username) ? $user_session->user_username : "Helmy Fikri Husein"; ?>">
				</a>
			</div>
			<div class="info">
				<a href="<?= base_url('profile') ?>" class="d-block"><?= isset($user_session->user_username) ? $user_session->user_username : "Helmy Fikri Husein"; ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

				<li class="nav-item">
					<a href="<?= base_url() ?>" class="nav-link active">
						<i class="nav-icon fas fa-home"></i>
						<p>
							Home
							<!-- <span class="right badge badge-danger">New</span> -->
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url("instansi") ?>" class="nav-link active">
						<i class="nav-icon fas fa-home"></i>
						<p>
							Daftar Instansi
							<!-- <span class="right badge badge-danger">New</span> -->
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
