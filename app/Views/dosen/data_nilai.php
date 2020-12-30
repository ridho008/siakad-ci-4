<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="row">
   <div class="col-md-4">
      <div class="table-responsive">
         <table class="table table-striped">
            <tr>
               <th>Program Studi</th>
               <th>:</th>
               <th><?= $jadwal['prodi']; ?></th>
            </tr>
            <tr>
               <th>Fakultas</th>
               <th>:</th>
               <th><?= $jadwal['fakultas']; ?></th>
            </tr>
            <tr>
               <th>Kode</th>
               <th>:</th>
               <th><?= $jadwal['kode_matkul']; ?></th>
            </tr>
            <tr>
               <th>Matkul</th>
               <th>:</th>
               <th><?= $jadwal['matkul']; ?></th>
            </tr>
            <tr>
               <th>Jadwal</th>
               <th>:</th>
               <th><?= $jadwal['hari']. ' / ' .$jadwal['waktu']; ?></th>
            </tr>
            <tr>
               <th>Dosen PA</th>
               <th>:</th>
               <th><?= $jadwal['nama_dosen']; ?></th>
            </tr>
            <tr>
               <th>Tahun Ajaran</th>
               <th>:</th>
               <th><?= $tahunAktif['tahun_aka']; ?></th>
            </tr>
         </table>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalAbsensi">Isi Absensi</button>
          <form action="/dosen/printnilai/" method="post" target="_blank">
            <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal']; ?>">
            <button type="submit" target="_blank" class="btn btn-secondary mb-1">Cetak Absensi</button>
          </form>
        </div>
      </div>
      <div class="table-responsive">
         <form action="/dosen/simpannilai" method="post">
            <?= csrf_field(); ?>
         <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal']; ?>">
         <table class="table table-bordered text-sm-center">
            <tr class="table-primary">
               <th rowspan="2">No</th>
               <th rowspan="2">NIM</th>
               <th rowspan="2">Mahasiswa</th>
               <th colspan="6">Nilai</th>
            </tr>
            <tr class="table-primary">
               <th>Absensi (15%)</th>
               <th width="100">Tugas (15%)</th>
               <th width="100">UTS (30%)</th>
               <th width="100">UAS (40%)</th>
               <th>NA</th>
               <th>Huruf</th>
            </tr>
            <?php $no = 1; foreach($mhs as $mm) : ?>
            <?php 
            $absensi = ($mm['p1'] + $mm['p2'] + $mm['p3'] + $mm['p4'] + $mm['p5'] + $mm['p6'] + $mm['p7'] + $mm['p8'] + $mm['p9'] + $mm['p10'] + $mm['p11'] + $mm['p12'] + $mm['p13'] + $mm['p14'] + $mm['p15'] + $mm['p16'] + $mm['p17'] + $mm['p18']) / 36 * 100;
            ?>
            <input type="hidden" name="id_krs<?= $mm['id_krs']; ?>" value="<?= $mm['id_krs']; ?>">
            <input type="hidden" name="nilai_absen<?= $mm['id_krs']; ?>" value="<?= number_format($absensi,0); ?>">
            <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $mm['nim']; ?></td>
                  <td><?= $mm['nama_mhs']; ?></td>
                  <td><?= number_format($absensi,0); ?></td>
                  <td>
                     <input type="number" min="0" value="<?= $mm['nilai_tugas']; ?>" name="nilai_tugas<?= $mm['id_krs']; ?>" class="form-control">
                  </td>
                  <td>
                     <input type="number" min="0" value="<?= $mm['nilai_uts']; ?>" name="nilai_uts<?= $mm['id_krs']; ?>" class="form-control">
                  </td>
                  <td>
                     <input type="number" min="0" value="<?= $mm['nilai_uas']; ?>" name="nilai_uas<?= $mm['id_krs']; ?>" class="form-control">
                  </td>
                  <td><?= $mm['nilai_akhir']; ?></td>
                  <td><?= $mm['nilai_huruf']; ?></td>
            </tr>
            <?php endforeach; ?>
         </table>
         <button type="submi" class="btn btn-primary btn-sm">Simpan</button>
         </form>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>