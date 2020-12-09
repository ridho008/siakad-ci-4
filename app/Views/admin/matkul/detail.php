<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Mata Kuliah <?= $detail['prodi']; ?></h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <tr>
                <th>Program Studi</th>
                <td><?= $detail['prodi']; ?></td>
              </tr>
              <tr>
                <th>Jenjang</th>
                <td><?= $detail['prodi']; ?></td>
              </tr>
              <tr>
                  <th>Fakultas</th>
                  <td><?= $detail['fakultas']; ?></td>
                </tr>
            </table>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <!-- Detail Matkul -->
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Matkul</th>
                      <th>Mata Kuliah</th>
                      <th>SKS</th>
                      <th>Kategori</th>
                      <th>Semester</th>
                      <th><i class="fas fa-cogs"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach($matkul as $m) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $m['kode_matkul']; ?></td>
                        <td><?= $m['matkul']; ?></td>
                        <td><?= $m['sks']; ?></td>
                        <td><?= $m['kategori']; ?></td>
                        <td><?= $m['smt']; ?></td>
                        <td>
                          <form action="/matkul/destroy/<?= $m['id_matkul']; ?>" class="btn btn-danger">Hapus</form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                    <?php if(empty($matkul)) : ?>
                      <div class="text-danger alert-info p-2 mt-4 mb-4" role="alert">Data  Sedang Kosong.</div>
                    <?php endif; ?>
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