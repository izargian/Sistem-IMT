<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-6">
              <h3 class="justify-content-start">Update Data Instansi</h3>
            </div>
          </div>
        </div>
        <div class="card-body  pb-2">
          <form action="<?= base_url('teknisi/change/data_instansi_teknisi/edit_teknisi_instansi') ?>" enctype="multipart/form-data" method="post">
            <?php foreach ($data_instansi as $u) { ?>

              <div id="detail" class="col-md-12 bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                <h1 class="font-weight-bold card-title text-center" style="color: black;">Update Data
                  Instansi
                </h1>
                <p class="text-center my-4" style="line-height: 5px;">Silahkan isi data dibawah untuk update
                  data, dan upload file diatas untuk update data profile picture</p>
                <hr>
                <div class="form-group">
                  <input type="hidden" name="id" value="<?= $u->id ?>">
                  <!-- <input type="hidden" name="tgl_upload" value="<?= $u->tgl_upload ?>"> -->

                  <label for="nim" class="font-weight-bold" style="font-size: 20px;">Instansi</label>
                  <input type=" text" class="form-control" id="nim" aria-describedby="emailHelp" required name="instansi" value="<?= $u->instansi ?>">
                </div>
                <div class="form-group">
                  <label for="nama_prestasi" class="font-weight-bold" style="font-size: 20px;">Code Instansi</label>
                  <input type="text" class="form-control" name="code_instansi" value="<?= $u->code_instansi ?>" id="nama_prestasi">
                </div>
                <div class="form-group">
                  <label for="nama_file" class="font-weight-bold" style="font-size: 20px;">Alamat</label>
                  <input type="text" class="form-control" name="alamat" value="<?= $u->alamat ?>" id="nama_file">
                </div>
                <input type="submit" value="Update ⭢" class="btn btn-success btn-block">
              </div>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
  </div>