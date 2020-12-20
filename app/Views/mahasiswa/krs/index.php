<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title . ' | ' .$tahunAka['tahun_aka']. ' ' . $tahunAka['semester']; ?></h1>
<!-- Content Row -->
<div class="row">
   <div class="col-md-3">
      <img src="/img/mahasiswa/<?= $mhs['foto_mhs']; ?>" class="img-fluid img-thumbnail card-img">
   </div>
   <div class="col-md-9">
      <table class="table">
         <tr>
            <th>Tahun Akademik</th>
            <th>:</th>
            <th><?= $tahunAka['tahun_aka']; ?></th>
         </tr>
         <tr>
            <th>NIM</th>
            <th>:</th>
            <th><?= $mhs['nim']; ?></th>
         </tr>
         <tr>
            <th>Nama</th>
            <th>:</th>
            <th><?= $mhs['nama_mhs']; ?></th>
         </tr>
         <tr>
            <th>Fakultas</th>
            <th>:</th>
            <th><?= $mhs['fakultas']; ?></th>
         </tr>
         <tr>
            <th>Program Studi</th>
            <th>:</th>
            <th><?= $mhs['prodi']; ?></th>
         </tr>
         <tr>
            <th>Dosen PA</th>
            <th>:</th>
            <th><?= $mhs['nama_dosen']; ?></th>
         </tr>
         <tr>
            <th>Kelas</th>
            <th>:</th>
            <th><?= $mhs['nama_kelas']; ?></th>
         </tr>
      </table>
   </div>
</div>

<div class="row">
   <div class="col-md-6">
      <a href="" class="btn btn-primary mb-1">Tambah Mata Kuliah</a>
      <a href="" class="btn btn-secondary mb-1">Cetak KRS</a>
   </div>
      <div class="col-md-12">
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
               <tr>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Matkul</th>
                  <th>SKS</th>
                  <th>SMT</th>
                  <th>Kelas</th>
                  <th>Ruang</th>
                  <th>Dosen</th>
               </tr>
            </table>
         </div>
      </div>
   </div>


<!-- Content Row -->
<?= $this->endSection(); ?>