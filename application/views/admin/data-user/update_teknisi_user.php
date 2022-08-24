<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-6">
              <h3 class="justify-content-start">Update Data User</h3>
            </div>
          </div>
        </div>
        <div class="card-body  pb-2">
          <form action="<?= base_url('admin/change/data_user_teknisi/edit_teknisi_user') ?>" enctype="multipart/form-data" method="post">
            <?php foreach ($data_user as $u) { ?>
              <div class="">
                <div class="hero text-white hero-bg-image" data-background="<?= base_url('assets/') ?>stisla-assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg">
                  <div class="col-md-4 mx-auto rounded-circle bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <?php if ($u->photo == null) : ?>
                      <img src="<?= base_url() . 'assets/profile_picture/default.png' ?>" class="card-img-top  rounded-circle img-responsive" alt="...">
                    <?php else : ?>
                      <img src="<?= base_url() . 'assets/profile_picture/' . $u->photo; ?>" class="card-img-top  rounded-circle img-responsive" alt="...">
                    <?php endif ?>
                  </div>
                  <div class="text-center mx-auto mt-3 mb-2" style="width: 50%;">
                    <div class="custom-file">
                      <input type="file" class="form-control" id="image" name="photo" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01"></label>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div id="detail" class="col-md-12 bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                <h1 class="font-weight-bold card-title text-center" style="color: black;">Update Data
                  User
                </h1>
                <p class="text-center my-4" style="line-height: 5px;">Silahkan isi data dibawah untuk update
                  data, dan upload file diatas untuk update data profile picture</p>
                <hr>
                <div class="form-group">
                  <input type="hidden" name="id" value="<?= $u->id ?>">
                  <label for="nim" class="font-weight-bold" style="font-size: 20px;">Nama</label>
                  <input type=" text" class="form-control" id="nim" aria-describedby="emailHelp" required name="nama" value="<?= $u->nama ?>">
                </div>
                <div class="form-group">
                  <label for="nama_prestasi" class="font-weight-bold" style="font-size: 20px;">Email</label>
                  <input type="text" class="form-control" name="email" value="<?= $u->email ?>" id="nama_prestasi">
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="nama_file" class="font-weight-bold" style="font-size: 20px;">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1" class="font-weight-bold text-sm">Jenis User</label>
                      <select class="form-control" name="jenis" id="exampleFormControlSelect1">
                        <?php foreach ($role as $roles) : ?>
                          <?php if ($u->jenis == $roles['jenis']) : ?>
                            <option selected value="<?= $roles['jenis'] ?>"><?= $roles['jenis'] ?></option>
                          <?php else : ?>
                            <option value="<?= $roles['jenis'] ?>"><?= $roles['jenis'] ?></option>
                          <?php endif ?>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="" class="font-weight-bold text-sm">Instansi</label>
                      <select class="form-control" name="code_instansi" id="">
                        <?php foreach ($instansi as $instansis) : ?>
                          <?php if ($u->code_instansi == $instansis->id) : ?>
                            <option selected value="<?= $u->code_instansi ?>"><?= $instansis->instansi ?></option>
                          <?php else : ?>
                            <option value="<?= $instansis->id ?>"><?= $instansis->instansi ?></option>
                          <?php endif ?>
                        <?php endforeach ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="alamat" class="label-font-register">Alamat</label>
                      <textarea name="alamat" class="form-control" cols="5" rows="5" placeholder="Masukkan alamat"><?= $u->alamat ?></textarea>
                    </div>
                  </div>
                </div>
                <input type="submit" value="Update ⭢" class="btn btn-success btn-block">
              </div>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
  </div>