<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="container">
    <h3 class="text-center">Kartu Rencana Studi</h3>
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
           </table>
        </div>
      </div>
      
      
    </div>
    <div class="row">
      <div class="col-md-12">
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
                  <td><?= $mm['nilai_tugas']; ?></td>
                  <td><?= $mm['nilai_uts']; ?></td>
                  <td><?= $mm['nilai_uas']; ?></td>
                  <td><?= $mm['nilai_akhir']; ?></td>
                  <td><?= $mm['nilai_huruf']; ?></td>
            </tr>
            <?php endforeach; ?>
         </table>
        </div>
      </div>
    </div>
    <table width="100%">
      <tr>
        <td></td>
        <td width="200">
          <p>Pekanbaru, Riau <?= date('d-m-Y'); ?></p>
          <br>
          Pembimbing, 
          <br><br><br>
          <p><?= $jadwal['nama_dosen']; ?></p>
        </td>
      </tr>
    </table>
  </div>

<script>
  window.print();
</script>
</body>
</html>