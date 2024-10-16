 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php
	$id = $_SESSION['admin']['id_member'];
	$hasil = $lihat->member_edit($id);
	?>
 <h4>Keranjang Penjualan</h4>
 <br>
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
 <div class="row">
 	<div class="col-sm-4">
 		<div class="card card-primary mb-3">
 			<div class="card-header bg-primary text-white">
 				<h5><i class="fa fa-search"></i> Cari Saldo</h5>
 			</div>
 			<div class="card-body">
 				<input type="text" id="cari" class="form-control" name="cari" placeholder="Masukan : Kode / Pulsa  [ENTER]">
 			</div>
 		</div>
 	</div>
 	<div class="col-sm-8">
 		<div class="card card-primary mb-3">
 			<div class="card-header bg-primary text-white">
 				<h5><i class="fa fa-list"></i> Hasil Pencarian</h5>
 			</div>
 			<div class="card-body">
 				<div class="table-responsive">
 					<div id="hasil_cari"></div>
 					<div id="tunggu"></div>
 				</div>
 			</div>
 		</div>
 	</div>

 	<div class="col-sm-12">
 		<div class="card card-primary">
 			<div class="card-header bg-primary text-white">
 				<h5><i class="fa fa-shopping-cart"></i> KASIR
 					<a class="btn btn-danger float-right" onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="fungsi/hapus/hapus.php?penjualan=jual">
 						<b>RESET KERANJANG</b></a>
 				</h5>
 			</div>
 			<div class="card-body">
 				<div id="keranjang" class="table-responsive">
 					<table class="table table-bordered">
 						<tr>
 							<td><b>Tanggal</b></td>
 							<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("Y-m-d"); ?>" name="tgl"></td>
 						</tr>
 					</table>
 					<table class="table table-bordered w-100" id="example1">
 						<thead>
 							<tr>
 								<td> No</td>
 								<td> Pulsa</td>
 								<!-- <td style="width:10%;"> Jumlah</td> -->
 								<td style="width:20%;"> Total</td>
 								<td> Kasir</td>
 								<td> Aksi</td>
 							</tr>
 						</thead>
 						<tbody>
 							<?php $total_bayar = 0;
								$no = 1;
								$hasil_penjualan = $lihat->penjualan(); ?>
 							<?php foreach ($hasil_penjualan  as $isi) { ?>
 								<tr>
 									<td><?php echo $no; ?></td>
 									<td>Rp.<?php echo number_format($isi['pulsa_berapa']); ?></td>
 									<td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
 									<td><?php echo $isi['nm_member']; ?></td>
 									<td>

 										<!-- aksi ke table penjualan -->
 										<a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan']; ?>&brg=<?php echo $isi['id_pulsa']; ?>
											&jml=<?php echo $isi['jumlah']; ?>" class="btn btn-danger"><i class="fa fa-times"></i>
 										</a>
 									</td>
 								</tr>
 							<?php $no++;
									$total_bayar += $isi['total'];
								} ?>
 						</tbody>
 					</table>
 					<br />
 					<?php $hasil = $lihat->jumlah(); ?>
 					<div id="kasirnya">
 						<table class="table table-stripped">
 							<?php
								// proses bayar dan ke nota
								if (!empty($_GET['nota'] == 'yes')) {
									$total = $_POST['total'];
									$bayar = $_POST['bayar'];
									if (!empty($bayar)) {
										$hitung = $bayar - $total;
										if ($bayar >= $total) {
											$sqls = "SELECT * FROM saldo";
											$rows = $config->prepare($sqls);
											$rows->execute();
											$hsls = $rows->fetch();
											if ($hsls['saldo'] >= $total) {
												$id_pulsa = $_POST['id_pulsa'];
												$id_member = $_POST['id_member'];
												$harga_awal = $_POST['harga_awal'];
												$total = $_POST['total1'];
												$tgl_input = $_POST['tgl_input'];
												$periode = $_POST['periode'];
												$jumlah_dipilih = count($id_pulsa);
												// var_dump($jumlah_dipilih);

												for ($x = 0; $x < $jumlah_dipilih; $x++) {

													$d = array($id_pulsa[$x], $id_member[$x], $harga_awal[$x], $total[$x], $tgl_input[$x], $periode[$x]);
													$sql = "INSERT INTO nota (id_pulsa,id_member,harga_awal,total,tanggal_input,periode) VALUES(?,?,?,?,?,?)";
													$row = $config->prepare($sql);
													$row->execute($d);

													$sql_pulsa = "SELECT * FROM saldo";
													$row_pulsa = $config->prepare($sql_pulsa);
													$row_pulsa->execute();
													$hsl = $row_pulsa->fetch();

													$saldo = $hsl['saldo'];

													$total_saldo = $saldo - $total[$x];
													$sql_saldo = "UPDATE saldo SET saldo = ?";
													$row_saldo = $config->prepare($sql_saldo);
													$row_saldo->execute(array($total_saldo));
													echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
												}
											} else {
												echo '<script>alert("cek saldo!");</script>';
											}
										} else {
											echo '<script>alert("Uang Kurang ! Rp.' . $hitung . '");</script>';
										}
									}
								}
								?>
 							<!-- aksi ke table nota -->
 							<form method="POST" action="index.php?page=jual&nota=yes#kasirnya">
 								<?php foreach ($hasil_penjualan as $isi) {; ?>
 									<input type="hidden" name="id_pulsa[]" value="<?php echo $isi['id_pulsa']; ?>">
 									<input type="hidden" name="id_member[]" value="<?php echo $isi['id_member']; ?>">
 									<input type="hidden" name="harga_awal[]" value="<?php echo $isi['pulsa_berapa']; ?>">
 									<input type="hidden" name="total1[]" value="<?php echo $isi['total']; ?>">
 									<input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input']; ?>">
 									<input type="hidden" name="periode[]" value="<?php echo date('Y-m-d'); ?>">
 								<?php $no++;
									} ?>
 								<tr>
 									<td>Total Semua </td>
 									<td><input type="text" class="form-control" name="total" value="<?php echo $total_bayar; ?>"></td>

 									<td>Bayar </td>
 									<td><input type="text" class="form-control" name="bayar" value="<?php echo $bayar; ?>"></td>
 									<td><button class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button>
 										<?php if (!empty($_GET['nota'] == 'yes')) { ?>
 											<a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
 												<b>RESET</b></a>
 									</td><?php } ?></td>
 								</tr>
 							</form>
 							<!-- aksi ke table nota -->
 							<tr>
 								<td>Kembali</td>
 								<td><input type="text" class="form-control" value="<?php echo $hitung; ?>"></td>
 								<td></td>
 								<td>
 									<a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member']; ?>
									&bayar=<?php echo $bayar; ?>&kembali=<?php echo $hitung; ?>" target="_blank">
 										<button class="btn btn-secondary">
 											<i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
 										</button></a>
 								</td>
 							</tr>
 						</table>
 						<br />
 						<br />
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>


 	<script>
 		// AJAX call for autocomplete 
 		$(document).ready(function() {
 			$("#cari").change(function() {
 				$.ajax({
 					type: "POST",
 					url: "fungsi/edit/edit.php?cari_pulsa=yes",
 					data: 'keyword=' + $(this).val(),
 					beforeSend: function() {
 						$("#hasil_cari").hide();
 						$("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
 					},
 					success: function(html) {
 						$("#tunggu").html('');
 						$("#hasil_cari").show();
 						$("#hasil_cari").html(html);
 					}
 				});
 			});
 		});
 		//To select country name
 	</script>