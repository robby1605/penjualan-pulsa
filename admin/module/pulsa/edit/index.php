 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->


 <?php
	$id = $_GET['pulsa'];
	$hasil = $lihat->pulsa_edit($id);
	?>
 <a href="index.php?page=pulsa" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
 <h4>Edit Barang</h4>
 <?php if (isset($_GET['success'])) { ?>
 	<div class="alert alert-success">
 		<p>Edit Data Berhasil !</p>
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
 			<form action="fungsi/edit/edit.php?pulsa=edit" method="POST">
 				<tr>
 					<td>ID Barang</td>
 					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['id_pulsa']; ?>" name="id"></td>
 				</tr>
 				<tr>
 					<td>Operator Seluler</td>
 					<td>
 						<select name="seluler" class="form-control">
 							<option value="<?php echo $hasil['id_operator']; ?>"><?php echo $hasil['nama_operator']; ?></option>
 							<option value="#">Pilih Seluler</option>
 							<?php $kat = $lihat->operator_seluler();
								foreach ($kat as $isi) { 	?>
 								<option value="<?php echo $isi['id_operator']; ?>"><?php echo $isi['nama_operator']; ?></option>
 							<?php } ?>
 						</select>
 					</td>
 				</tr>
 				<tr>
 					<td>Pulsa</td>
 					<td><input type="number" class="form-control" value="<?php echo $hasil['pulsa_berapa']; ?>" name="nama"></td>
 				</tr>

 				<tr>
 					<td>Harga Jual</td>
 					<td><input type="number" class="form-control" value="<?php echo $hasil['profit']; ?>" name="jual"></td>
 				</tr>
 				<tr>
 					<td>Tanggal Update</td>
 					<td><input type="date" readonly="readonly" class="form-control" value="<?php echo  date("Y-m-d"); ?>" name="tgl"></td>
 				</tr>
 				<tr>
 					<td></td>
 					<td><button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
 				</tr>
 			</form>
 		</table>
 	</div>
 </div>