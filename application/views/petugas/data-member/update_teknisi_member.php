

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-6">
                <h3 class="justify-content-start">Ubah Member</h3>
              </div>
              </div>
            </div>
            <div class="card-body  pb-2">
              <?php echo form_open_multipart('petugas/change/data_member_teknisi/edit_teknisi_member'); ?>
              <input type="hidden" name="id" value="<?= $data_member->id ?>">
                    <div class="form-group ">
                      <label for="nama_prestasi" class="label-font-register">Nama</label>
                      <input type="Text" class="form-control" name="nama" id="nama_prestasi" value="<?= $data_member->nama ?>" placeholder="Nama Lengkap ..  " required="">
                      <?= form_error('Nama_prestasi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                            
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="id_rfid" class="label-font-register">No ID Kartu Member</label>
                          <input type="text" class="form-control" autocomplete="off" name="id_rfid" id="id_rfid" placeholder="No ID kartu member .." value="<?= $data_member->id_rfid ?>" readonly required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label for="code_instansi">Instansi</label>
                            <select class="form-control" name="code_instansi" id="code_instansi">
                              <?php foreach ($data_instansi as $instansi) : ?>
                                <?php if ($data_member->code_instansi == $instansi->id) : ?>
                                  <option value="<?php echo $data_member->id ?>" selected><?php echo $instansi->instansi ?></option>
                                <?php else : ?> 
                                  <option value="<?php echo $instansi->id ?>"><?php echo $instansi->instansi ?></option>
                                <?php endif ?>
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
                              <?php
                                foreach ($jenis_kelamin as $jk) : 
                              ?>
                                <?php if ($data_member->jenis_kelamin == $jk['jenis_kelamin']) : ?>
                                  <option value="<?php echo $data_member->jenis_kelamin ?>" selected><?php echo $data_member->jenis_kelamin ?></option>
                                <?php else : ?> 
                                  <option value="<?php echo $jk['jenis_kelamin'] ?>"><?php echo $jk['jenis_kelamin'] ?></option>
                                <?php endif ?>
                              <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama_file" class="label-font-register">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="nama_file" placeholder="Tanggal Lahir .." value="<?= $data_member->tgl_lahir ?>" required>
                            <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Simpan ⭢
                        </button>
                    </div>
                <?php echo form_close() ?>
            </div>
          </div>
        </div>
      </div>

