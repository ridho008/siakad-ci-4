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
              <h6 class="m-0 font-weight-bold text-primary">Jadwal Kuliah <?= $prodi['prodi']; ?></h6>
              <div class="row">
                <div class="col-md-6">
                  <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#formModalJadwalDetail">Tambah Data Jadwal</button>
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
                      <th>SKS</th>
                      <th>Dosen</th>
                      <th>Hari</th>
                      <th>Waktu</th>
                      <th>Kelas</th>
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
                        <td><?= $j['sks']; ?></td>
                        <td><?= $j['nama_dosen']; ?></td>
                        <td><?= $j['hari']; ?></td>
                        <td><?= $j['waktu']; ?></td>
                        <td><?= $j['nama_kelas']; ?></td>
                        <td><?= $j['ruangan']; ?></td>
                        <td><?= $j['quota']; ?></td>
                        <td>
                          <form action="/jadwalKuliah/destroy/<?= $j['id_jadwal']; ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" value="DELETE" name="_method">
                            <input type="hidden" value="<?= $j['id_prodi']; ?>" name="id_prodi">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                    <?php if(empty($jadwal)) : ?>
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


<div class="modal fade" id="formModalJadwalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Kuliah <?= $prodi['prodi']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/jadwalKuliah/save" method="post">
          <?= csrf_field(); ?>
          <input type="hidden" name="id_prodi" value="<?= $prodi['id_prodi']; ?>">
          <input type="hidden" name="id_ta" value="<?= $tahunAkademik['id_ta']; ?>">
          <div class="form-group">
            <label for="matkul">Nama Matkul</label>
            <select name="matkul" id="matkul" class="form-control<?= ($validation->hasError('matkul')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih Mata Kuliah --</option>
              <?php foreach($matkul as $m) : ?>
                <option value="<?= $m['id_matkul']; ?>"><?= $m['smt'] .'/' .$m['matkul']. ' / ' . $m['sks'] ; ?> SKS</option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('matkul'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" class="form-control<?= ($validation->hasError('kelas')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih kelas --</option>
              <?php foreach($kelas as $k) : ?>
                <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('kelas'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="dosen">Dosen</label>
            <select name="dosen" id="dosen" class="form-control<?= ($validation->hasError('dosen')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih Dosen --</option>
              <?php foreach($dosen as $d) : ?>
                <option value="<?= $d['id_dosen']; ?>"><?= $d['nama_dosen']; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('dosen'); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" id="hari" class="form-control<?= ($validation->hasError('hari')) ? ' is-invalid' : '' ?>">
                  <option value="">-- Pilih Hari --</option>
                  <option value="Senin">Senin</option>
                  <option value="Selasa">Selasa</option>
                  <option value="Rabu">Rabu</option>
                  <option value="Kamis">Kamis</option>
                  <option value="Jumat">Jumat</option>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('hari'); ?>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="text" name="waktu" id="waktu" class="form-control<?= ($validation->hasError('waktu')) ? ' is-invalid' : '' ?>" placeholder="Contoh : 12.00-13.00">
                <div class="invalid-feedback">
                  <?= $validation->getError('waktu'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="ruangan">Ruangan</label>
                <select name="ruangan" id="ruangan" class="form-control<?= ($validation->hasError('ruangan')) ? ' is-invalid' : '' ?>">
                  <option value="">-- Pilih Ruangan --</option>
                  <?php foreach($ruangan as $r) : ?>
                    <option value="<?= $r['id_ruangan']; ?>"><?= $r['ruangan']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('ruangan'); ?>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="quota">Quota</label>
                <input type="number" name="quota" id="quota" class="form-control<?= ($validation->hasError('quota')) ? ' is-invalid' : '' ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('quota'); ?>
                </div>
              </div>
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