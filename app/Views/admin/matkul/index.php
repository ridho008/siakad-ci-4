<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 mb-3">
          <?php if(session()->getFlashdata('success')) : ?>
          <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
          <?php endif; ?>
        </div>
      </div>
      <div class="card shadow mb-4">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Data Mata Kuliah</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Fakultas</th>
                  <th>Kode</th>
                  <th>Prodi</th>
                  <th>Mata Kuliah</th>
                  <th><i class="fas fa-cogs"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                // koneksi DB
                $db = \Config\Database::connect();
                ?>
                <?php $no = 1; foreach($prodi as $p) : ?>
                <?php $jmlProdi = $db->table('matkul')->where('id_prodi', $p['id_prodi'])->countAllResults(); ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['fakultas']; ?></td>
                    <td><?= $p['kode_prodi']; ?></td>
                    <td><?= $p['prodi']; ?></td>
                    <td>
                      <span class="badge badge-primary"><?= $jmlProdi; ?></span>
                    </td>
                    <td>
                      <a href="/matkul/detail/<?= $p['id_prodi']; ?>" class="btn btn-info"><i class="fas fa-list"></i> Matkul</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?> 