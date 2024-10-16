<?php
$id = $_GET['pulsa'];
$hasil = $lihat->pulsa_edit($id);
// var_dump($hasil);
?>
<a href="index.php?page=pulsa" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
<h4>Details Barang</h4>
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
<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<td>ID Pulsa</td>
				<td><?php echo $hasil['id_pulsa']; ?></td>
			</tr>
			<tr>
				<td>Seluler</td>
				<td><?php echo $hasil['nama_operator']; ?></td>
			</tr>
			<tr>
				<td>Pulsa</td>
				<td><?php echo $hasil['pulsa_berapa']; ?></td>
			</tr>
			<tr>
				<td>Harga Jual</td>
				<td><?php echo $hasil['profit']; ?></td>
			</tr>
			<tr>
				<td>Tanggal Input</td>
				<td><?php echo $hasil['tgl_input']; ?></td>
			</tr>
			<tr>
				<td>Tanggal Update</td>
				<td><?php echo $hasil['tgl_update']; ?></td>
			</tr>
		</table>
	</div>
</div>