<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?> <?= $prodi['prodi']; ?></h1>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Mata Kuliah <?= $prodi['prodi']; ?></h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Program Studi</th>
                <td><?= $prodi['prodi']; ?></td>
              </tr>
              <tr>
                <th>Jenjang</th>
                <td><?= $prodi['jenjang']; ?></td>
              </tr>
              <tr>
                  <th>Fakultas</th>
                  <td><?= $prodi['fakultas']; ?></td>
                </tr>
                <tr>
                  <th>Tahun Akademik</th>
                  <td><?= $tahunAkademik['tahun_aka']; ?></td>
                </tr>
            </table>
          </div>
        </div>
        <div class="container">
        <hr>
          <div class="row">
            <div class="col-md-12">
              <h6 class="m-0 font-weight-bold text-primary">Mata Kuliah</h6>
              <div class="row">
                <div class="col-md-6">
                  <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#formModalMatkul">Tambah Data Matkul</button>
                  <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors(); ?>
                  </div>
                  <?php if(session()->getFlashdata('success')) : ?>
                  <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
                  <?php endif; ?>
                </div>
              </div>
              <!-- Detail Matkul -->
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Smt</th>
                      <th>Kode Matkul</th>
                      <th>Dosen</th>
                      <th>Hari</th>
                      <th>Waktu</th>
                      <th>Ruang</th>
                      <th>Quota</th>
                      <th><i class="fas fa-cogs"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach($jadwal as $j) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $j['smt']; ?></td>
                        <td><?= $j['kode_matkul']; ?></td>
                        <td><?= $j['nama_dosen']; ?></td>
                        <td><?= $j['hari']; ?></td>
                        <td><?= $j['waktu']; ?></td>
                        <td><?= $j['ruangan']; ?></td>
                        <td><?= $j['quota']; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                    <!-- <?php if(empty($matkul)) : ?>
                      <div class="text-danger alert-info p-2 mt-4 mb-4" role="alert">Data  Sedang Kosong.</div>
                    <?php endif; ?> -->
              </div>
              <!-- /Detail Matkul -->
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?> 