<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="justify-content-start">Tambah Data Saran</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <?= $this->session->flashdata('error'); ?>

                            <form action="<?php echo base_url('petugas/change/data_saran/insert') ?>" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Status Ideal</label>
                                        <select class="form-control" name="status_ideal" id="status_ideal">
                                            <option disabled selected>-- Pilih Staus Ideal --</option>
                                            <?php
                                            foreach ($status_ideal as $status_ideals) :
                                            ?>
                                                <?php if($data_saran->status_ideal == $status_ideals['status_ideal']) : ?>
                                                    <option value="<?= $status_ideals['status_ideal'] ?>" selected><?= $status_ideals['status_ideal'] ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $status_ideals['status_ideal'] ?>"><?= $status_ideals['status_ideal'] ?></option>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="10"><?= $data_saran->keterangan ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mb-4 ml-4">
                                    <div class="row">
                                        <div class="ml-auto">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>