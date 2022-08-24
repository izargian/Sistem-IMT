<div class="container-fluid">
  <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?= base_url('assets/') ?>img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
  </div>
  <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="<?= base_url('assets/profile_picture/default.png') ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            <?= $detail->nama ?>
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            <?= $detail->jenis_kelamin ?>
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
        <div class="nav-wrapper position-relative end-0">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12 col-xl-12 mt-4 mb-4">
      <div class="card ">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Chart Berat Bdan dan Tinggi Badan</h6>
        </div>
        <div class="card-body p-3">
          <div id="chart">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-xl-4">
      <div class="card ">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Instansi</h6>
        </div>
        <div class="card-body p-3">
          <h6 class="text-uppercase text-body text-xs font-weight-bolder"><?= $detail->instansi ?></h6>
        </div>
      </div>
    </div>
    <div class="col-12 col-xl-4">
      <div class="card ">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Jenis Kelamin</h6>
        </div>
        <div class="card-body p-3">
          <h6 class="text-uppercase text-body text-xs font-weight-bolder"><?= $detail->jenis_kelamin ?></h6>
        </div>
      </div>
    </div>
    <div class="col-12 col-xl-4">
      <div class="card ">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Tanggal Lahir</h6>
        </div>
        <div class="card-body p-3">
          <h6 class="text-uppercase text-body text-xs font-weight-bolder"><?= $detail->tgl_lahir ?></h6>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="bg-white p-4 mt-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
        <div class="table-responsive ">
          <table id="example" class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Usia</th> -->
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">B B</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">T B</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">rfid</th>

              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($data_imt as $value) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $value->berat_badan ?></td>
                  <td><?= $value->tinggi_badan ?></td>
                  <td><?= $value->created ?></td>
                  <td><?= $value->id_rfid ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    var url = '<?= base_url() ?>';
    $.getJSON(url + 'petugas/change/data_member_teknisi/chart/<?= $this->uri->segment(5) ?>', function(response) {
      var options = {
        chart: {
          height: 280,
          type: "area"
        },
        dataLabels: {
          enabled: false
        },
        series: [{
            name: "Berat Badan",
            data: response.berat_badan
          },
          {
            name: "Tinggi Badan",
            data: response.tinggi_badan
          }
        ],
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 90, 100]
          }
        },
        xaxis: {
          categories: response.tanggal
        }
      };

      var chart = new ApexCharts(document.querySelector("#chart"), options);

      chart.render();
    });

  })
</script>