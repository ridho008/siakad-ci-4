<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?> <?= $tahunAktif['tahun_aka']; ?> / <?= $tahunAktif['semester']; ?></h1>
<div class="row">
   <div class="col-md-12">
      <?php if(session()->getFlashdata('success')) : ?>
      <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
      <?php endif; ?>
      <div class="table-responsive">
         <table class="table table-bordered table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Hari</th>
                  <th>Matkul</th>
                  <th>Kelas</th>
                  <th>Ruang</th>
                  <th>Nilai</th>
               </tr>
            </thead>
            <tbody>
               <?php $no = 1; foreach($absen as $j) : ?>
               <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $j['hari']. '/' .$j['waktu']; ?></td>
                  <td><?= $j['matkul']; ?></td>
                  <td><?= $j['nama_kelas']. ' / ' .$j['tahun_aka']; ?></td>
                  <td><?= $j['ruangan']; ?></td>
                  <td>
                     <!-- <a href="/dosen/datanilai/<?= $j['id_jadwal']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-calendar"></i> Nilai</a> -->
                     <form action="/dosen/datanilai" method="post">
                        <input type="hidden" name="id_jadwal" value="<?= $j['id_jadwal']; ?>">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-calendar"></i> Nilai</button>
                     </form>
                  </td>
               </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>