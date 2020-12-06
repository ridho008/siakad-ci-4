<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 mb-3">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModalFakultas">Tambah Data Fakultas</button>
					<form action="/fakultas" method="post">
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
					<h6 class="m-0 font-weight-bold text-primary">Data Fakultas</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Fakultas</th>
									<th><i class="fas fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1 + (2 * ($currentPage - 1)); foreach($fakultas as $f) : ?>
                  <tr>
                  	<td><?= $no++; ?></td>
                  	<td><?= $f['fakultas']; ?></td>
                  	<td>
                  		<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#formModalFakultas<?= $f['id_fakultas']; ?>">Edit</button>
                  		<form action="/fakultas/delete/<?= $f['id_fakultas']; ?>">
                  			<?= csrf_field(); ?>
                  			<input type="hidden" name="_method" value="DELETE">
	                  		<button type="submit" onclick="return confirm('Hapus <?= $f['fakultas'] ?>?')" class="btn btn-danger">Hapus</button>
                  		</form>
                  	</td>
                  </tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?= $pager->links('fakultas', 'fakultas_pagination'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Tambah -->
<div class="modal fade" id="formModalFakultas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Fakultas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/fakultas/save" method="post">
        	<?= csrf_field(); ?>
        	<div class="form-group">
        		<label for="fakultas">Nama Fakultas</label>
        		<input type="text" name="fakultas" id="fakultas" class="form-control<?= ($validation->hasError('fakultas')) ? ' is-invalid' : '' ?>">
        		<div class="invalid-feedback">
        			<?= $validation->getError('fakultas'); ?>
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
<?php $no = 1; foreach($fakultas as $f) : ?>
<div class="modal fade" id="formModalFakultas<?= $f['id_fakultas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Fakultas <?= $f['fakultas']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/fakultas/update/<?= $f['id_fakultas']; ?>" method="post">
        	<?= csrf_field(); ?>
        	<input type="hidden" name="id_fakultas" value="<?= $f['id_fakultas']; ?>">
        	<div class="form-group">
        		<label for="fakultas">Nama Fakultas</label>
        		<input type="text" name="fakultas" id="fakultas" class="form-control<?= ($validation->hasError('fakultas')) ? ' is-invalid' : '' ?>" value="<?= (old('fakultas')) ? old('fakultas') : $f['fakultas']; ?>">
        		<div class="invalid-feedback">
        			<?= $validation->getError('fakultas'); ?>
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