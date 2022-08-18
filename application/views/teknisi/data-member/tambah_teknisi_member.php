

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <?= $this->session->flashdata('errors') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-6">
                <h3 class="justify-content-start">Tambah Member</h3>
              </div>
              </div>
            </div>
            <div class="card-body  pb-2">
              <?php echo form_open_multipart('teknisi/change/data_member_teknisi/tambah_teknisi_member'); ?>
                    <div class="form-group ">
                      <label for="nama_prestasi" class="label-font-register">Nama</label>
                      <input type="Text" class="form-control" name="nama" id="nama_prestasi" placeholder="Nama Lengkap ..  " required="">
                      <?= form_error('Nama_prestasi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                            
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="id_rfid" class="label-font-register">No ID Kartu Member</label>
                          <input type="number" class="form-control" autocomplete="off" name="id_rfid" id="id_rfid" placeholder="No ID kartu member .." required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="code_instansi">Instansi</label>
                            <select class="form-control" name="code_instansi" id="code_instansi">
                              <?php foreach ($data_instansi as $instansi) : ?>
                                <option value="<?php echo $instansi->id ?>"><?php echo $instansi->instansi ?></option>
                              <?php endforeach ?>
                            </select>

                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                          <select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama_file" class="label-font-register">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="nama_file" placeholder="Tanggal Lahir .." required>
                            <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Upload ⭢
                        </button>
                    </div>
                <?php echo form_close() ?>
            </div>
          </div>
        </div>
      </div>

