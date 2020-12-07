<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 mb-3">
					<a href="/ruangan/create" class="btn btn-primary">Tambah Data Ruangan</a>
					<form action="/gedung" method="post">
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
					<h6 class="m-0 font-weight-bold text-primary">Data Gedung</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Gedung</th>
									<th>Ruangan</th>
									<th><i class="fas fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach($ruangan as $r) : ?>
                  <tr>
                  	<td><?= $no++; ?></td>
                  	<td><?= $r['gedung']; ?></td>
                  	<td><?= $r['ruangan']; ?></td>
                  	<td>
                  		<a href="/ruangan/edit/<?= $r['id_ruangan']; ?>" class="btn btn-info">Edit</a>
                  		<form action="/ruangan/destroy/<?= $r['id_ruangan']; ?>">
                  			<?= csrf_field(); ?>
                  			<input type="hidden" name="_method" value="DELETE">
                  			<button type="submit" class="btn btn-danger" onclick="return confirm('Hapus <?= $r['ruangan']; ?>')">Hapus</button>
                  		</form>
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
<?= $this->endSection(); ?>