<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container">
								<a href="<?= base_url() ?>">
									<div><img class="logo_pict" src="<?= base_url() ?>assets/img/logoif.png" alt=""></div>
									<!-- <div class="logo_text">Kursus<span> Online</span></div> -->
								</a>
							</div>
							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									<li class="<?php echo menuAktif('home') ?>"><a href="<?= base_url() ?>">Home</a></li>
									<li class="<?php echo menuAktif('kursus') ?>"><a href="<?= base_url('kursus') ?>">Praktikum</a></li>
									<li class="<?php echo menuAktif('asprak') ?>"><a href="<?= base_url('asprak') ?>">Asprak</a></li>
									<li class="<?php echo menuAktif('diskusi') ?>"><a href="<?= base_url('diskusi') ?>">Forum Diskusi</a></li>
									<li class="<?php echo menuAktif('about') ?>"><a href="<?= base_url('about') ?>">About</a></li>
								</ul>

								<!-- Hamburger -->

								<!-- <div class="shopping_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div> -->
								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Search Panel -->
		<div class="header_search_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_search_content d-flex flex-row align-items-center justify-content-end">
							<form action="#" class="header_search_form">
								<input type="search" class="search_input" placeholder="Search" required="required">
								<button class="header_search_button d-flex flex-column align-items-center justify-content-center">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>			
		</div>			
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<nav class="menu_nav" style="width: 80%;">
			<ul class="menu_mm">
				<li class="<?php echo menuAktif('home') ?> menu_mm" style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="<?= base_url('home') ?>">Home</a></li>
				<li class="<?php echo menuAktif('kursus') ?> menu_mm" style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="<?= base_url('kursus') ?>">Praktikum</a></li>
				<li class="<?php echo menuAktif('asprak') ?> menu_mm"style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="<?= base_url('asprak') ?>">Asprak</a></li>
				<li class="<?php echo menuAktif('diskusi') ?> menu_mm"style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="<?= base_url('diskusi') ?>">Forum Diskusi</a></li>
				<li class="<?php echo menuAktif('about') ?> menu_mm mb-5"style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="<?= base_url('about') ?>">About</a></li>
				<?php if($this->session->userdata('id_user')) { ?>
					<li class="<?php echo menuAktif('about') ?> menu_mm" style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="<?= base_url('profile/mahasiswa/' . $this->session->userdata('slug_user')) ?>">Profil</a></li>
					<li class="menu_mm" style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="" type="button" data-toggle="modal" data-target="#logout">Logout</a></li>
				<?php }else { ?>
					<li class="menu_mm" style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="<?= base_url('auth/login') ?>">Login</a></li>
					<li class="menu_mm" style="border-bottom: solid 1px; margin-bottom: 15px;"><a href="<?= base_url('auth/register') ?>">Register</a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>