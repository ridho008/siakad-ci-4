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
          <label for="jenjang">Jenjang</label>
          <select name="jenjang" id="jenjang" class="form-control<?= ($validation->hasError('jenjang')) ? ' is-invalid' : '' ?>">
            <option value="">-- Pilih Jenjang --</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
          </select>
          <div class="invalid-feedback">
            <?= $validation->getError('prodi'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="ka_prodi">Ketua Prodi</label>
          <select name="ka_prodi" id="ka_prodi" class="form-control<?= ($validation->hasError('ka_prodi')) ? ' is-invalid' : '' ?>">
            <option value="">-- Pilih Ketua Prodi --</option>
            <?php foreach($dosen as $d) : ?>
              <option value="<?= $d['nama_dosen']; ?>"><?= $d['nama_dosen']; ?></option>
            <?php endforeach; ?>
          </select>
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