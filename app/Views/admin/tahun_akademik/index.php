<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 mb-3">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalTahun">Tambah Data Tahun Akademik</button>
					<form action="/tahunAka/index" method="post">
						<div class="input-group mt-3">
						  <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="cari..." name="keyword">
						  <div class="input-group-append">
						    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
						  </div>
						</div>
					</form>
					<?php if(session()->getFlashdata('success')) : ?>
					<div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header">
					<h6 class="m-0 font-weight-bold text-primary">Data Tahun Akademik</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tahun</th>
									<th>Semester</th>
									<th><i class="fas fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1 + (2 * ($currentPage - 1)); foreach($tahun as $t) : ?>
                  <tr>
                  	<td><?= $no++; ?></td>
                  	<td><?= $t['tahun_aka']; ?></td>
                  	<td><?= $t['semester']; ?></td>
                  	<td>
                  		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formModalTahun<?= $t['id_ta']; ?>">Edit</button>
                  		<form action="/tahunAka/destroy/<?= $t['id_ta']; ?>" method="post">
                  			<?= csrf_field(); ?>
                  			<input type="hidden" name="_method" value="DELETE">
                  			<button type="submit" class="btn btn-danger" onclick="return confirm('Hapus <?= $t['tahun_aka']; ?>')">Hapus</button>
                  		</form>
                  	</td>
                  </tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?= $pager->links('tahun_akademik', 'tahunaka_pagination'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="formModalTahun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Akademik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/tahunAka/save" method="post">
        	<?= csrf_field(); ?>
        	<div class="form-group">
        		<label for="tahun">Tahun</label>
        		<select name="tahun" id="tahun" class="form-control<?= ($validation->hasError('tahun')) ? ' is-invalid' : '' ?>">
        			<option value="">-- Pilih Tahun --</option>
        			<?php for($i = 2018; $i <= date('Y'); $i++ ) : ?>
        				<option value="<?= $i; ?>"><?= $i; ?></option>
        			<?php endfor; ?>
        		</select>
        		<div class="invalid-feedback">
        			<?= $validation->getError('tahun'); ?>
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="semester">Semester</label>
        		<select name="semester" id="semester" class="form-control<?= ($validation->hasError('semester')) ? ' is-invalid' : '' ?>">
        			<option value="">-- Pilih Semester --</option>
        			<option value="Ganjil">Ganjil</option>
        			<option value="Genap">Genap</option>
        		</select>
        		<div class="invalid-feedback">
        			<?= $validation->getError('semester'); ?>
        		</div>
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

<!-- Modal Edit -->
<?php foreach($tahun as $t) : ?>
<div class="modal fade" id="formModalTahun<?= $t['id_ta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Tahun Akademik <?= $t['tahun_aka'] . '/' . $t['semester']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/tahunAka/update/<?= $t['id_ta']; ?>" method="post">
        	<?= csrf_field(); ?>
        	<input type="hidden" name="id_ta" value="<?= $t['id_ta']; ?>">
        	<div class="form-group">
        		<label for="tahun">Tahun</label>
        		<select name="tahun" id="tahun" class="form-control<?= ($validation->hasError('tahun')) ? ' is-invalid' : '' ?>">
        			<option value="">-- Pilih Tahun --</option>
        			<?php for($i = 2018; $i <= date('Y'); $i++ ) : ?>
        				<?php if($i == $t['tahun_aka']) : ?>
        				<option value="<?= $i; ?>" selected><?= $i; ?></option>
        				<?php else : ?>
        					<option value="<?= $i; ?>" selected><?= $i; ?></option>
        				<?php endif; ?>
        			<?php endfor; ?>
        		</select>
        		<div class="invalid-feedback">
        			<?= $validation->getError('tahun'); ?>
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="semester">Semester</label>
        		<select name="semester" id="semester" class="form-control<?= ($validation->hasError('semester')) ? ' is-invalid' : '' ?>">
        			<option value="">-- Pilih Semester --</option>
        			<option value="Ganjil" <?= ($t['semester'] == 'Ganjil') ? 'selected' : '' ?>>Ganjil</option>
        			<option value="Genap" <?= ($t['semester'] == 'Genap') ? 'selected' : '' ?>>Genap</option>
        		</select>
        		<div class="invalid-feedback">
        			<?= $validation->getError('semester'); ?>
        		</div>
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
<?php endforeach; ?>
<?= $this->endSection(); ?>