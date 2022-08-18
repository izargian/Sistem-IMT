<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-6">
              <h3 class="justify-content-start">Instansi Management</h3>
            </div>

            <div class="col-6">
              <a class="btn bg-gradient-primary  w-100 justify-content-end" href="<?= base_url('teknisi/change/data_instansi_teknisi/tambah_teknisi_instansi') ?>" type="button">Tambah Data Instansi +</a>
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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Instansi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code Instansi</th>
                      <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Instansi</th> -->
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $no = 1;
                    foreach ($data_instansi as $u) {
                    ?>

                      <tr>
                        <td>
                          <p class="text-sm text-center font-weight-bold mb-0"> <?php echo $no ?></p>

                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img class="avatar avatar-sm me-3" height="40px" width="40px" src="<?= base_url() . 'assets/profile_picture/rs.png' ?>">
                            </div>

                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo $u->instansi ?></h6>
                              <!-- <p class="text-xs text-center text-secondary mb-0"><?php echo $u->jenis ?></p> -->
                            </div>
                          </div>
                        </td>

                        <td>
                          <p class="text-xs font-weight-bold mb-0"> <?php echo $u->alamat ?></p>

                        </td>

                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success"><?php echo $u->code_instansi ?></span>
                        </td>

                        <!-- <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $u->alamat ?></span>
                          </td> -->

                        <td class="align-middle text-center">

                          <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="<?php echo site_url('teknisi/change/data_instansi_teknisi/delete_teknisi_instansi/' . $u->id); ?>"><i class="far fa-trash-alt me-2"></i></a>

                          <a class="btn btn-link text-primary px-3 mb-0" href="<?php echo site_url('teknisi/change/data_instansi_teknisi/update_teknisi_instansi/' . $u->id); ?>"><i class="fas fa-pencil-alt text-primary me-2" aria-hidden="true"></i></a>
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