<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-6">
              <h3 class="justify-content-start">Create Instansi</h3>
            </div>
          </div>
        </div>
        <div class="card-body  pb-2">
          <?php echo form_open_multipart('teknisi/change/data_instansi_teknisi/tambah_teknisi_instansi'); ?>

          <div class="form-group ">
            <label for="nama_prestasi" class="h4 label-font-register">Nama Instansi</label>
            <input type="Text" class="form-control" name="instansi" id="nama_prestasi" placeholder="Nama Instansi ..  " required="">
            <?= form_error('Nama_prestasi', '<small class="text-danger">', '</small>'); ?>
          </div>

          <div class="form-group">
            <label for="nim" class="label-font-register h4">Code Instansi</label>
            <p class="text-danger">Tuliskan code dengan Huruf Kapital dan Tanpa Spasi</p>
            <input type="text" autocomplete="off" class="form-control effect-9" name="code_instansi" id="nim" placeholder="Example.. CH-PL" required="">
            <?= form_error('nim', '<small class="text-danger">', '</small>'); ?>
          </div>


          <div class="form-group">
            <label for="nama_file" class="label-font-register h4">Alamat Instansi</label>
            <input type="text" class="form-control" autocomplete="off" name="alamat" id="nama_file" placeholder="Alamat Instasi  .." required>
            <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>

          </div>

          <!-- <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                      <label for="exampleFormControlSelect1">Jenis User</label>
                      <select class="form-control" name="jenis" id="exampleFormControlSelect1">
                        <option >Choose ..</option>
                        <option value="Petugas">Petugas</option>
                        <option value="Teknisi">Teknisi</option>
                        <option value="Pemerintah">Pemerintah</option>
                        <option value="Admin">Admin</option>
                      </select>
                    </div>
                    
                  </div>
                  <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama_file" class="label-font-register">Password</label>
                            <input type="text" class="form-control" name="password" id="nama_file" placeholder="Your Password .." required>
                            <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>
      
                        </div>

                      </div>
                    </div> -->

          <!-- <div class="custom-file mb-2">
                          <label class="custom-file-label" for="inputGroupFile01">Upload Photo</label>
                                <input type="file" class="custom-file-input" id="image" name="photo" aria-describedby="inputGroupFileAddon01" >
                            </div> -->

          <!-- <p class="terms">Dengan mendaftar anda menyetujui <i>privasi dan persyaratan ketentuan
                    hukum kami </i>
                    baca selengkapnya <a href="#"> disini</a></p> -->
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