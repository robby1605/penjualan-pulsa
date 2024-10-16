        <h4>Data Saldo</h4>
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
        // $sql = " select * from saldo";
        // $row = $config->prepare($sql);
        // $row->execute();
        // $r = $row->rowCount();
        // if ($r > 0) {
        //     echo "
        // 		<div class='alert alert-warning'>
        // 			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
        // 			<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Cek Barang <i class='fa fa-angle-double-right'></i></a></span>
        // 		</div>
        // 		";
        // }
        ?>
        <!-- Trigger the modal with a button -->
        <!-- <button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Insert Data</button> -->
        <!-- <a href="index.php?page=barang&stok=yes" class="btn btn-warning btn-md mr-2">
            <i class="fa fa-list"></i> Sortir Stok Kurang</a> -->
        <a href="index.php?page=saldo" class="btn btn-success btn-md">
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
                            <th>Saldo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalSaldo = 0;
                        $hasil = $lihat->saldo();
                        $no = 1;
                        foreach ($hasil as $isi) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td>Rp.
                                    <?php if ($isi['saldo'] == '0') { ?>
                                        <button class="btn btn-danger"> 0 Habis</button>
                                    <?php } else { ?>
                                        <?php echo number_format($isi['saldo']); ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <form method="POST" action="fungsi/edit/edit.php?stok=edit">
                                        <input type="text" name="tambah_saldo" class="form-control" required>
                                        <input type="hidden" name="id" value="<?php echo $isi['id_saldo']; ?>" class="form-control">
                                        <button class="btn btn-primary btn-sm">
                                            Tambah Saldo
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            $no++;
                            $totalSaldo += $isi['saldo'];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total </td>
                            <th>Rp.<?php echo number_format($totalSaldo); ?>,-</th>
                            <th></th>
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
                    <form action="fungsi/tambah/tambah.php?barang=tambah" method="POST">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <?php
                                $format = $lihat->barang_id();
                                ?>
                                <tr>
                                    <td>ID Barang</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format; ?>" class="form-control" name="id"></td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>
                                        <select name="kategori" class="form-control" required>
                                            <option value="#">Pilih Kategori</option>
                                            <?php $kat = $lihat->kategori();
                                            foreach ($kat as $isi) {     ?>
                                                <option value="<?php echo $isi['id_kategori']; ?>">
                                                    <?php echo $isi['nama_kategori']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td><input type="text" placeholder="Nama Barang" required class="form-control" name="nama"></td>
                                </tr>
                                <tr>
                                    <td>Merk Barang</td>
                                    <td><input type="text" placeholder="Merk Barang" required class="form-control" name="merk"></td>
                                </tr>
                                <tr>
                                    <td>Harga Beli</td>
                                    <td><input type="number" placeholder="Harga beli" required class="form-control" name="beli"></td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td><input type="number" placeholder="Harga Jual" required class="form-control" name="jual"></td>
                                </tr>
                                <tr>
                                    <td>Satuan Barang</td>
                                    <td>
                                        <select name="satuan" class="form-control" required>
                                            <option value="#">Pilih Satuan</option>
                                            <option value="PCS">PCS</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td><input type="number" required Placeholder="Stok" class="form-control" name="stok"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Input</td>
                                    <td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i"); ?>" name="tgl"></td>
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