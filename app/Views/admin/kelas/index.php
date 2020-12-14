<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6 mb-3">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalKelas">Tambah Data Kelas</button>
               <form action="/gedung" method="post">
                  <div class="input-group mt-3">
                    <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="cari..." name="keyword">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                    </div>
                  </div>
               </form>
               <?php if($validation->listErrors()) : ?>
               <div class="alert alert-danger" role="alert">
                  <?= $validation->listErrors(); ?>
               </div>
               <?php endif; ?>
               <?php if(session()->getFlashdata('success')) : ?>
               <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
               <?php endif; ?>
            </div>
         </div>
         <div class="card shadow mb-4">
            <div class="card-header">
               <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Kelas</th>
                           <th>Prodi</th>
                           <th>Dosen</th>
                           <th>Tahun</th>
                           <th>Jumlah</th>
                           <th><i class="fas fa-cogs"></i></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $db = \Config\Database::connect();
                        $no = 1; 
                        foreach($kelas as $k) : ?>
                        <?php 
                        $jml = $db->table('mahasiswa')
                                ->where('id_kelas', $k['id_kelas'])
                                ->countAllResults();
                        ?>
                  <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $k['nama_kelas']; ?></td>
                     <td><?= $k['prodi']; ?></td>
                     <td><?= $k['nama_dosen']; ?></td>
                     <td><?= $k['tahun_angkatan']; ?></td>
                     <td>
                       <span class="badge badge-primary"><?= $jml; ?></span><br>
                       <a href="/kelas/mahasiswa/<?= $k['id_kelas']; ?>" class="btn btn-success btn-sm">Mahasiswa</a>
                     </td>
                     <td>
                        <form action="/kelas/destroy/<?= $k['id_kelas']; ?>">
                           <?= csrf_field(); ?>
                           <input type="hidden" name="_method" value="DELETE">
                           <button type="submit" onclick="return confirm('Hapus <?= $k['nama_kelas']; ?>?')" class="btn btn-danger">Hapus</button>
                        </form>
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


<!-- Modal Tambah -->
<div class="modal fade" id="formModalKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/kelas/save" method="post">
         <?= csrf_field(); ?>
         <div class="form-group">
            <label for="kelas">Nama Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control<?= ($validation->hasError('kelas')) ? ' is-invalid' : '' ?>" value="<?= old('kelas'); ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('kelas'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="prodi">Program Studi</label>
            <select name="prodi" id="prodi" class="form-control<?= ($validation->hasError('prodi')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih Prodi --</option>
              <?php foreach($prodi as $p) : ?>
                <option value="<?= $p['id_prodi']; ?>"><?= $p['prodi']; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
               <?= $validation->getError('prodi'); ?>
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
         <div class="form-group">
            <label for="tahun">Tahun Angkatan</label>
            <select name="tahun" id="tahun" class="form-control<?= ($validation->hasError('tahun')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih Tahun Angkatan --</option>
              <?php for($i = date('Y'); $i >= date('Y') - 5; $i--) : ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php endfor; ?>
            </select>
            <div class="invalid-feedback">
               <?= $validation->getError('tahun'); ?>
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

<!-- Modal Ubah -->

<?= $this->endSection(); ?>