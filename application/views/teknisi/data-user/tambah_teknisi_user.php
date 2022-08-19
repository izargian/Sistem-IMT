<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-6">
              <h3 class="justify-content-start">Tambah User</h3>
            </div>
          </div>
        </div>
        <div class="card-body  pb-2">
          <?php echo form_open_multipart('teknisi/change/data_user_teknisi/tambah_teknisi_user'); ?>

          <div class="form-group">
            <label for="nama" class="label-font-register">Nama</label>
            <input type="Text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Jenis User</label>
                <select class="form-control" name="jenis" id="exampleFormControlSelect1">
                  <option selected disabled>-- Pilih Jenis User --</option>
                  <?php foreach ($role as $roles) : ?>
                    <option value="<?= $roles['jenis'] ?>"><?= $roles['jenis'] ?></option>
                  <?php endforeach ?>
                </select>
                <?= form_error('jenis', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="form-group">
                <label for="email" class="label-font-register">Email</label>
                <input type="email" autocomplete="off" class="form-control effect-9" name="email" id="email" placeholder="Masukkan Email">
                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="form-group">
                <label for="password" class="label-font-register">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="code_instansi" class="label-font-register">Instansi</label>
              <select name="code_instansi" class="form-control" id="">
                <option selected disabled>-- Pilih Instansi --</option>
                <?php foreach ($instansi as $value) : ?>
                  <option value="<?= $value->id ?>"><?= $value->instansi ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('code_instansi', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="alamat" class="label-font-register">Alamat</label>
            <textarea name="alamat" class="form-control" cols="5" rows="5" placeholder="Masukkan alamat"></textarea>
            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
          </div>

          <div class="custom-file mb-4">
            <label class="custom-file-label" for="inputGroupFile01">Upload Photo</label>
            <input type="file" class="form-control" id="image" name="photo" aria-describedby="inputGroupFileAddon01">
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