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
        							<button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addKasKeluarModal">
        								<i class="zmdi zmdi-plus"></i>Pengeluaran</button>
        						</div>
        					</div>
        					<!-- DATA TABLE-->
        					<div class="table-responsive m-b-40">
        						<table class="table table-borderless table-data3">
        							<thead>
        								<tr>
        									<th>nomor</th>
        									<th>keterangan</th>
        									<th>tanggal</th>
        									<th>jumlah</th>
        									<th>aksi</th>
        								</tr>
        							</thead>
        							<tbody>
        								<?php foreach ($keluar as $kel) { ?>
        									<tr>
        										<td><?= $kel->idKas; ?></td>
        										<td><?= $kel->keterangan; ?></td>
        										<td><?= date('d-m-Y', strtotime($kel->tanggal)); ?></td>
        										<td class="process">Rp <?= rupiah($kel->jumlah); ?></td>
        										<td>
        											<div class="table-data-feature">
        												<button class="item" data-toggle="modal" data-target="#editKasModal<?= $kel->idKas; ?> " data-placement="top" title="Edit">
        													<i class="zmdi zmdi-edit"></i>
        												</button>
        												<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
        													<a href="#!" onclick="deleteConfirm('<?= base_url('kasp/delkas/' . $kel->idKas); ?>')">
        														<i class="zmdi zmdi-delete" style="color:red"></i>
        												</button>
        											</div>
        										</td>
        									</tr>
        								<?php } ?>
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

        	<!-- modal addKasKeluar -->
        	<div class="modal fade" id="addKasKeluarModal" tabindex="-1" role="dialog" aria-labelledby="addKasKeluarModal" aria-hidden="true">
        		<div class="modal-dialog modal-dialog-centered" role="document">
        			<div class="modal-content">
        				<div class="modal-header">
        					<h4 class="modal-title" id="addKasKeluarModal">Tambah Kas Keluar</h4>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				</div>
        				<div class="modal-body">
        					<div class="login-form">
        						<form action="<?= base_url('kasRT/addKas'); ?>" method="post">
        							<div class="form-group">
        								<label>Nomor</label>
        								<input class="form-control" type="text" name="id_kas" id="id_kas" value="3000<?= sprintf("%04s", $idKas); ?>" readonly>
        							</div>
        							<div class="form-group">
        								<label>Keterangan</label>
        								<textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?= set_value('keterangan'); ?>" required></textarea>
        							</div>
        							<div class="form-group">
        								<label>Tanggal</label>
        								<input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= set_value('tanggal'); ?>" required>
        							</div>
        							<div class="form-group">
        								<label>Jumlah</label>
        								<input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="Jumlah Kas Keluar" value="<?= set_value('jumlah'); ?>" required>
        							</div>
        							<div class="form-group" hidden>
        								<label>Jenis</label>
        								<input class="form-control" type="text" name="jenis" id="jenis" value="keluar" required>
        							</div>
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
        	<!-- end modal addKasKeluar -->

        	<!-- modal editKasModal -->
        	<?php $no = 0;
			foreach ($keluar as $val): $no++; ?>
        		<div class="modal fade" id="editKasModal<?= $val->idKas; ?>" tabindex="-1" role="dialog" aria-labelledby="editKasModal" aria-hidden="true">
        			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h4 class="modal-title" id="editKasModal">Edit Kas Keluar</h4>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					</div>
        					<div class="modal-body">
        						<div class="login-form">
        							<?= form_open_multipart('kasp/editkas'); ?>
        							<input type="hidden" name="idKas" id="idKas" value="<?= $val->idKas; ?>">
        							<div class="form-group">
        								<label>Keterangan</label>
        								<textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required><?= $val->keterangan; ?></textarea>
        							</div>
        							<div class="form-group">
        								<label>Tanggal</label>
        								<input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= $val->tanggal; ?>">
        							</div>
        							<div class="form-group">
        								<label>Jumlah</label>
        								<input class="form-control" type="number" name="jumlah" id="jumlah" value="<?= $val->jumlah; ?>">
        							</div>
        							<div class="form-group" hidden>
        								<label>Jenis</label>
        								<input class="form-control" type="text" name="jenis" id="jenis" value="<?= $val->jenis; ?>" readonly>
        							</div>

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
        	<?php endforeach; ?>
        	<!-- end modal editKasModal -->