<!-- PAGE CONTENT -->
<div class="page-content--bgf7">
	<!-- DATA TABLE -->
	<section class="p-t-60">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="table-data__tool">
						<div class="table-data__tool-left">
							<h3 class="title-5 m-b-35">Data Kas Masuk Seluruh Unit</h3>
						</div>
						<div class="table-data__tool-right">

							<!-- Tombol tampilan Bendahara -->
							<a href="<?= base_url('kasp/index/3'); ?>" class="au-btn au-btn-icon au-btn--blue au-btn--small m-l-5" title="Lihat Tampilan Bendahara">
								<i class="zmdi zmdi-eye"></i> DETAIL UNIT 1
							</a>

							<!-- Tombol tampilan Unit2 -->
							<a href="<?= base_url('kasp/index/5'); ?>" class="au-btn au-btn-icon au-btn--blue au-btn--small m-l-5" title="Lihat Tampilan Unit2">
								<i class="zmdi zmdi-eye"></i> DETAIL UNIT 2
							</a>
						</div>
					</div>

					<!-- DATA TABLE -->
					<div class="table-responsive m-b-40">
						<table class="table table-borderless table-data3">
							<thead>
								<tr>
									<th>Nomor</th>
									<th>Keterangan</th>
									<th>Tanggal</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($masuk as $msk):
									$id = isset($msk->idKas) ? $msk->idKas : $msk->idKas1;
								?>
									<tr>
										<td><?= $id; ?></td>
										<td><?= $msk->keterangan; ?></td>
										<td><?= date('d-m-Y', strtotime($msk->tanggal)); ?></td>
										<td class="process">Rp <?= rupiah($msk->jumlah); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="3">TOTAL <small>(Pengeluaran)</small></th>
									<th>Rp <?= rupiah($ttl); ?></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- END DATA TABLE -->
				</div>
			</div>
		</div>
	</section>
	<!-- END DATA TABLE -->

	<!-- modal addKasMasuk -->
	<div class="modal fade" id="addKasMasukModal" tabindex="-1" role="dialog" aria-labelledby="addKasMasukModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="addKasMasukModal">Tambah Kas Masuk</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="login-form">
						<form action="<?= base_url('kasP/addKas'); ?>" method="post">
							<div class="form-group">
								<label>Nomor</label>
								<input class="form-control" type="text" name="id_kas" value="3000<?= sprintf('%04s', $idKas); ?>" readonly>
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control" name="keterangan" placeholder="Keterangan" required><?= set_value('keterangan'); ?></textarea>
							</div>
							<div class="form-group">
								<label>Tanggal</label>
								<input class="form-control" type="date" name="tanggal" value="<?= set_value('tanggal'); ?>" required>
							</div>
							<div class="form-group">
								<label>Jumlah</label>
								<input class="form-control" type="number" name="jumlah" placeholder="Jumlah Kas Masuk" value="<?= set_value('jumlah'); ?>" required>
							</div>
							<input type="hidden" name="jenis" value="masuk">
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary">Confirm</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal addKasMasuk -->
</div>