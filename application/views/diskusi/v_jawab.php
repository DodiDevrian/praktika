<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/styles/courses.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/styles/courses_responsive.css">

<link rel="stylesheet" href="<?= base_url() ?>assets/css/diskusi_style.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/chat.css">
<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

<?php $this->session->set_userdata('chat_diskusi', current_url()); ?>
<?php
    $count_jawab=0;
    foreach ($jawab as $key => $value) {
        if ($value->id_ask == $id) {
            $count_jawab++;
        }
    }
?>
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
    <div class="pertanyaan my-3" style="display: flex; flex-direction: row;">
        <?php if ($detail_ask->foto_tanya != '') { ?>
            <div class="img-tanya-judul mr-3" style="width: 30%;">
                <img width="100%" src="<?= base_url('upload/foto_tanya/' . $detail_ask->foto_tanya) ?>" alt="">
            </div>
        <?php } ?>

        <div class="tanya-judul">
            <h3 class="mt-4 mb-4"><?= $detail_ask->tanya ?></h3>
            <?php if ($detail_ask->foto_tanya != '') { ?>
                <div class="img-res">
                    <img src="<?= base_url('upload/foto_tanya/' . $detail_ask->foto_tanya) ?>" alt="">
                </div>
            <?php } ?>
            <div class="footer-judul-tanya">
                <li><i class="fa fa-user" aria-hidden="true"></i> <?= $detail_ask->nama_user ?></li>
                <li class="ml-2" style="color: #2389ff;"><i class="fa fa-book" aria-hidden="true"></i><a href="#"> <?= $detail_ask->nama_kursus ?></a></li>
                <li class="ml-2"><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('d-m-Y', strtotime($detail_ask->created_ask)) ?></li>
            </div>
        </div>
    </div>
    <?php if ($this->session->userdata('id_user')) { ?>
        <?php if ($count_jawab > 5) { ?>
            <div class="tombol-jawab d-flex flex-row-reverse">
                <a href="" class="btn btn-primary">Beri Jawaban</a>
            </div>
        <?php } ?>
    <?php } ?>

    <hr>

    <div class="judul-jawab">
        <h4>Jawaban</h4>
    </div>
    
    <div class="area-jawab mt-3 mb-5">
        <?php $i=0; foreach ($jawab as $key => $value) { ?>
            <?php if ($value->id_ask == $id) { $i++; ?>
                <div class="card mb-4">
                    <div class="card-header user-header" <?php if($value->asprak_jawab == 'yes'){ echo 'style="background: #abe0ff;"'; } ?> >
                        <div class="left-user-info">
                            <li <?php if($value->asprak_jawab == 'yes'){ echo 'style="color: black;"'; } ?>><i class="fa fa-user" aria-hidden="true"></i> <?= $value->nama_user ?></li>
                        </div>
                        <?php if ($value->id_user == $this->session->userdata('id_user')) { ?>
                            <div class="right-user-info">
                                <a class="b-hapus" href="">
                                    <li><i class="fa fa-trash" aria-hidden="true"></i> Delete</li>
                                </a>
                                <a class="b-ubah" href="">
                                    <li class="ml-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</li>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <p><?= $value->jawab ?></p>
    
                        <?php if ($value->foto_jawab != '') { ?>                    
                            <div class="text-center mb-4 mt-3">
                                <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample<?=$value->id_ans?>" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </button>
                            </div>
    
                            <div class="collapse" id="collapseExample<?=$value->id_ans?>">
                                <div class="card card-body">
                                    <img width="100%" src="<?= base_url('upload/foto_jawab/' . $value->foto_jawab) ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                            $like_count_id = 0;
                            $sum_like=0;

                            $report_count_id = 0;
                            $sum_report = 0;
                            foreach ($like as $key => $row) {
                                if ($row->id_ans == $value->id_ans) {
                                    if ($row->id_user_like == $this->session->userdata('id_user')) {
                                        $like_count_id++;
                                        $id_like = $row->id_like;
                                    }
                                    $sum_like++;
                                }
                                
                            }
                            foreach ($report as $key => $row) {
                                if ($row->id_ans == $value->id_ans) {
                                    if ($row->id_user_report == $this->session->userdata('id_user')) {
                                        $report_count_id++;
                                        $id_report = $row->id_report;
                                    }
                                    $sum_report++;
                                }
                                
                            }
                        ?>
                        <div class="footer-jawab mt-3">
                            <?php if ($like_count_id==0) { ?>
                                <li style="display: flex; align-items: center;" class="ml-2"><a <?php if (!$this->session->userdata('id_user')) { ?> class="disabled-link" <?php  } ?> href="<?= base_url('diskusi/like_jawab/' . $value->id_ans) ?>"><i style="font-size: 20px;" class="fa fa-heart-o" aria-hidden="true"></i></a> &nbsp; <?= $sum_like ?> Like</li>
                            <?php }else { ?>
                                <li style="display: flex; align-items: center;" class="ml-2"><a <?php if (!$this->session->userdata('id_user')) { ?> class="disabled-link" <?php  } ?> href="<?= base_url('diskusi/unlike/' . $id_like) ?>"><i style="font-size: 20px;" class="fa fa-heart" aria-hidden="true"></i></a> &nbsp; <?= $sum_like ?> Like</li>
                            <?php } ?>
                            
                            <?php if ($sum_report < 9) { ?>
                                <?php if ($report_count_id == 1) { ?>
                                    <li class="ml-4"><a class="disabled"><i style="font-size: 20px; cursor: pointer;" class="fa fa-exclamation-triangle text-secondary" aria-hidden="true"> </i></a> &nbsp; <?= $sum_report ?> Report</li>
                                <?php }else { ?>
                                    <li class="ml-4"><a data-toggle="modal" data-target="#report<?= $value->id_ans ?>"><i style="font-size: 20px; cursor: pointer;" class="fa fa-exclamation-triangle text-danger" aria-hidden="true"> </i></a> &nbsp; <?= $sum_report ?> Report</li>
                                <?php } ?>
                            <?php }else { ?>
                                <li class="ml-4"><a data-toggle="modal" data-target="#reportDelete<?= $value->id_ans ?>"><i style="font-size: 20px; cursor: pointer;" class="fa fa-exclamation-triangle text-danger" aria-hidden="true"> </i></a> &nbsp; <?= $sum_report ?> Report</li>
                            <?php } ?>

                            <li class="ml-4"><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('d-m-Y', strtotime($value->created_ans)) ?></li>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php } ?>
            <?php if ($i<1) { ?>
                <div class="alert alert-danger" role="alert">
                    Jawaban masih kosong
                </div>
            <?php } ?>
    </div>

    <hr>

    <div class="diskusi" style="margin-bottom: 100px;">
        <div>
            <h4 class="mb-3" style="font-weight: 400;">Kirim Jawaban Anda</h4>
            <?php if ($this->session->userdata('id_user')) { ?>
                <?php
                    echo form_open_multipart('diskusi/add_ans_user');
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
                <?php echo form_close(); ?>
            <?php }else { ?>
                <div class="alert alert-danger" role="alert">
                    Silahkan melakukan <a href="<?= base_url('auth/login') ?>">login</a> terlebih dahulu untuk menambah jawaban!
                </div>
            <?php } ?>
                
        </div>
    </div>
</div>

<!-- Modal Report User -->
<?php foreach ($jawab as $key => $value) { ?>
    <?php if ($value->id_ask == $id) { ?>
        <div class="modal fade" id="report<?= $value->id_ans ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report Jawaban <?= $value->nama_user ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php if ($this->session->userdata('id_user')) { ?>
                        <div class="modal-body">
                            <?php echo form_open_multipart('diskusi/report/' . $value->id_ans); ?>
                            <div class="option-report" style="width: 80%; margin: auto;">
                                <div class="form-check">
                                    <input class="" type="radio" name="report" id="pilihan1" value="Jawaban tidak sesuai dengan pertanyaan.">
                                    <label class="" for="pilihan1">
                                        Jawaban tidak sesuai dengan pertanyaan.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="" type="radio" name="report" id="exampleRadios2" value="Mengandung kata-kata yang tidak sewajarnya.">
                                    <label class="" for="exampleRadios2">
                                        Mengandung kata-kata yang tidak sewajarnya.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="" type="radio" name="report" id="exampleRadios3" value="Mengandung unsur SARA.">
                                    <label class="" for="exampleRadios3">
                                        Mengandung unsur SARA.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="" type="radio" name="report" id="exampleRadios4" value="Mengandung unsur politik.">
                                    <label class="" for="exampleRadios4">
                                        Mengandung unsur politik.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input class="" type="radio" name="report" value="Other" id="otherRadio<?= $value->id_ans ?>">
                                        Lainnya:
                                        <input class="form-control" type="text" id="otherInput<?= $value->id_ans ?>" name="report" disabled>
                                    </label><br><br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <?php echo form_close(); ?>
                    <?php }else { ?>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                Silahkan <a href="<?= base_url('auth/login') ?>" target="_blank">login</a> terlebih dahulu!
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<!-- Report Delete -->
<?php foreach ($jawab as $key => $value) { ?>
    <?php if ($value->id_ask == $id) { ?>
        <div class="modal fade" id="reportDelete<?= $value->id_ans ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report Jawaban <?= $value->nama_user ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php if ($this->session->userdata('id_user')) { ?>
                        <div class="modal-body">
                            <?php echo form_open_multipart('diskusi/delete_jawab/' . $value->id_ans); ?>
                            <div class="option-report" style="width: 80%; margin: auto;">
                                <div class="form-check">
                                    <input class="" type="radio" name="report" id="pilihan1" value="Jawaban tidak sesuai dengan pertanyaan.">
                                    <label class="" for="pilihan1">
                                        Jawaban tidak sesuai dengan pertanyaan.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="" type="radio" name="report" id="exampleRadios2" value="Mengandung kata-kata yang tidak sewajarnya.">
                                    <label class="" for="exampleRadios2">
                                        Mengandung kata-kata yang tidak sewajarnya.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="" type="radio" name="report" id="exampleRadios3" value="Mengandung unsur SARA.">
                                    <label class="" for="exampleRadios3">
                                        Mengandung unsur SARA.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="" type="radio" name="report" id="exampleRadios4" value="Mengandung unsur politik.">
                                    <label class="" for="exampleRadios4">
                                        Mengandung unsur politik.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input class="" type="radio" name="report" value="Other" id="otherRadio<?= $value->id_ans ?>">
                                        Lainnya:
                                        <input class="form-control" type="text" id="otherInput<?= $value->id_ans ?>" name="report" disabled>
                                    </label><br><br>
                                </div>
                            </div>
                            <div class="alert alert-danger" role="alert">
                                Hasil report akan menghapus jawaban ini
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Hapus Jawaban</button>
                        </div>

                        <?php echo form_close(); ?>
                    <?php }else { ?>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                Silahkan <a href="<?= base_url('auth/login') ?>" target="_blank">login</a> terlebih dahulu!
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>


<!-- Modal Like User -->
<?php foreach ($jawab as $key => $value) { ?>
    <?php if ($value->id_ask == $id) { ?>
        <script>
            const otherRadio = document.getElementById('otherRadio<?= $value->id_ans ?>');
            const otherInput = document.getElementById('otherInput<?= $value->id_ans ?>');
            const radios = document.querySelectorAll('input[name="report"]');

            radios.forEach(radio => {
                radio.addEventListener('change', () => {
                if (otherRadio.checked) {
                    otherInput.disabled = false;
                    otherInput.focus();
                } else {
                    otherInput.disabled = true;
                    otherInput.value = "";
                }
                });
            });
        </script>
    <?php } ?>
<?php } ?>
