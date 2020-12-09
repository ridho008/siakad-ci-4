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
                          <form action="/matkul/destroy/<?= $m['id_matkul']; ?>" class="btn btn-danger">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id_prodi" value="<?= $m['id_prodi']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus <?= $m['matkul'] ?>?')">Hapus</button>
                          </form>
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

<div class="modal fade" id="formModalMatkul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Kuliah <?= $detail['prodi']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/matkul/save" method="post">
          <?= csrf_field(); ?>
          <input type="text" name="id_prodi" value="<?= $detail['id_prodi']; ?>">
          <div class="form-group">
            <label for="kode">Nama kode</label>
            <input type="text" name="kode" id="kode" class="form-control<?= ($validation->hasError('kode')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('kode'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="matkul">Nama Matkul</label>
            <input type="text" name="matkul" id="matkul" class="form-control<?= ($validation->hasError('matkul')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('matkul'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="sks">SKS</label>
            <select name="sks" id="sks" class="form-control<?= ($validation->hasError('sks')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih SKS --</option>
              <?php for($i = 1; $i <= 4; $i++) : ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php endfor; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('sks'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="smt">Semester</label>
            <select name="smt" id="smt" class="form-control<?= ($validation->hasError('smt')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih Semester --</option>
              <?php for($i = 1; $i <= 8; $i++) : ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php endfor; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('smt'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control<?= ($validation->hasError('kategori')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih Kategori --</option>
              <option value="Wajib">Wajib</option>
              <option value="Pilihan">Pilihan</option>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('kategori'); ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?> 