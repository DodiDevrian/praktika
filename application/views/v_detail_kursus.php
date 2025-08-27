<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/styles/course.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/styles/course_responsive.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->

<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

<?php $id_list = $materi -> id_kursus; ?>

<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="<?= base_url() ?>">Home</a></li>
								<li><a href="<?= base_url('kursus') ?>">Kursus</a></li>
								<li><?= $materi -> nama_kursus ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

<?php 
	$count=0;
	foreach ($do_pretest as $key => $value) {
		if ($value->id_user == $this->session->userdata('id_user')) {
			if ($value->id_materi == $cek_id) {
				$nilai_pretest = $value->sum;
				$id_dopretest = $value->id_dopretest;
				$count++;
			}
		}
	}
?>

<?php 
	$counts=0;
	foreach ($do_posttest as $key => $value) {
		if ($value->id_user == $this->session->userdata('id_user')) {
			if ($value->id_kursus == $materi->id_kursus) {
				$counts++;
			}
		}
	}
?>

<?php 
    $sisapost = $materi->batas_posttest - $counts;
?>

<?php
$nilaiTerbaru = null;
$nilaiTertinggi = null;
foreach ($nilai as $key => $value) {
    if ($value->id_user == $this->session->userdata('id_user')) {
        if ($value->id_kursus == $materi->id_kursus) {
            $nilaiTerbaru = $value->sum;
			if ($value->sum > $nilaiTertinggi) {
				$nilaiTertinggi = $value->sum;
			}
        }
    }
}
?>

<?php
	$result = $this->db
		->where('id_kursus', $id_list)
		->get('tbl_materi')
		->result();

	$lastIndex = count($result) - 1;

	foreach ($result as $index => $row) {
		if ($index === $lastIndex) {
			$last_id_materi = $row->id_materi;
		}
	}
?>
	<div class="container">
		<div class="wrapper">
			<aside id="sidebar">
				<div class="d-flex">
					<button class="toggle-btn ml-auto" type="button">
						<i class="lni lni-menu"></i>
					</button>
				</div>
				<ul class="sidebar-nav">
					<?php $i=1; foreach ($lists_materi as $key => $value) { 
					if ($value->id_kursus == $id_list) {?>
					<li class="sidebar-item">
						<a href="<?= base_url('kursus/detail_materi/' . $value->id_materi) ?>" class="sidebar-link d-flex">
							<i class="lni lni-play"></i>
							<div>
								<?= wordwrap($value->nama_materi,35,"<br>\n");?>

							</div>
						</a>
					</li>
					<?php }} ?>
				</ul>
				<div class="sidebar-footer" style="display: none;">
					<a href="#" class="sidebar-link">
						<i class="lni lni-exit"></i>
						<span>Logout</span>
					</a>
				</div>
			</aside>

			<div class="main p-3">
				<?php if ($count<1) { ?>
					<?php if ($materi->status_pretest == 'Yes') { ?>
						<div class="notif-pretest">
							<div class="card text-center">
								<div class="card-body">
									<h5 class="card-title" style="color: red;">Anda Belum Mengerjakan Pre-Test Pertemuan Sebelumnya.</h5>
									<p class="card-text">Kerjakan Pre-Test Terlebih Dahulu Untuk Melanjutkan Materi Pertemuan Ini!!</p>
									<a href="<?= base_url('pretest/do/' . $materi->id_materi) ?>" class="btn btn-primary">Kerjakan</a>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div class="text-center">
							<div class="course_container">
								<?php if ($materi -> status == 2) { ?>
									<iframe class="course_image" src="https://www.youtube.com/embed/<?= $materi -> id_yt ?>" title="<?= $materi -> nama_materi ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
								<?php } else { ?>
									<div class="alert alert-danger" role="alert">
										Mohon maaf, materi sedang ditinjau oleh dosen pengampu!
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="d-flex justify-content-between" style="margin-top: 25px; align-items: center; flex-direction: column; text-align: center;">
							<h3 class="mb-2 mt-2"><?= $materi -> nama_materi ?></h3>
							<?php if ($materi -> status == 2) { ?>
								<div class="modul">
									<a class="btn btn-warning" type="button" data-toggle="modal" data-target="#viewMateri" style="color: black;"><i style="font-size: 25px; margin-right: 10px; color:black;" class="fa fa-file-pdf-o"></i> Lihat Modul</a>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } else { ?>
					<?php if ($nilai_pretest < 70) { ?>
						<?php if ($materi->status_pretest == 'Yes') { ?>
							<div class="notif-pretest">
								<div class="card text-center">
									<div class="card-body">
										<h5 class="card-title" style="color: red;">Nilai Anda Belum Mencukupi Untuk Melanjutkan Materi.</h5>
										<h3>Nilai Yang Anda Dapat : <?= $nilai_pretest ?></h3>
										<p class="card-text mt-3">Dapatkan Nilai Minimum <b style="color: #07ec56;">70</b> Untuk Dapat Melanjutkan Materi Pertemuan Selanjutnya!!</p>
										<a href="<?= base_url('pretest/re_pretest/' . $id_dopretest) ?>" class="btn btn-primary">Coba Lagi</a>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } else { ?>
						<div class="text-center">
							<div class="course_container">
								<?php if ($materi -> status == 2) { ?>
									<iframe class="course_image" src="https://www.youtube.com/embed/<?= $materi -> id_yt ?>" title="<?= $materi -> nama_materi ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
								<?php } else { ?>
									<div class="alert alert-danger" role="alert">
										Mohon maaf, materi sedang ditinjau oleh dosen pengampu!
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="d-flex justify-content-between" style="margin-top: 25px; align-items: center; flex-direction: column; text-align: center;">
							<h3 class="mb-2 mt-2"><?= $materi -> nama_materi ?></h3>
							
							<?php if ($materi -> status == 2) { ?>
								<div class="modul">
									<a class="btn btn-warning" type="button" data-toggle="modal" data-target="#viewMateri" style="color: black;"><i style="font-size: 25px; margin-right: 10px;" class="fa fa-file-pdf-o"></i> Lihat Modul</a>
								</div>
								
							<?php } ?>
						</div>
						
					<?php } ?>
				<?php } ?>
				<?php if ($materi->cek_last == 'Yes' ) { ?>
					<?php if ($counts == 0) { ?>
						<div class="posttest text-center mt-5">
							<p>Anda belum melakukan post test!</p>
							<a href="<?= base_url('posttest/do/' . $materi->id_kursus) ?>" class="btn btn-primary">Kerjakan Post-Test</a>
						</div>
					<?php }elseif ($counts == 1) { ?>
						<?php foreach ($do_posttest as $key => $value) { ?>
							<?php if ($value->id_kursus == $materi->id_kursus) { ?>
								<?php if ($value->id_user == $this->session->userdata('id_user')) { ?>
									<div class="posttest text-center">
										<?php if ($value->sum < 70) { ?>
											<p>Nilai Post Test : <b style="color: red;"><?= $value->sum ?></b></p>
											<a href="<?= base_url('posttest/do/' . $materi->id_kursus) ?>" class="btn btn-primary">Kerjakan Post-Test</a>
										<?php }else { ?>
											<p style="margin-bottom: 3px ;">Nilai Post Test : <b style="color: blue;"><?= $value->sum ?></b></p>
											<p style="color: blue;"><b>LULUS</b></p>
										<?php } ?>
									</div>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					<?php }else { ?>
						<div class="posttest text-center mt-5">
							<?php $no=1; foreach ($do_posttest as $key => $value) { ?>
								<?php if ($value->id_kursus == $materi->id_kursus) { ?>
									<?php if ($value->id_user == $this->session->userdata('id_user')) { ?>
										<?php if ($value->sum < 70) { ?>
											<p style="margin-bottom: 0px;">Nilai Post Test Percobaan <?= $no++ ?> : <b style="color: red;"><?= $value->sum ?></b></p>
										<?php } else { ?>
											<p style="margin-bottom: 0px;">Nilai Post Test Percobaan <?= $no++ ?> : <b style="color: blue;"><?= $value->sum ?></b></p>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							<?php } ?>
							<?php if ($sisapost != 0) { ?>
								<div class="button-posttest mt-4">
									<a href="<?= base_url('posttest/do/' . $materi->id_kursus) ?>" class="btn btn-primary">Kerjakan Post-Test</a>
									<p style="margin-bottom: 0px; margin-top: 20px;">Kesempatan : <b><?= $sisapost ?></b></p>
									<p>Nilai Tertinggi : <b><?= $nilaiTertinggi ?></b></p>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="viewMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modul <?= $materi->nama_materi?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="<?= base_url('upload/doc_materi/' . $materi->doc_materi)?>" width="100%" height="750"></iframe>
                </div>
            </div>
        </div>
    </div>

	<script src="<?= base_url() ?>assets/js/script.js"></script>