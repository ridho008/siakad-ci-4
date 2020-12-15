<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 mb-3">
					<?php if(session()->getFlashdata('success')) : ?>
					<div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header">
					<h6 class="m-0 font-weight-bold text-primary">Data <?= $title; ?></h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tahun</th>
									<th>Semester</th>
                  <th>Status</th>
									<th><i class="fas fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach($tahun as $t) : ?>
                  <tr>
                  	<td><?= $no++; ?></td>
                  	<td><?= $t['tahun_aka']; ?></td>
                  	<td><?= $t['semester']; ?></td>
                    <td>
                      <?php if($t['status'] == null || 0) : ?>
                        <small class="badge badge-warning">Nonaktif</small>
                        <?php else : ?>
                          <small class="badge badge-success">Aktif</small>
                      <?php endif; ?>
                    </td>
                  	<td>
                      <?php if($t['status'] == null || 0) : ?>
                     <a href="/tahunAka/active/<?= $t['id_ta']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Aktifkan</a>
                     <?php else : ?>
                      <small class="badge badge-success">Sedang Aktif</small>
                      <?php endif; ?>
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