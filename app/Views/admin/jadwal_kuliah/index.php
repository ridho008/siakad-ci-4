<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?> Tahun Akademik <?= $tahunAkademik['tahun_aka']; ?> \ <?= $tahunAkademik['semester']; ?></h1>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6 mb-3">
               <form action="/gedung" method="post">
                  <div class="input-group mt-3">
                    <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="cari..." name="keyword">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                    </div>
                  </div>
               </form>
               <?php if($validation->listErrors()) : ?>
               <div class="alert alert-danger" role="alert">
                  <?= $validation->listErrors(); ?>
               </div>
               <?php endif; ?>
               <?php if(session()->getFlashdata('success')) : ?>
               <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
               <?php endif; ?>
            </div>
         </div>
         <div class="card shadow mb-4">
            <div class="card-header">
               <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Fakultas</th>
                           <th>Kode Prodi</th>
                           <th>Program Studi</th>
                           <th>Jenjang</th>
                           <th>Jadwal</th>
                        </tr>
                     </thead>
                     <tbody>
                       <?php $no = 1; foreach($prodi as $p) : ?>
                       <tr>
                         <td><?= $no++; ?></td>
                         <td><?= $p['fakultas']; ?></td>
                         <td><?= $p['kode_prodi']; ?></td>
                         <td><?= $p['prodi']; ?></td>
                         <td><?= $p['jenjang']; ?></td>
                         <td>
                           <a href="/jadwalKuliah/detail/<?= $p['id_prodi']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-calendar"></i></a>
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
</div>



<!-- Modal Ubah -->

<?= $this->endSection(); ?>