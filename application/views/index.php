        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- WELCOME-->
            <section class="welcome p-t-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Selamat datang
                                <span><?= $user['username']; ?>!</span>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->
            <!-- STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--green">

                                <h2 class="number">Rp <?= rupiah($masuk); ?></h2>
                                <span class="desc"><strong>Kas Masuk</strong></span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">Rp <?= rupiah($keluar); ?></h2>
                                <span class="desc"><strong>Kas Keluar</strong></span>
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--blue">
                                <?php
                                $saldo = $masuk - $keluar;
                                ?>
                                <h2 class="number">Rp <?= rupiah($saldo); ?></h2>
                                <span class="desc"><strong>Saldo Kas</strong></span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->