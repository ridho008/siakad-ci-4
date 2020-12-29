<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?> / <?= $tahunAktif['semester']; ?></h1>
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
          <form action="/dosen/print/" method="post" target="_blank">
            <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal']; ?>">
            <button type="submit" target="_blank" class="btn btn-secondary mb-1">Cetak Absensi</button>
          </form>
        </div>
      </div>
      <div class="table-responsive">
         <table class="table table-bordered">
            <tr class="table-primary">
               <th rowspan="2">No</th>
               <th rowspan="2">NIM</th>
               <th rowspan="2">Mahasiswa</th>
               <th colspan="18">Pertemuan</th>
               <th rowspan="2">%</th>
            </tr>
            <tr class="table-primary">
               <?php for($i = 1; $i <= 18; $i++) : ?>
                <td><?= $i; ?></td>
               <?php endfor; ?>
            </tr>
            <?php $no = 1; foreach($mhs as $mm) : ?>
               <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $mm['nim']; ?></td>
                  <td><?= $mm['nama_mhs']; ?></td>
                  <td>
                     <?php if($mm['p1'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p1'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p1'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p2'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p2'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p2'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p3'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p3'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p3'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p4'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p4'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p4'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p5'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p5'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p5'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p6'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p6'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p6'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p7'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p7'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p7'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p8'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p8'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p8'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p9'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p9'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p9'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p10'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p10'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p10'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p11'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p11'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p11'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p12'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p12'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p12'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p13'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p13'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p13'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p14'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p14'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p14'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p15'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p15'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p15'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p16'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p16'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p16'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p17'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p17'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p17'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($mm['p18'] == null) : ?>
                      <i class="fas fa-times text-danger"></i>
                      <?php elseif($mm['p18'] == 1) : ?>
                       <i class="fas fa-info text-warning"></i>
                       <?php elseif($mm['p18'] == 2) : ?>
                          <i class="fas fa-check text-success"></i>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php 
                     $absensi = ($mm['p1'] + $mm['p2'] + $mm['p3'] + $mm['p4'] + $mm['p5'] + $mm['p6'] + $mm['p7'] + $mm['p8'] + $mm['p9'] + $mm['p10'] + $mm['p11'] + $mm['p12'] + $mm['p13'] + $mm['p14'] + $mm['p15'] + $mm['p16'] + $mm['p17'] + $mm['p18']) / 36 * 100;
                     ?>
                     <?= number_format($absensi, 0); ?> %
                  </td>
               </tr>
            <?php endforeach; ?>
         </table>
      </div>
   </div>
</div>

<div class="modal fade" id="formModalAbsensi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Isi <?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dosen/saveabsen" method="post">
         <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal']; ?>">
         <?= csrf_field(); ?>
         <div class="table-responsive">
            <table class="table table-bordered text-sm-center">
               <tr class="table-primary">
                  <th rowspan="2">No</th>
                  <th rowspan="2">NIM</th>
                  <th rowspan="2">Mahasiswa</th>
                  <th colspan="18">Pertemuan</th>
               </tr>
               <tr class="table-primary">
                  <?php for($i = 1; $i <= 18; $i++) : ?>
                   <td><?= $i; ?></td>
                  <?php endfor; ?>
               </tr>
               <?php $no = 1; foreach($mhs as $mm) : ?>
               <input type="hidden" name="id_krs<?= $mm['id_krs']; ?>" value="<?= $mm['id_krs']; ?>">
                  <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $mm['nim']; ?></td>
                     <td><?= $mm['nama_mhs']; ?></td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p1">
                           <option value="0" <?= ($mm['p1'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p1'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p1'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p2">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p2'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p2'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p2'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p3">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p3'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p3'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p3'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p4">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p4'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p4'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p4'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p5">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p5'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p5'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p5'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p6">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p6'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p6'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p6'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p7">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p7'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p7'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p7'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p8">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p8'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p8'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p8'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p9">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p9'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p9'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p9'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p10">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p10'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p10'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p10'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p11">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p11'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p11'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p11'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p12">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p12'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p12'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p12'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p13">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p13'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p13'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p13'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p14">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p14'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p14'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p14'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p15">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p15'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p15'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p15'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p16">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p16'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p16'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p16'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p17">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p17'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p17'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p17'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                     <td>
                        <select name="<?= $mm['id_krs']; ?>p18">
                           <option value=""></option>
                           <option value="0" <?= ($mm['p18'] == 0) ? 'selected' : ''  ?>>A</option>
                           <option value="1" <?= ($mm['p18'] == 1) ? 'selected' : ''  ?>>I</option>
                           <option value="2" <?= ($mm['p18'] == 2) ? 'selected' : ''  ?>>H</option>
                        </select>
                     </td>
                  </tr>
               <?php endforeach; ?>
            </table>
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