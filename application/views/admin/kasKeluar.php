<!-- PAGE CONTENT-->
<div class="page-content--bgf7">
	<!-- DATA TABLE-->
	<section class="p-t-60">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="table-data__tool">
						<div class="table-data__tool-left">
							<h3 class="title-5 m-b-35">data kas keluar</h3>
						</div>
						<div class="table-data__tool-right">
							<!-- Tombol tambah pengeluaran -->

							<!-- Tombol tampilan Bendahara -->
							<a href="<?= base_url('kasp/kasKeluar/3'); ?>" class="au-btn au-btn-icon au-btn--blue au-btn--small m-l-5" title="Lihat Tampilan Bendahara">
								<i class="zmdi zmdi-eye"></i> DETAIL UNIT 1
							</a>

							<!-- Tombol tampilan Unit2 -->
							<a href="<?= base_url('kasp/kasKeluar/5'); ?>" class="au-btn au-btn-icon au-btn--blue au-btn--small m-l-5" title="Lihat Tampilan Unit2">
								<i class="zmdi zmdi-eye"></i> DETAIL UNIT 2
							</a>
						</div>

					</div>

					<!-- DATA TABLE-->
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
								<?php foreach ($keluar as $kel):
									$id = isset($kel->idKas) ? $kel->idKas : $kel->idKas1;
								?>
									<tr>
										<td><?= $id; ?></td>
										<td><?= $kel->keterangan; ?></td>
										<td><?= date('d-m-Y', strtotime($kel->tanggal)); ?></td>
										<td class="process">Rp <?= rupiah($kel->jumlah); ?></td>
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
					<!-- END DATA TABLE-->
				</div>
			</div>
		</div>
	</section>
	<!-- END DATA TABLE-->


	<!-- end modal editKasModal -->