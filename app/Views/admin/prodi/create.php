<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
	<div class="row">
		<div class="col-md-12">
      <form action="/prodi/save" method="post">
      	<?= csrf_field(); ?>
      	<div class="form-group">
      		<label for="id_fakultas">Nama Fakultas</label>
      		<select name="id_fakultas" id="id_fakultas" class="form-control<?= ($validation->hasError('id_fakultas')) ? ' is-invalid' : '' ?>">
      			<option value="">-- Pilih Fakultas --</option>
      			<?php foreach($fakultas as $f) : ?>
      				<option value="<?= $f['id_fakultas']; ?>"><?= $f['fakultas']; ?></option>
      			<?php endforeach; ?>
      		</select>
      		<div class="invalid-feedback">
      			<?= $validation->getError('id_fakultas'); ?>
      		</div>
      	</div>
      	<div class="form-group">
      		<label for="kode_prodi">Kode Prodi</label>
      		<input type="text" name="kode_prodi" id="kode_prodi" class="form-control<?= ($validation->hasError('kode_prodi')) ? ' is-invalid' : '' ?>" value="<?= old('kode_prodi') ?>">
      		<div class="invalid-feedback">
      			<?= $validation->getError('kode_prodi'); ?>
      		</div>
      	</div>
        <div class="form-group">
          <label for="prodi">Program Studi</label>
          <input type="text" name="prodi" id="prodi" class="form-control<?= ($validation->hasError('prodi')) ? ' is-invalid' : '' ?>" value="<?= old('prodi') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('prodi'); ?>
          </div>
        </div>
      	<div class="form-group">
      		<a href="/prodi" class="btn btn-secondary">Kembali</a>
      		<button type="submit" class="btn btn-primary">Tambah</button>
      	</div>
      </form>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>