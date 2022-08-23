<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <p class="text-primary"><?= $this->session->flashdata('success'); ?></p>
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-6">
              <h3 class="justify-content-start">Data IMT Management</h3>
            </div>

            <div class="col-6">
              <a class="btn bg-gradient-primary  w-100 justify-content-end" href="<?= base_url('/petugas/petugas/tambah_data_imt') ?>" type="button">Tambah Data +</a>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">B B</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">T B
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Status IMT</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        Ideal</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Created</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">rfid
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action
                      </th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($data_imt as $value) : ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->nama ?></td>
                        <td><?= $value->berat_badan ?></td>
                        <td><?= $value->tinggi_badan ?></td>
                        <td>
                          <?php
                          $tinggi = (int)$value->tinggi_badan / 100;
                          $hasil_tinggi = $tinggi * $tinggi;

                          $bmi = (int)$value->berat_badan / $hasil_tinggi;
                          echo round($bmi, 2);
                          ?>
                        </td>
                        <td>
                          <?php
                          if (round($bmi, 2) < 18) {
                            echo '<b>Kurus</b> <br> <a href="#">Tampilkan Saran</a>';
                          } elseif (round($bmi, 2) >= 18 && round($bmi, 2) <= 25) {
                            echo '<b>Normal</b> <br> <a href="#">Tampilkan Saran</a>';
                          } elseif (round($bmi, 2) > 25 && round($bmi, 2) < 27) {
                            echo '<b>Kegemukan</b> <br> <a href="#">Tampilkan Saran</a>';
                          } else {
                            echo '<b>Obesitas</b> <br> <a href="#">Tampilkan Saran</a>';
                          }
                          ?>
                        </td>
                        <td><?= $value->created ?></td>
                        <td><?= $value->id_rfid ?></td>
                        <td>
                          <!-- <a href="<?php echo site_url('petugas/change/data_member_teknisi/detail_teknisi_member/' . $value->id); ?>" class="btn btn-link text-success text-gradient px-3 mb-0">Detail ⭢</a> -->

                          <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:void(0)" data-url="<?= site_url('teknisi/change/data_imt_teknisi/delete_teknisi_imt/' . $value->id); ?>" onclick="hapus(this)"><i class="far fa-trash-alt me-2"></i></a>

                          <a class="btn btn-link text-primary px-3 mb-0" href="<?php echo site_url('teknisi/change/data_imt_teknisi/update_teknisi_imt/' . $value->id); ?>"><i class="fas fa-pencil-alt text-primary me-2" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>