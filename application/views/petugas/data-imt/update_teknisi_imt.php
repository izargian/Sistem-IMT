<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-6">
              <h3 class="justify-content-start">Ubah Data IMT</h3>
            </div>
          </div>
        </div>
        <div class="card-body  pb-2">
          <?php echo form_open_multipart('petugas/change/data_imt_teknisi/teknisi_imt_edit'); ?>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="hidden" name="id" value="<?= $data_imt->id ?>">
                <label for="nama_file" class="label-font-register">Nama</label>
                <input type="text" class="form-control" autocomplete="off" name="tinggi_badan" placeholder="Nama" value="<?= $data_imt->nama ?>" required readonly>
                <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>

              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="nama_file" class="label-font-register">RFID</label>
                <input type="text" class="form-control" autocomplete="off" name="id_rfid" id="nama_file" placeholder="Berat Badan" value="<?= $data_imt->id_rfid ?>" readonly>
                <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label for="nama_file" class="label-font-register">Tinggi Badan</label>
                <input type="text" class="form-control" autocomplete="off" name="tinggi_badan" placeholder="Tinggi badan" value="<?= $data_imt->tinggi_badan ?>" required>
                <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>

              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="nama_file" class="label-font-register">Berat Badan</label>
                <input type="text" class="form-control" autocomplete="off" name="berat_badan" id="nama_file" placeholder="Berat Badan" value="<?= $data_imt->berat_badan ?>" required>
                <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="nama_file" class="label-font-register">Usia</label>
                <input type="text" class="form-control" autocomplete="off" name="usia" id="nama_file" placeholder="Berat Badan" value="<?= $data_imt->usia ?>" required>
                <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="ml-auto">
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">
                  Simpan ⭢
                </button>
              </div>
            </div>
          </div>
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>