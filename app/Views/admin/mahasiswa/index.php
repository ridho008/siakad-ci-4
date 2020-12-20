<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6 mb-3">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalMahasiswa">Tambah Data Mahasiswa</button>
               <form action="/user" method="post">
                  <div class="input-group mt-3">
                    <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="cari..." name="keyword">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                    </div>
                  </div>
               </form>
               <?php if(session()->getFlashdata('success')) : ?>
               <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
               <?php endif; ?>
               <?php if($validation->listErrors()) : ?>
               <div class="alert alert-danger" role="alert">
                  <?= $validation->listErrors(); ?>
               </div>
               <?php endif; ?>
            </div>
         </div>
         <div class="card shadow mb-4">
            <div class="card-header">
               <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Foto</th>
                           <th>NIM</th>
                           <th>Mahasiswa</th>
                           <th>Prodi</th>
                           <th><i class="fas fa-cogs"></i></th>
                        </tr>
                     </thead>
                     <tbody>
                       <?php $no = 1; foreach($mahasiswa as $m) : ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td>
                            <img src="/img/mahasiswa/<?= $m['foto_mhs']; ?>" width="100">
                          </td>
                          <td><?= $m['nim']; ?></td>
                          <td><?= $m['nama_mhs']; ?></td>
                          <td><?= $m['prodi']; ?></td>
                          <td>
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalMahasiswa<?= $m['id_mhs']; ?>">Edit</button>
                           <form action="/mahasiswa/destroy/<?= $m['id_mhs']; ?>" method="post">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus <?= $m['nama_mhs']; ?>')">Hapus</button>
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
<div class="modal fade" id="formModalMahasiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/mahasiswa/save" method="post" enctype="multipart/form-data">
         <?= csrf_field(); ?>
         <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control<?= ($validation->hasError('nim')) ? ' is-invalid' : '' ?>" value="<?= old('nim'); ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nim'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control<?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>" value="<?= old('password'); ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('password'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="nama">Nama Mahasiswa</label>
            <input type="text" name="nama" id="nama" class="form-control<?= ($validation->hasError('nama')) ? ' is-invalid' : '' ?>" value="<?= old('nama'); ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nama'); ?>
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
               <?= $validation->getError('password'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control-file<?= ($validation->hasError('foto')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('foto'); ?>
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

<!-- Modal Edit -->
<?php foreach($mahasiswa as $m) : ?>
<div class="modal fade" id="formModalMahasiswa<?= $m['id_mhs']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa <?= $m['nama_mhs']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/mahasiswa/update/<?= $m['id_mhs']; ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="fotoLama" value="<?= $m['foto_mhs']; ?>">
          <input type="hidden" name="id_mhs" value="<?= $m['id_mhs']; ?>">
         <?= csrf_field(); ?>
         <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control<?= ($validation->hasError('nim')) ? ' is-invalid' : '' ?>" value="<?= (old('nim')) ? old('nim') : $m['nim']; ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nim'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" id="password" class="form-control<?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>" value="<?= old('password'); ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('password'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="nama">Nama Mahasiswa</label>
            <input type="text" name="nama" id="nama" class="form-control<?= ($validation->hasError('nama')) ? ' is-invalid' : '' ?>" value="<?= (old('nama')) ? old('nama') : $m['nama_mhs']; ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nama'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="prodi">Program Studi</label>
            <select name="prodi" id="prodi" class="form-control<?= ($validation->hasError('prodi')) ? ' is-invalid' : '' ?>">
              <option value="">-- Pilih Prodi --</option>
              <?php foreach($prodi as $p) : ?>
                <?php if($p['id_prodi'] == $m['id_prodi']) : ?>
                <option value="<?= $p['id_prodi']; ?>" selected><?= $p['prodi']; ?></option>
                <?php else : ?>
                  <option value="<?= $p['id_prodi']; ?>"><?= $p['prodi']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
               <?= $validation->getError('password'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="foto">Foto</label><br>
            <img src="/img/mahasiswa/<?= $m['foto_mhs']; ?>" width="100">
            <input type="file" name="foto" id="foto" class="form-control-file<?= ($validation->hasError('foto')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('foto'); ?>
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Edit</button>
         </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
<?= $this->endSection(); ?>