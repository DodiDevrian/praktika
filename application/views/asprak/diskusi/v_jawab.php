<?php $this->session->set_userdata('chat_diskusi', current_url()); ?>

<?php 
    $like = $this->m_diskusi->list_like();
    $report = $this->m_diskusi->list_report();
?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Data Forum Diskusi <?= $detail_ask->nama_kursus ?></h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Forum Diskusi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Isi Tabel Slider -->
            <div class="card-box mb-30">
                <div class="mb-30 pd-20 d-flex flex-wrap justify-content-between" style="align-items: center;">
                    <div class="ask-title d-flex flex-wrap" style="align-items: center;">
                        <h4 class="text-blue h4"><?=$detail_ask->tanya?></h4>
                        <?php if ($detail_ask->foto_tanya != '') { ?>
                            <button class="btn btn-secondary ml-4" type="button" data-toggle="modal" data-target="#foto_tanya">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                            </button>
                        <?php } ?>
                    </div>
                    <div class="but-jawab">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#jawab_asprak">Tambah Jawaban Anda</button>
                    </div>
                </div>

                <div class="pb-20">
                <?php
                if ($this->session->flashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible m-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo $this->session->flashdata('pesan');
                    echo '</div>';
                }
                ?>
                    <table class="data-table table hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>    
                                <th>Nama Pengirim</th>
                                <th>Jawaban</th>
                                <th>Gambar</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mulai Foreach -->
                            <?php $no=1; foreach ($jawab as $key => $value) {
                                if ($value->id_ask == $id) { ?>
                            <tr <?php if ($value->asprak_jawab == 'yes') { ?> style="background: #d7d7d7;" <?php } ?>>
                                <td><?= $no++?></td>
                                <td><?= $value->nama_user?></td>
                                <td><?= wordwrap($value->jawab,45,"<br>\n");?><br></td>
                                <td><img src="<?= base_url('upload/foto_jawab/' . $value->foto_jawab) ?>" alt="" width="200px"></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <?php if ($value->asprak_jawab == 'yes') { ?>
                                                <a class="dropdown-item" href="<?= base_url('asisten/diskusi/jawab/' . $value->id_ans) ?>"><i class="icon-copy dw dw-edit-1"></i> Edit</a>
                                            <?php } ?>
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#viewLike<?= $value->id_ans ?>"><i class="icon-copy dw dw-like1"></i> Hasil Like</a>
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#viewReport<?= $value->id_ans ?>"><i class="icon-copy dw dw-warning-1"></i> Hasil Report</a>
                                            <a class="dropdown-item" href="<?= base_url('asisten/diskusi/delete_jawab/' . $value->id_ans) ?>"><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php }} ?>
                            <!-- End Foreach -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

<!-- Modal Lihat Foto -->
<div class="modal fade" id="foto_tanya" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Foto Pertanyaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <img src="<?= base_url('upload/foto_tanya/' . $detail_ask->foto_tanya) ?>" alt="" width="100%">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal Masukin Jawaban Buat Asprak -->
<div class="modal fade" id="jawab_asprak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Jawaban Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                    echo form_open_multipart('asisten/diskusi/add_ans_user/'. $id);
                ?>
                <div class="form-group">
                    <label for="exampleFormControlFile1" style="color: #ff6300;">** Gambar Optional</label>
                    <input name="foto_jawab" type="file" class="form-control-file" id="exampleFormControlFile1">
                    
                    <input type="hidden" name="id_ask" value="<?=$id?>">
                    <input type="hidden" name="id_user" value="<?=$this->session->userdata('id_user')?>">
                </div>

                <div class="form-group">
                    <textarea style="height: 180px;" name="jawab" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukkan jawaban anda!"></textarea>
                </div>

                <button class="btn btn-success float-right">Kirim</button>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Vie Like -->
<?php foreach ($jawab as $key => $value) { ?>
    <div class="modal fade" id="viewLike<?= $value->id_ans?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-center">
            <div class="modal-header" style="text-align: center;">
                <h5 class="modal-title " id="exampleModalLabel"><?= $value->jawab ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Like</label>
                <hr>
                <?php foreach ($like as $key => $row) { ?>
                    <?php if ($row->id_ans == $value->id_ans) { ?>
                        <div class="user-like mb-2 text-center" style="display: flex; align-items: center;">
                            <img src="<?= base_url('upload/foto_user/' . $row->foto_user) ?>" alt="" style="width: 35px; border-radius: 500px;">
                            <span class="ml-2"><?= $row->nama_user ?></span>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal View Report -->
 <?php foreach ($jawab as $key => $value) { ?>
    <div class="modal fade" id="viewReport<?= $value->id_ans?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-center">
            <div class="modal-header" style="text-align: center;">
                <h5 class="modal-title " id="exampleModalLabel"><?= $value->jawab ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Report</label>
                <hr>
                <?php foreach ($report as $key => $row) { ?>
                    <?php if ($row->id_ans == $value->id_ans) { ?>
                        <div class="user-like mb-2 text-center" style="display: flex; align-items: center;">
                            <img src="<?= base_url('upload/foto_user/' . $row->foto_user) ?>" alt="" style="width: 35px; border-radius: 500px;">
                            <span class="ml-2"><?= $row->nama_user ?> - (<?= $row->report ?>)</span>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
<?php } ?>