<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/styles/courses.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/styles/courses_responsive.css">

<link rel="stylesheet" href="<?= base_url() ?>assets/css/diskusi_style.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/chat.css">
<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

<?php $this->session->set_userdata('chat_diskusi', current_url()); ?>

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li>Forum Diskusi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>			
</div>


<div class="container">
    <h3 class="text-center mt-4 mb-4">Forum Diskusi</h3>
    <div class="action-ask">
        <div class="right-ask">
            <div class="btn-group mb-2">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-expanded="false">
                    Pilih Praktikum
                </button>
                <div class="dropdown-menu dropdown-menu-lg-right">
                    <?php foreach ($kursus as $key => $value) { ?>
                        <a class="dropdown-item" href="<?= base_url('diskusi/detail_diskusi_me/' . $value->id_kursus) ?>"><?= wordwrap($value->nama_kursus,35,"<br>\n");?></a>
                    <?php } ?>
                </div>
                <?php if ($this->session->userdata('id_user')) { ?>
                    <a href="<?= base_url('diskusi') ?>" class="btn btn-success ml-3">All Question</a>
                <?php } ?>
            </div>
        </div>
        <div class="left-ask">
            <?php if ($this->session->userdata('id_user')) { ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Buat Pertanyaan</button>
            <?php } ?>
        </div>
    </div>

    <?php
        if ($this->session->flashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            echo $this->session->flashdata('pesan');
            echo '</div>';
        }
        if ($this->session->flashdata('pesan_delete')) {
            echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            echo $this->session->flashdata('pesan_delete');
            echo '</div>';
        }
    ?>
    
    <?php foreach ($diskusi as $key => $value) { ?>
    <?php 
        $tanggal_kirim = $value->created; 
        $tanggal_jawab = $value->modified;
    ?>
    <?php if ($value->id_user == $this->session->userdata('id_user')) { ?>
        <div class="card mb-3 d-flex flex-row" style="width: 100%; margin: auto;">
            <?php if ($value->foto_tanya != '') { ?>
            <div class="cover-image" style="flex: 0 0 200px;">
                <a data-toggle="modal" data-target="#viewImage<?=$value->id_ask?>">
                    <img class="img-ask" src="<?= base_url('upload/foto_tanya/'). $value->foto_tanya ?>" width="100%" style="object-fit: cover; height: 134px;">
                </a>
            </div>
            <?php } ?>
            <div class="" style="display: flex; flex-direction: column; flex: 1;">
                <div class="card-body card-ask">
                    <div class="tanya-area">
                        <a href="" class="" role="button" data-toggle="dropdown" aria-expanded="false">
                        </a>
                        <a href="<?= base_url('diskusi/jawab/' . $value->id_ask) ?>">
                            <h5 class="ml-2" style="color: #0062d4;"><?= $value->tanya ?></h5>
                        </a>
                    </div>
                </div>
                <div class="footer-ask" style="padding: 1.25rem 1.25rem 1.25rem 1.25rem; ">
                    <li class="ml-2 dropdown" style="width: 22px; border: solid 1px; border-radius: 25px; text-align: center;">
                        <a href="" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="<?= base_url('diskusi/delete/' . $value->id_ask ) ?>">Delete</a>
                        </div>
                    </li>
                    <li class="ml-2"><i class="fa fa-user" aria-hidden="true"></i> <?= $value->nama_user?></li>
                    <li class="ml-2" style="color: #2389ff;"><i class="fa fa-book" aria-hidden="true"></i><a href="<?= base_url('diskusi/detail_diskusi_me/' . $value->id_kursus)?>"> <?= $value->nama_kursus?></a></li>
                    <li class="ml-2"><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('d-m-Y', strtotime($value->created_ask)) ?></li>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Pertanyaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('diskusi/add_chat_user'); ?>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih Mata Kuliah</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="kursus" style="color: black;">
                        <option selected disabled value >--Pilih Mata Kuliah--</option>
                        <?php foreach ($kursus as $key => $value) { ?>
                            <option value="<?=$value->id_kursus . '|' . $value->id_asprak?>"><?=$value->nama_kursus?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <input type="hidden" name="id_user" value="<?=$this->session->userdata('id_user')?>">

                <div class="form-group">
                    <label for="exampleFormControlFile1" style="color: #ff6300;">** Gambar Optional</label>
                    <input name="foto_tanya" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1" >Pertanyaan</label>
                    <textarea style="height: 150px; color: black;" name="tanya" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukkan pertanyaan anda!"></textarea>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php foreach ($diskusi as $key => $value) { ?>
<div class="modal fade" id="viewImage<?=$value->id_ask?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Kendala <?= $value->id_ask?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-ask" src="<?= base_url('upload/foto_tanya/'). $value->foto_tanya ?>" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
