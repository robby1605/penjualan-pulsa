<h3>Dashboard</h3>
<br />
<?php
$sql = " SELECT saldo FROM saldo";
$row = $config->prepare($sql);
$row->execute();
$r = $row->fetch();
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
<?php $pulsa_berapa = $lihat->pulsa_row();
// var_dump($pulsa_berapa);
?>
<?php $seluler = $lihat->operator_seluler_row();
// var_dump($seluler); 
?>
<?php $sisa = $lihat->sisa_saldo();
// var_dump($sisa) 
?>
<?php $jual = $lihat->jual_row();
// var_dump($jual); 
?>
<div class="row">
    <!--STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Pulsa</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($pulsa_berapa); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=pulsa'>Tabel
                    Pulsa <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-md-3 mb-3 ">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Sisa Saldo</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($sisa); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=saldo'>Tabel
                    Saldo <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-upload"></i>Omset</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1>Rp.<?php echo number_format($jual['stok']); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=laporan'>Tabel
                    laporan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Profit</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1>Rp.<?php echo number_format($jual['stok'] - $jual['modal']); ?></h1>
                </center>

            </div>
            <div class="card-footer">
                <a href='index.php?page=laporan'>Tabel
                    laporan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Operator Selular</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($seluler); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=seluler'>Tabel
                    Seluler <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
</div>