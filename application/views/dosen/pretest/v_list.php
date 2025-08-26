<?php
// $highestValues = [];
// foreach ($posttest as $key => $value) {
//     if (!isset($highestValues[$value->id_user]) || $value->sum > $highestValues[$value->id_user]) {
//         $highestValues[$value->id_user] = $value->sum;
//     }
// }

?>



<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Hasil Pretest</li></h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Nilai Pre-Test</h4>
                </div>
                <div class="dropdown pd-20">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Pilih Praktikum
                    </button>
                    <div class="dropdown-menu">
                        <?php foreach ($kursus as $key => $value) { ?>
                            <?php if ($value->id_admin == $this->session->userdata('id_admin')) { ?>
                                <a class="dropdown-item" href="<?= base_url('dosen/pretest/hasil/' . $value->id_kursus) ?>"><?= $value->nama_kursus ?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Praktikum</th>
                                <th>Materi</th>
                                <th>Nilai Pre-Test</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ;
                            $list_pretest   = $this->m_pretest->do_pretest();
                            foreach ($list_pretest as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->nama_user?></td>
                                <td><?= $value->nim?></td>
                                <td><?= $value->nama_kursus?></td>
                                <td><?= $value->nama_materi?></td>
                                <td><?= $value->sum?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>