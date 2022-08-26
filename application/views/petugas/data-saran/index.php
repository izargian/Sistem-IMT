<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <?= $this->session->flashdata('message'); ?>
            <?= $this->session->flashdata('success'); ?>
            <?= $this->session->flashdata('errors'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="justify-content-start">Data Saran</h3>
                        </div>

                        <div class="col-6">
                            <a class="btn bg-gradient-primary  w-100 justify-content-end" href="<?= base_url('petugas/change/data_saran/tambah') ?>" type="button">Tambah Data Saran +</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                            <div class="table-responsive ">
                                <table id="example" class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Ideal</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;
                                        foreach ($data_saran as $u) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <p class="text-sm text-center font-weight-bold mb-0"> <?php echo $no ?></p>

                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $u->status_ideal ?></span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:void(0)" data-url="<?= site_url('petugas/change/data_saran/delete/' . $u->id); ?>" onclick="delete_saran(this)"><i class="far fa-trash-alt me-2"></i></a>

                                                    <a class="btn btn-link text-primary px-3 mb-0" href="<?php echo site_url('petugas/change/data_saran/edit/' . $u->id); ?>"><i class="fas fa-pencil-alt text-primary me-2" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function delete_saran(el) {
            let url = $(el).data('url');
            Swal.fire({
                title: 'Peringatan',
                text: "Apakah Anda Ingin Menghapus?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "YA",
                cancelButtonText: "BATAL",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then((isConfirm) => {
                if (isConfirm.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        cache: "false",
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload();
                            })
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Error',
                                text: response.responseJSON.message,
                                showConfirmButton: false,
                                dangerMode: true,
                                timer: 2000
                            });
                        }
                    });
                }
                return false;
            });
        }
    </script>
    <?php if ($this->session->flashdata('success')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data Saran Berhasil Ditambah!',
                showConfirmButton: false,
                timer: 4500
            })
        </script>
    <?php endif; ?>