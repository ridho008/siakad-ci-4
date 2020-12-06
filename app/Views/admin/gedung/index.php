<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 mb-3">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalGedung">Tambah Data Gedung</button>
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
					<h6 class="m-0 font-weight-bold text-primary">Data Gedung</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Gedung</th>
									<th><i class="fas fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1 + (2 * ($currentPage - 1)); foreach($gedung as $f) : ?>
                  <tr>
                  	<td><?= $no++; ?></td>
                  	<td><?= $f['gedung']; ?></td>
                  	<td>
                  		<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#formModalGedung<?= $f['id_gedung']; ?>">Edit</button>
                  		<form action="/gedung/delete/<?= $f['id_gedung']; ?>">
                  			<?= csrf_field(); ?>
                  			<input type="hidden" name="_method" value="DELETE">
	                  		<button type="submit" onclick="return confirm('Hapus <?= $f['gedung'] ?>?')" class="btn btn-danger">Hapus</button>
                  		</form>
                  	</td>
                  </tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?= $pager->links('gedung', 'gedung_pagination'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Tambah -->
<div class="modal fade" id="formModalGedung" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Gedung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/gedung/save" method="post">
        	<?= csrf_field(); ?>
        	<div class="form-group">
        		<label for="gedung">Nama Gedung</label>
        		<input type="text" name="gedung" id="gedung" class="form-control<?= ($validation->hasError('gedung')) ? ' is-invalid' : '' ?>">
        		<div class="invalid-feedback">
        			<?= $validation->getError('gedung'); ?>
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

<!-- Modal Ubah -->
<?php foreach($gedung as $f) : ?>
<div class="modal fade" id="formModalGedung<?= $f['id_gedung']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Gedung <?= $f['gedung']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/gedung/update/<?= $f['id_gedung']; ?>" method="post">
        	<?= csrf_field(); ?>
        	<input type="hidden" name="id_gedung" value="<?= $f['id_gedung']; ?>">
        	<div class="form-group">
        		<label for="gedung">Nama Gedung</label>
        		<input type="text" name="gedung" id="gedung" class="form-control<?= ($validation->hasError('gedung')) ? ' is-invalid' : '' ?>" value="<?= (old('gedung')) ? old('gedung') : $f['gedung']; ?>">
        		<div class="invalid-feedback">
        			<?= $validation->getError('gedung'); ?>
        		</div>
        	</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Edit</button>
	      </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
<?= $this->endSection(); ?>