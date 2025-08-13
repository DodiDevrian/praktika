<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Data Praktikum Yang Diampu</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('dosen/dashboard/profile/' . $profile->id_admin) ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kursus</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 mb-30">
                        <div class="card-box" style="height: 100%;">
                        <div class="profile-photo">
                            <a href="modal" data-toggle="modal" data-target="#editFoto1" class="edit-avatar" style="margin-top: 20px;"><i class="fa fa-pencil"></i></a>
                            <img src="<?= base_url('upload/foto_dosen/' . $profile->foto_dosen) ?>" alt="" class="avatar-photo">
                            <div class="modal fade" id="editFoto1" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body pd-5">
                                        <?php
                                            if (isset($error_upload)) {
                                                echo '<div class="alert alert-danger alert-dismissible m-3">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
                                            }
                                            
                                            echo form_open_multipart('dosen/profile/edit_foto/' . $profile->id_admin);
                                        ?>
                                        <div class="form-group">
                                            <label>Edit Foto Profile</label>
                                            <input type="file" class="form-control-file form-control height-auto" name="foto_dosen">
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Update" class="btn btn-primary">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="text-center h5 mb-0 mt-5"><?= $profile->nama_dosen ?></h5>
                        <p class="text-center text-muted font-14" style="margin-bottom: 0px;"><?= $profile->nip ?></p>
                        <p class="text-center text-muted font-14"><?= $profile->email ?></p>
                        <div class="text-center">
                            <button type="button" class="btn btn-warning mb-5" data-toggle="modal" data-target="#editData"><i class="fa fa-edit" aria-hidden="true"></i> Ubah Data dan Password</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 mb-30">
                    <div class="card-box">
                        <div class="mb-30 pd-20 d-flex justify-content-between">
                            <h4 class="text-blue h4">Data Praktikum Yang Diampu</h4>
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
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th>Mata Kuliah</th>
                                        <th>Keterangan</th>
                                        <th>Cover</th>
                                        <th class="datatable-nosort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kursus as $key => $value) {
                                        if ($value->id_admin == $this->session->userdata('id_admin')) { ?>
                                    <tr>
                                        <td><?= $value->nama_kursus?></td>
                                        <td><?= wordwrap($value->ket_kursus,45,"<br>\n");?></td>
                                        <td><img width="100px" src="<?= base_url('upload/cover_kursus/') . $value->cover_kursus ?>" alt=""></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="<?= base_url('dosen/kursus/list_materi/' . $value->id_kursus) ?>"><i class="dw dw-eye"></i> Lihat Materi</a>
                                                    <a class="dropdown-item" href="<?= base_url('dosen/posttest/soal/' . $value->id_kursus) ?>"><i class="icon-copy dw dw-list"></i> Lihat Soal Post Test</a>
                                                    <a class="dropdown-item" href="<?= base_url('dosen/posttest/hasil/' . $value->id_kursus) ?>"><i class="icon-copy dw dw-list"></i> Lihat Hasil Post Test</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data dan Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                            if (isset($error_upload)) {
                                echo '<div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
                            }
                            
                            echo form_open_multipart('dosen/profile/edit_data/' . $profile->id_admin);
                        ?>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input class="form-control" name="nama_dosen" type="text" value="<?= $profile->nama_dosen ?>" style="color: black;">
                            <?php echo form_error('nama_dosen', '<div class="text-danger small">', '</div>') ?>
                        </div>

                        <div class="form-group" style="margin-top: 35px;">
                            <label>NIP</label>
                            <input class="form-control" name="nip" type="text" value="<?= $profile->nip ?>" style="color: black;">
                            <?php echo form_error('nip', '<div class="text-danger small">', '</div>') ?>
                        </div>

                        <div class="form-group" style="margin-top: 35px;">
                            <label>Email</label>
                            <input class="form-control" name="email" type="text" value="<?= $profile->email ?>" style="color: black;">
                            <?php echo form_error('email', '<div class="text-danger small">', '</div>') ?>
                        </div>

                        <div class="form-group" style="margin-top: 35px;">
                            <label>Password <b style="color: red;">*Optional</b></label>
                            <input class="form-control" name="password" type="password" style="color: black;">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Foto Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?php
                if (isset($error_upload)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
                }
                
                echo form_open_multipart('dosen/profile/edit/' . $this->session->userdata('id_admin'));
            ?>
            <div class="form-group">
                <label>Edit Foto Profile</label>
                <input type="file" class="form-control-file form-control height-auto" name="foto_user">
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
        <?php echo form_close(); ?>
        </div>
    </div>
</div>