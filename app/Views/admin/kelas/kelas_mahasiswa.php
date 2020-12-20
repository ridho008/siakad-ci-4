<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
   <div class="row">
      <div class="col-md-12">
        <div class="card shadow mb-4">
           <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Data Rombongan Kelas <?= $kelas['nama_kelas']; ?></h6>
           </div>
           <div class="card-body">
              <div class="table-responsive">
                <div class="row">
                  <div class="col-md-6">
                    <table class="table">
                      <tr>
                        <th>Nama Kelas</th>
                        <td>:</td>
                        <td><?= $kelas['nama_kelas']; ?></td>
                      </tr>
                      <tr>
                        <th>Program Studi</th>
                        <td>:</td>
                        <td><?= $kelas['prodi']; ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table">
                      <tr>
                        <th>Angkatan</th>
                        <td>:</td>
                        <td><?= $kelas['tahun_angkatan']; ?></td>
                      </tr>
                      <tr>
                        <th>Jumlah</th>
                        <td>:</td>
                        <td><?= $jml; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <?php if(session()->getFlashdata('success')) : ?>
                   <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
                   <?php endif; ?>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalKelasMhs">Tambah Rombongan Kelas</button>
                </div>
              </div>
              <div class="table-responsive mt-1">
                <table class="table table-striped table-bordered">
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Mahasiswa</th>
                    <th><i class="fa fa-cogs"></i></th>
                  </tr>
                  <?php $no = 1; foreach($mahasiswa as $m) : ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $m['nim']; ?></td>
                      <td><?= $m['nama_mhs']; ?></td>
                      <td>
                        <form action="/kelas/deletemhs/<?= $m['id_mhs']; ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="id_kelas" value="<?= $m['id_kelas']; ?>">
                          <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </table>
              </div>
           </div>
        </div>
      </div>
   </div>
</div>

<div class="modal fade" id="formModalKelasMhs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <tr>
              <th>No</th>
              <th>NIM</th>
              <th>Mahasiswa</th>
              <th>Prodi</th>
              <th><i class="fas fa-cogs"></i></th>
            </tr>
            <?php $no = 1; foreach($mhsZero as $mz) : ?>
            <tr>
              <?php if($kelas['id_prodi'] == $mz['id_prodi']) : ?>
              <td><?= $no++; ?></td>
              <td><?= $mz['nim']; ?></td>
              <td><?= $mz['nama_mhs']; ?></td>
              <td><?= $mz['prodi']; ?></td>
              <td>
                <form action="/kelas/savemhs/<?= $mz['id_mhs']; ?>" method="post">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']; ?>">
                  <input type="hidden" name="id_mhs" value="<?= $mz['id_mhs']; ?>">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                </form>
              </td>
              <?php endif; ?>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>