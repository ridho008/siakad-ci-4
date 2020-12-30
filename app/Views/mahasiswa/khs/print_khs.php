<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h3 class="text-center">Kartu Rencana Studi</h3>
    <div class="row">
      <div class="col-md-4">
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
      <div class="col-md-4">
        <table class="table">
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
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
         <tr>
           <th>Tanggal</th>
           <th>:</th>
           <th><?= date('d-m-Y'); ?></th>
         </tr>
      </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
            <div class="table-responsive">
               <table class="table table-striped table-bordered">
                  <tr>
                     <th>No</th>
                     <th>Kode</th>
                     <th>Matkul</th>
                     <th>SKS</th>
                     <th>SMT</th>
                     <th>Nilai</th>
                     <th>Bobot</th>
                  </tr>
                  <?php $grand_tot_bo = 0; $sks = 0; $no = 1; foreach($matkulMhs as $mm) : ?>
                  <?php $sks += $mm['sks']; ?>
                  <?php 
                  $totalBobot = $mm['sks'] * $mm['bobot'];
                  $grand_tot_bo += $totalBobot;
                  ?>
                     <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $mm['kode_matkul']; ?></td>
                        <td><?= $mm['matkul']; ?></td>
                        <td><?= $mm['sks']; ?></td>
                        <td><?= $mm['smt']; ?></td>
                        <td><?= $mm['nilai_huruf']; ?></td>
                        <td><?= $mm['bobot']; ?></td>
                     </tr>
                  <?php endforeach; ?>
               </table>
               <h6>Jumlah SKS : <?= $sks; ?></h6>
               <h6>IP : 
                  <?php if(empty($matkulMhs)) : ?>
                     <?php echo "0"; ?>
                     <?php else: ?>
                        <?= number_format($grand_tot_bo / $sks, 2); ?>
                  <?php endif; ?>
                  </h6>
            </div>
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
          <p><?= $mhs['nama_dosen']; ?></p>
        </td>
      </tr>
    </table>
  </div>

<script>
  window.print();
</script>
</body>
</html>