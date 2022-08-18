

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-6">
                <h3 class="justify-content-start">Create User</h3>
              </div>
              </div>
            </div>
            <div class="card-body  pb-2">
              <?php echo form_open_multipart('teknisi/change/data_user_teknisi/tambah_teknisi_user'); ?>

                <div class="form-group ">
                            <label for="nama_prestasi" class="label-font-register">Nama</label>
                            <input type="Text" class="form-control" name="nama" id="nama_prestasi" placeholder="Nama Lengkap ..  " required="">
                            <?= form_error('Nama_prestasi', '<small class="text-danger">', '</small>'); ?>
                        </div>

                    <div class="form-group">
                        <label for="nim" class="label-font-register">Email</label>
                        <input type="text" autocomplete="off" class="form-control effect-9" name="email" id="nim" placeholder="example@gmail.com" required="">
                        <?= form_error('nim', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                            
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label for="nama_file" class="label-font-register">Instansi</label>
                        <select name="code_instansi" id="" class="form-control">
                          <option selected disabled>-- Pilih Instansi --</option>
                          <?php foreach ($instansi as $value) : ?>
                            <option value="<?= $value->code_instansi ?>"><?= $value->instansi ?><option>                          
                          <?php endforeach ?>
                        </select>
                        <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>
                    </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label for="nama_file" class="label-font-register">Code Instansi</label>
                        <input type="text" class="form-control" autocomplete="off" name="code_instansi" id="nama_file" placeholder="Code Instasi Tanpa Spasi .." required>
                        <?= form_error('Nama_file', '<small class="text-danger">', '</small>'); ?>

                    </div>
                      </div>
                    </div>
                    
                    <div class="row">
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
                    </div>
                    
                        <!-- <div class="custom-file mb-2">
                          <label class="custom-file-label" for="inputGroupFile01">Upload Photo</label>
                                <input type="file" class="custom-file-input" id="image" name="photo" aria-describedby="inputGroupFileAddon01" >
                            </div> -->

                        

                  
                    <div class="form-check">
                        <input class="form-check-input checkbox" type="checkbox" id="defaultCheck1" onchange="document.getElementById('btnsubmit').disabled = !this.checked;">
                        <label class=" form-check-label" for="defaultCheck1">
                            Saya setuju dan ingin melanjutkan
                        </label>
                    </div>
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

