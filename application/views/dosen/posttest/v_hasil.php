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
                            <h4>Dashboard</li></h4>
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
                <div class="pd-20 d-flex">
                    <a class="mr-3" href="<?= base_url('dosen/dashboard/profile/' . $this->session->userdata('id_admin')) ?>"><i class="icon-copy dw dw-left-arrow2"></i></a>
                    <h4 class="text-blue h4">Data Nilai Post Test</h4>
                </div>
                <div class="dropdown pd-20">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <?= $detail_kursus->nama_kursus ?>
                        </button>
                        <div class="dropdown-menu">
                            <?php foreach ($kursus as $key => $value) { ?>
                                <?php if ($value->id_admin == $this->session->userdata('id_admin')) { ?>
                                    <a class="dropdown-item" href="<?= base_url('dosen/posttest/hasil/' . $value->id_kursus) ?>"><?= $value->nama_kursus ?></a>
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
                                <th>Nilai Post Test</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ;
                            $highestValues   = $this->m_posttest->get_highest_values();
                            foreach ($highestValues as $id_user => $data) {  ?>
                                <?php if ("{$data['id_kursus']}" == $id) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?php echo "{$data['nama_user']}"; ?></td>
                                        <td><?php echo "{$data['nim']}"; ?></td>
                                        <td><?php echo "{$data['nama_kursus']}"; ?></td>
                                        <td><?php echo "{$data['sum']}";  ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>