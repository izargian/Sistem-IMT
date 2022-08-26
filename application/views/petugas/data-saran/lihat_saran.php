<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <?= $this->session->flashdata('message'); ?>
            <?= $this->session->flashdata('success'); ?>
            <?= $this->session->flashdata('errors'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="justify-content-start">Saran</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                            <ul class="list-group">
                                <?php foreach ($data_saran as $data) : ?>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Status Ideal : <strong><?= $data->status_ideal ?></strong></h6>
                                        <h6 class="mb-1 text-sm">Keterangan :</h6>
                                        <span class="mb-2 text-xs"><?= $data->keterangan ?></span>
                                    </div>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>