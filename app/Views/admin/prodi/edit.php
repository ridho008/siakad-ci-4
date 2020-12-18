<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
	<div class="row">
		<div class="col-md-12">
      <form action="/prodi/update/<?= $prodi['id_prodi']; ?>" method="post">
      	<?= csrf_field(); ?>
        <input type="text" name="id_prodi" value="<?= $prodi['id_prodi']; ?>">
      	<div class="form-group">
      		<label for="id_fakultas">Nama Fakultas</label>
      		<select name="id_fakultas" id="id_fakultas" class="form-control<?= ($validation->hasError('id_fakultas')) ? ' is-invalid' : '' ?>">
      			<option value="">-- Pilih Fakultas --</option>
      			<?php foreach($fakultas as $f) : ?>
              <?php if($f['id_fakultas'] == $prodi['id_fakultas']) : ?>
      				<option value="<?= $f['id_fakultas']; ?>" selected><?= $f['fakultas']; ?></option>
              <?php else : ?>
                <option value="<?= $f['id_fakultas']; ?>"><?= $f['fakultas']; ?></option>
              <?php endif; ?>
      			<?php endforeach; ?>
      		</select>
      		<div class="invalid-feedback">
      			<?= $validation->getError('id_fakultas'); ?>
      		</div>
      	</div>
      	<div class="form-group">
      		<label for="kode_prodi">Kode Prodi</label>
      		<input type="text" name="kode_prodi" id="kode_prodi" class="form-control<?= ($validation->hasError('kode_prodi')) ? ' is-invalid' : '' ?>" value="<?= (old('kode_prodi')) ? old('kode_prodi') : $prodi['kode_prodi'] ?>">
      		<div class="invalid-feedback">
      			<?= $validation->getError('kode_prodi'); ?>
      		</div>
      	</div>
        <div class="form-group">
          <label for="prodi">Program Studi</label>
          <input type="text" name="prodi" id="prodi" class="form-control<?= ($validation->hasError('prodi')) ? ' is-invalid' : '' ?>" value="<?= (old('prodi')) ? old('prodi') : $prodi['prodi'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('prodi'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="jenjang">Jenjang</label>
          <select name="jenjang" id="jenjang" class="form-control<?= ($validation->hasError('jenjang')) ? ' is-invalid' : '' ?>">
            <option value="">-- Pilih Jenjang --</option>
            <option value="D3" <?php if($prodi['jenjang'] == 'D3'){echo "selected";} ?>>D3</option>
            <option value="S1" <?php if($prodi['jenjang'] == 'S1'){echo "selected";} ?>>S1</option>
            <option value="S2" <?php if($prodi['jenjang'] == 'S2'){echo "selected";} ?>>S2</option>
            <option value="S3" <?php if($prodi['jenjang'] == 'S3'){echo "selected";} ?>>S3</option>
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
              <?php if($prodi['ketua_prodi'] == $d['nama_dosen']) : ?>
              <option value="<?= $d['nama_dosen']; ?>" selected><?= $d['nama_dosen']; ?></option>
              <?php else: ?>
                <option value="<?= $d['nama_dosen']; ?>"><?= $d['nama_dosen']; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback">
            <?= $validation->getError('prodi'); ?>
          </div>
        </div>
      	<div class="form-group">
      		<a href="/prodi" class="btn btn-secondary">Kembali</a>
      		<button type="submit" class="btn btn-primary">Edit</button>
      	</div>
      </form>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>