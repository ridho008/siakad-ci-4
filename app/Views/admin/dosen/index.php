<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6 mb-3">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalDosen">Tambah Data Dosen</button>
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
               <h6 class="m-0 font-weight-bold text-primary">Data Dosen</h6>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Foto</th>
                           <th>Kode Dosen</th>
                           <th>NIDN</th>
                           <th>Dosen</th>
                           <th><i class="fas fa-cogs"></i></th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php $no = 1; foreach($dosen as $d) : ?>
                     <tr>
                        <td><?= $no++; ?></td>
                        <td>
                           <img src="/img/dosen/<?= $d['foto_dosen']; ?>" width="100">
                        </td>
                        <td><?= $d['kode_dosen']; ?></td>
                        <td><?= $d['nidn']; ?></td>
                        <td><?= $d['nama_dosen']; ?></td>
                        <td>
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalDosen<?= $d['id_dosen']; ?>">Edit</button>
                           <form action="/dosen/destroy/<?= $d['id_dosen']; ?>" method="post">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus <?= $d['nama_dosen']; ?>')">Hapus</button>
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
<div class="modal fade" id="formModalDosen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dosen/save" method="post" enctype="multipart/form-data">
         <?= csrf_field(); ?>
         <div class="form-group">
            <label for="kode">Kode Dosen</label>
            <input type="text" name="kode" id="kode" class="form-control<?= ($validation->hasError('kode')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('kode'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="nidn">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="form-control<?= ($validation->hasError('nidn')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nidn'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="nama">Nama Dosen</label>
            <input type="nama" name="nama" id="nama" class="form-control<?= ($validation->hasError('nama')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nama'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control<?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>">
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
<?php foreach($dosen as $d) : ?>
<div class="modal fade" id="formModalDosen<?= $d['id_dosen']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Dosen <?= $d['nama_dosen']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dosen/update/<?= $d['id_dosen']; ?>" method="post" enctype="multipart/form-data">
         <?= csrf_field(); ?>
         <input type="text" name="fotoLama" value="<?= $d['foto_dosen']; ?>">
         <input type="text" name="id_dosen" value="<?= $d['id_dosen']; ?>">
         <div class="form-group">
            <label for="kode">Kode Dosen</label>
            <input type="text" name="kode" id="kode" class="form-control<?= ($validation->hasError('kode')) ? ' is-invalid' : '' ?>" value="<?= (old('kode')) ? old('kode') : $d['kode_dosen']; ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('kode'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="nidn">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="form-control<?= ($validation->hasError('nidn')) ? ' is-invalid' : '' ?>" value="<?= (old('nidn')) ? old('nidn') : $d['nidn']; ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nidn'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="nama">Nama Dosen</label>
            <input type="nama" name="nama" id="nama" class="form-control<?= ($validation->hasError('nama')) ? ' is-invalid' : '' ?>" value="<?= (old('nama')) ? old('nama') : $d['nama_dosen']; ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nama'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control<?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>">
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
           <button type="submit" class="btn btn-primary">Edit</button>
         </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?= $this->endSection(); ?>