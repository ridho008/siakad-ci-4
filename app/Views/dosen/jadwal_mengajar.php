<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?> Tahun <?= $tahunAktif['tahun_aka']; ?> / <?= $tahunAktif['semester']; ?></h1>

<div class="row">
   <div class="col-md-12">
      <div class="table-responsive">
         <table class="table table-bordered table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Prodi</th>
                  <th>Hari</th>
                  <th>Matkul</th>
                  <th>Kelas</th>
                  <th>Ruang</th>
                  <th>Dosen</th>
                  <th>SKS</th>
               </tr>
            </thead>
            <tbody>
               <?php $no = 1; foreach($jadwal as $j) : ?>
               <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $j['prodi']; ?></td>
                  <td><?= $j['hari']. '/' .$j['waktu']; ?></td>
                  <td><?= $j['matkul']; ?></td>
                  <td><?= $j['nama_kelas']. ' / ' .$j['tahun_aka']; ?></td>
                  <td><?= $j['ruangan']; ?></td>
                  <td><?= $j['nama_dosen']; ?></td>
                  <td><?= $j['sks']; ?></td>
               </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<?= $this->endSection(); ?>