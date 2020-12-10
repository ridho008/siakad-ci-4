<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6 mb-3">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalUser">Tambah Data User</button>
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
                           <th>Nama User</th>
                           <th>Username</th>
                           <th>Role</th>
                           <th><i class="fas fa-cogs"></i></th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php $no = 1; foreach($user as $u) : ?>
                     <tr>
                        <td><?= $no++; ?></td>
                        <td>
                           <img src="/img/user/<?= $u['foto_user']; ?>" width="100">
                        </td>
                        <td><?= $u['nama_user']; ?></td>
                        <td><?= $u['username']; ?></td>
                        <td><?= $u['role']; ?></td>
                        <td>
                           <a href="/user/edit/<?= $u['id_user']; ?>" class="btn btn-info">Edit</a>
                           <form action="/user/destroy/<?= $u['id_user']; ?>">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus <?= $u['nama_user']; ?>')">Hapus</button>
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

<div class="modal fade" id="formModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/user/save" method="post" enctype="multipart/form-data">
         <?= csrf_field(); ?>
         <div class="form-group">
            <label for="nama">Nama User</label>
            <input type="text" name="nama" id="nama" class="form-control<?= ($validation->hasError('nama')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('nama'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control<?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>">
            <div class="invalid-feedback">
               <?= $validation->getError('username'); ?>
            </div>
         </div>
         <div class="form-group">
            <label for="password">password</label>
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

<?= $this->endSection(); ?>