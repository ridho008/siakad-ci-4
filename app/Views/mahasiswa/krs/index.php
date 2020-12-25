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
            <th>
               <?php if(empty($mhs['nama_dosen'])) : ?>
                  <span class="badge badge-info">Dosen Belum Dipilih.</span>
                  <?php else: ?>
                     <?= $mhs['nama_dosen']; ?>
               <?php endif; ?>
            </th>
         </tr>
         <tr>
            <th>Kelas</th>
            <th>:</th>
            <th>
               <?php if(empty($mhs['nama_kelas'])) : ?>
                  <span class="badge badge-info">Anda Belum Mendaftar Kelas.</span>
                  <?php else: ?>
                     <?= $mhs['nama_kelas']. '-' . $mhs['tahun_angkatan']; ?>
               <?php endif; ?>
            </th>
         </tr>
      </table>
   </div>
</div>

<div class="row">
   <div class="col-md-6">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalMatkulKrs">Tambah Mata Kuliah</button>
      <a href="" class="btn btn-secondary mb-1">Cetak KRS</a>
      <?php if($validation->listErrors()) : ?>
      <div class="alert alert-danger" role="alert">
         <?= $validation->listErrors(); ?>
      </div>
      <?php endif; ?>
      <?php if(session()->getFlashdata('success')) : ?>
      <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
      <?php endif; ?>
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
                  <th>Waktu</th>
                  <th><i class="fas fa-cogs"></i></th>
               </tr>
               <?php $sks = 0; $no = 1; foreach($matkulMhs as $mm) : ?>
               <?php $sks += $mm['sks']; ?>
                  <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $mm['kode_matkul']; ?></td>
                     <td><?= $mm['matkul']; ?></td>
                     <td><?= $mm['sks']; ?></td>
                     <td><?= $mm['smt']; ?></td>
                     <td><?= $mm['nama_kelas']. '-' .$mm['tahun_aka']; ?></td>
                     <td><?= $mm['ruangan']; ?></td>
                     <td><?= $mm['nama_dosen']; ?></td>
                     <td><?= $mm['hari']. '-' .$mm['waktu']; ?></td>
                     <td>
                        <form action="/krs/delete">
                           <?= csrf_field(); ?>
                           <input type="hidden" name="_method" value="DELETE">
                           <input type="hidden" name="id_krs" value="<?= $mm['id_krs']; ?>">
                           <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                     </td>
                  </tr>
               <?php endforeach; ?>
            </table>
            <h6>Jumlah SKS : <?= $sks; ?></h6>
         </div>
      </div>
   </div>

<div class="modal fade" id="formModalMatkulKrs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Kuliah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Kode</th>
                     <th>Matkul</th>
                     <th>SKS</th>
                     <th>SMT</th>
                     <th>Kelas</th>
                     <th>Ruang</th>
                     <th>Dosen</th>
                     <th>Quota</th>
                     <th>Waktu</th>
                     <th><i class="fas fa-cogs"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                   // koneksi DB
                   $db = \Config\Database::connect();
                   ?>
                  <?php $no = 1; foreach($jadwalMatkul as $jm) : ?>
                  <?php $jmlJadwal = $db->table('krs')->where('id_jadwal', $jm['id_jadwal'])->countAllResults(); ?>
                  <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $jm['kode_matkul']; ?></td>
                     <td><?= $jm['matkul']; ?></td>
                     <td><?= $jm['sks']; ?></td>
                     <td><?= $jm['smt']; ?></td>
                     <td><?= $jm['nama_kelas']; ?></td>
                     <td><?= $jm['ruangan']; ?></td>
                     <td><?= $jm['nama_dosen']; ?></td>
                     <td><?= $jmlJadwal. '/' .$jm['quota']; ?></td>
                     <td><?= $jm['hari']. '-' .$jm['waktu']; ?></td>
                     <td>
                        <?php if($jmlJadwal == $jm['quota']) : ?>
                           <span class="badge badge-danger">Penuh</span>
                        <?php else: ?>
                           <form action="/krs/create" method="post">
                              <input type="hidden" name="id_jadwal" value="<?= $jm['id_jadwal']; ?>">
                              <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                           </form>
                        <?php endif; ?>
                        <!-- <a href="<?= base_url('/mahasiswa/krs/create/' . $jm['id_jadwal']); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a> -->
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

<!-- Content Row -->
<?= $this->endSection(); ?>