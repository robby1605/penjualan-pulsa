        <h4>Data Pulsa</h4>
        <br />
        <?php if (isset($_GET['success-stok'])) { ?>
            <div class="alert alert-success">
                <p>Tambah Stok Berhasil !</p>
            </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success">
                <p>Tambah Data Berhasil !</p>
            </div>
        <?php } ?>
        <?php if (isset($_GET['remove'])) { ?>
            <div class="alert alert-danger">
                <p>Hapus Data Berhasil !</p>
            </div>
        <?php } ?>

        <?php
        $sql = " SELECT saldo FROM saldo";
        $row = $config->prepare($sql);
        $row->execute();
        $r = $row->fetch();
        // var_dump($r[0]);
        if ($r[0] < 50000) {
        ?>
        <?php
            echo "
		<div class='alert alert-warning'>
			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r[0]</span> saldo yang tersisa sudah kurang dari Rp. 50.000 silahkan isi saldo lagi !!
			<span class='pull-right'><a href='index.php?page=saldo&saldo=yes'>Tabel saldo <i class='fa fa-angle-double-right'></i></a></span>
		</div>
		";
        }
        ?>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Insert Data</button>
        <!-- <a href="index.php?page=barang&stok=yes" class="btn btn-warning btn-md mr-2">
            <i class="fa fa-list"></i> Sortir Stok Kurang</a> -->
        <a href="index.php?page=pulsa" class="btn btn-success btn-md">
            <i class="fa fa-refresh"></i> Refresh Data</a>
        <div class="clearfix"></div>
        <br />
        <!-- view barang -->
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="example1">
                    <thead>
                        <tr style="background:#DFF0D8;color:#333;">
                            <th>No.</th>
                            <th>ID Pulsa</th>
                            <th>Seluler</th>
                            <th>Pulsa</th>
                            <th>Profit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalBeli = 0;
                        $totalJual = 0;
                        $totalStok = 0;
                        if ($_GET['stok'] == 'yes') {
                            $hasil = $lihat->barang_stok();
                        } else {
                            $hasil = $lihat->pulsa();
                        }
                        $no = 1;
                        foreach ($hasil as $isi) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $isi['id_pulsa']; ?></td>
                                <td><?php echo $isi['nama_operator']; ?></td>
                                <td>Rp.<?php echo number_format($isi['pulsa_berapa']); ?></td>
                                <td>Rp.<?php echo number_format($isi['profit']); ?>,-</td>

                                <td>
                                    <a href="index.php?page=pulsa/details&pulsa=<?php echo $isi['id_pulsa']; ?>"><button class="btn btn-primary btn-xs">Details</button></a>

                                    <a href="index.php?page=pulsa/edit&pulsa=<?php echo $isi['id_pulsa']; ?>"><button class="btn btn-warning btn-xs">Edit</button></a>
                                    <a href="fungsi/hapus/hapus.php?pulsa=hapus&id=<?php echo $isi['id_pulsa']; ?>" onclick="javascript:return confirm('Hapus Data barang ?');"><button class="btn btn-danger btn-xs">Hapus</button></a>
                                </td>

                            </tr>
                        <?php
                            $no++;
                            $totalpulsa += $isi['pulsa_berapa'];
                            $totalprofit += $isi['profit'];
                            $total += $isi['pulsa_berapa'] * $isi['profit'];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total </td>
                            <th>Rp.<?php echo number_format($totalpulsa); ?>,-</td>
                            <th>Rp.<?php echo number_format($totalprofit); ?>,-</td>
                            <th colspan="2" style="background:#ddd"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- end view barang -->
        <!-- tambah barang MODALS-->
        <!-- Modal -->

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#285c64;color:#fff;">
                        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="fungsi/tambah/tambah.php?pulsa=tambah" method="POST">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <?php
                                $format = $lihat->pulsa_id();
                                ?>
                                <tr>
                                    <td>ID Barang</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format; ?>" class="form-control" name="id"></td>
                                </tr>
                                <tr>
                                    <td>Seluler</td>
                                    <td>
                                        <select name="seluler" class="form-control" required>
                                            <option value="#">Pilih seluler</option>
                                            <?php $kat = $lihat->operator_seluler();
                                            foreach ($kat as $isi) {     ?>
                                                <option value="<?php echo $isi['id_operator']; ?>">
                                                    <?php echo $isi['nama_operator']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pulsa</td>
                                    <td><input type="number" placeholder="Pulsa Berapa" required class="form-control" name="nama"></td>
                                </tr>
                                <tr>
                                    <td>Harga jual</td>
                                    <td><input type="number" placeholder="Harga jual -> ex:2000" required class="form-control" name="jual"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Input</td>
                                    <td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("Y-m-d"); ?>" name="tgl"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                                Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>