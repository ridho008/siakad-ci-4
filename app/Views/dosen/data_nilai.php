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
            <tr>
               <?php $no = 1; foreach($mhs as $mm) : ?>
                  <td><?= $no++; ?></td>
                  <td><?= $mm['nim']; ?></td>
                  <td><?= $mm['nama_mhs']; ?></td>
                  <td></td>
                  <td>
                     <input type="number" name="tugas" class="form-control">
                  </td>
                  <td>
                     <input type="number" name="uts" class="form-control">
                  </td>
                  <td>
                     <input type="number" name="uas" class="form-control">
                  </td>
               <?php endforeach; ?>
            </tr>
         </table>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>