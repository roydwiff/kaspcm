        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- DATA TABLE-->
            <section class="p-t-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-data__tool">
                                <h3 class="title-5 m-b-35">laporan data kas</h3>
                                <!-- <div class="table-data__tool-left">
									<a class="au-btn-filter">
											<i class="zmdi zmdi-filter"> from </i><input type="date"></a>
									<a class="au-btn-filter">
											<i class="zmdi zmdi-filter"> to </i><input type="date"></a>
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="top">
                                            <i class="zmdi zmdi-search"></i>cari</button>
                                </div> -->
                                <div class="table-data__tool-right">
                                    <a href="<?= base_url(); ?>kasp/lapkas2" class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="top">
                                        <i class="zmdi zmdi-print"></i>print</a>
                                </div>
                            </div>
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <?php if (isset($kas[0]->sumber)) : ?>
                                                <th>Unit</th>
                                            <?php endif; ?>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $saldo = 0; // Inisialisasi saldo
                                        $no = 1; // Inisialisasi nomor urut
                                        foreach ($kas as $item) {
                                            $jumlah = $item->jumlah;
                                            $is_debit = ($item->jenis == 'masuk'); // Jika jenis transaksi 'masuk', maka ini debit
                                            $saldo += $is_debit ? $jumlah : -$jumlah; // Tambah jika debit, kurangi jika kredit
                                        ?>
                                            <tr>
                                                <!-- Menampilkan idKas atau idKas1 -->
                                                <td><?= isset($item->idKas) ? $item->idKas : (isset($item->idKas1) ? $item->idKas1 : $no++); ?></td>
                                                <td><?= date('d-m-Y', strtotime($item->tanggal)); ?></td>
                                                <td><?= $item->keterangan; ?></td>

                                                <!-- Kolom Debit: Menampilkan jumlah jika jenis transaksi adalah 'masuk' -->
                                                <td>
                                                    <?= $item->jenis == 'masuk' ? 'Rp ' . rupiah($jumlah) : '-'; ?>
                                                </td>
                                                <!-- Kolom Kredit: Menampilkan jumlah jika jenis transaksi adalah 'keluar' -->
                                                <td>
                                                    <?= $item->jenis == 'keluar' ? 'Rp ' . rupiah($jumlah) : '-'; ?>
                                                </td>
                                                <!-- Menampilkan saldo yang dihitung -->
                                                <td>Rp <?= rupiah($saldo); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                    <tfoot>
                                        <?php
                                        $sum_masuk = 0;
                                        $sum_keluar = 0;
                                        foreach ($kas as $item) {
                                            if ($item->jenis == 'masuk') {
                                                $sum_masuk += $item->jumlah;
                                            } else {
                                                $sum_keluar += $item->jumlah;
                                            }
                                        }
                                        $total_saldo = $sum_masuk - $sum_keluar; // Menghitung total saldo
                                        ?>
                                        <tr>
                                            <th colspan="<?= isset($kas[0]->sumber) ? 5 : 4 ?>" scope="col">TOTAL SALDO</th>
                                            <th colspan="2">Rp <?= rupiah($total_saldo); ?></th>
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