<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

<div class="row">
   <div class="col-md-4 mb-4">
      <?php if(session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert"><?= session()->getFlashdata('pesan'); ?></div>
      <?php endif; ?>
     <div class="card border-left-primary shadow h-100 py-2">
       <div class="card-body">
         <div class="row no-gutters align-items-center">
           <div class="col mr-2 text-center">
            <img src="/img/mahasiswa/<?= $mahasiswa['foto_mhs']; ?>" alt="<?= $mahasiswa['nama_mhs']; ?>" class="img-thumbnail" width="300">
             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $mahasiswa['nama_mhs']; ?></div>
             <form action="/mahasiswa/upload" method="post" enctype="multipart/form-data">
               <input type="hidden" name="fotoLama" value="<?= $mahasiswa['foto_mhs']; ?>">
                <input type="file" class="form-control-file<?= ($validation->hasError('foto')) ? ' is-invalid' : '' ?>" name="foto">
                <div class="invalid-feedback">
                   <?= $validation->getError('foto'); ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload"></i></button>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="col-md-8">
      <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Selamat Datang <?= $mahasiswa['nama_mhs']; ?></h6>
          </div>
          <div class="card-body">
            <table class="table">
               <tr>
                  <th>Tahun Akademik</th>
                  <th>:</th>
                  <th><?= $tahunAka['tahun_aka']; ?></th>
               </tr>
               <tr>
                  <th>NIM</th>
                  <th>:</th>
                  <th><?= $mahasiswa['nim']; ?></th>
               </tr>
               <tr>
                  <th>Nama</th>
                  <th>:</th>
                  <th><?= $mahasiswa['nama_mhs']; ?></th>
               </tr>
               <tr>
                  <th>Fakultas</th>
                  <th>:</th>
                  <th><?= $mahasiswa['fakultas']; ?></th>
               </tr>
               <tr>
                  <th>Program Studi</th>
                  <th>:</th>
                  <th><?= $mahasiswa['prodi']; ?></th>
               </tr>
               <tr>
                  <th>Dosen PA</th>
                  <th>:</th>
                  <th>
                     <?php if(empty($mahasiswa['nama_dosen'])) : ?>
                        <span class="badge badge-info">Dosen Belum Dipilih.</span>
                        <?php else: ?>
                           <?= $mahasiswa['nama_dosen']; ?>
                     <?php endif; ?>
                  </th>
               </tr>
               <tr>
                  <th>Kelas</th>
                  <th>:</th>
                  <th>
                     <?php if(empty($mahasiswa['nama_kelas'])) : ?>
                        <span class="badge badge-info">Anda Belum Mendaftar Kelas.</span>
                        <?php else: ?>
                           <?= $mahasiswa['nama_kelas']. '-' . $mahasiswa['tahun_angkatan']; ?>
                     <?php endif; ?>
                  </th>
               </tr>
            </table>
          </div>
        </div>
   </div>
</div>

<?= $this->endSection(); ?>