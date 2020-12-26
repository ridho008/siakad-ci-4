<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title . ' | ' .$tahunAka['tahun_aka']. ' ' . $tahunAka['semester']; ?></h1>
<!-- Content Row -->
    <div class="row">
       <div class="col-md-12">
          <div class="table-responsive">
             <table class="table table-bordered">
                <tr class="table-primary">
                   <th rowspan="2">No</th>
                   <th rowspan="2">Kode</th>
                   <th rowspan="2">Mata Kuliah</th>
                   <th colspan="18">Pertemuan</th>
                   <th rowspan="2">%</th>
                </tr>
                <tr class="table-primary">
                   <?php for($i = 1; $i <= 18; $i++) : ?>
                    <td><?= $i; ?></td>
                   <?php endfor; ?>
                </tr>
                <?php $sks = 0; $no = 1; foreach($matkulMhs as $mm) : ?>
                <?php $sks += $mm['sks']; ?>
                   <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $mm['kode_matkul']; ?></td>
                      <td><?= $mm['matkul']; ?></td>
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
             <h6>Jumlah SKS : <?= $sks; ?></h6>
          </div>
       </div>
    </div>

          <!-- Content Row -->
<?= $this->endSection(); ?>