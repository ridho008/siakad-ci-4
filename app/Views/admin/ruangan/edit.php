<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
	<div class="row">
		<div class="col-md-12">
      <form action="/ruangan/update/<?= $ruangan['id_ruangan']; ?>" method="post">
      	<?= csrf_field(); ?>
        <input type="text" name="id_ruangan" value="<?= $ruangan['id_ruangan']; ?>">
      	<div class="form-group">
      		<label for="gedung">Nama Gedung</label>
      		<select name="gedung" id="gedung" class="form-control<?= ($validation->hasError('gedung')) ? ' is-invalid' : '' ?>">
      			<option value="">-- Pilih Gedung --</option>
      			<?php foreach($gedung as $g) : ?>
      				<?php if($g['id_gedung'] == $ruangan['id_gedung']) : ?>
      				<option value="<?= $g['id_gedung']; ?>" selected>Gedung <?= $g['gedung']; ?></option>
      				<?php else : ?>
      					<option value="<?= $g['id_gedung']; ?>">Gedung <?= $g['gedung']; ?></option>
      				<?php endif; ?>
      			<?php endforeach; ?>
      		</select>
      		<div class="invalid-feedback">
      			<?= $validation->getError('gedung'); ?>
      		</div>
      	</div>
      	<div class="form-group">
      		<label for="ruangan">Nama Ruangan</label>
      		<input type="text" name="ruangan" id="ruangan" class="form-control<?= ($validation->hasError('ruangan')) ? ' is-invalid' : '' ?>" value="<?= (old('ruangan')) ? old('ruangan') : $ruangan['ruangan'] ?>">
      		<div class="invalid-feedback">
      			<?= $validation->getError('ruangan'); ?>
      		</div>
      	</div>
      	<div class="form-group">
      		<a href="/ruangan" class="btn btn-secondary">Kembali</a>
      		<button type="submit" class="btn btn-primary">Edit</button>
      	</div>
      </form>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>