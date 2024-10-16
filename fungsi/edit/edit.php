<?php
session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    if (!empty($_GET['pengaturan'])) {
        $nama = htmlentities($_POST['namaagen']);
        $alamat = htmlentities($_POST['alamat']);
        $kontak = htmlentities($_POST['kontak']);
        $pemilik = htmlentities($_POST['pemilik']);
        $id = '1';

        $data[] = $nama;
        $data[] = $alamat;
        $data[] = $kontak;
        $data[] = $pemilik;
        $data[] = $id;
        $sql = 'UPDATE agen SET nama_agen=?, alamat_agen=?, tlp=?, nama_pemilik=? WHERE id_agen = ?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
    }

    if (!empty($_GET['seluler'])) {
        $nama = htmlentities($_POST['seluler']);
        $id = htmlentities($_POST['id']);
        $data[] = $nama;
        $data[] = $id;
        $sql = 'UPDATE operator_seluler SET  nama_operator=? WHERE id_operator=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=seluler&uid=' . $id . '&success-edit=edit-data"</script>';
    }

    if (!empty($_GET['stok'])) {
        $tambah_saldo = htmlentities($_POST['tambah_saldo']);
        $id = htmlentities($_POST['id']);
        $dataS[] = $id;
        $sqlS = 'SELECT*FROM saldo WHERE id_saldo=?';
        $rowS = $config->prepare($sqlS);
        $rowS->execute($dataS);
        $hasil = $rowS->fetch();

        $stok = $tambah_saldo + $hasil['saldo'];

        $data[] = $stok;
        $data[] = $id;
        $sql = 'UPDATE saldo SET saldo=? WHERE id_saldo=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=saldo&success-stok=stok-data"</script>';
    }

    if (!empty($_GET['pulsa'])) {
        $id = htmlentities($_POST['id']);
        $seluler = htmlentities($_POST['seluler']);
        $nama = htmlentities($_POST['nama']);
        $jual = htmlentities($_POST['jual']);
        $tgl = htmlentities($_POST['tgl']);

        $data[] = $seluler;
        $data[] = $nama;
        $data[] = $jual;
        $data[] = $tgl;
        $data[] = $id;
        $sql = 'UPDATE pulsa SET id_operator=?, pulsa_berapa=?, profit=?, tgl_update=?  WHERE id_pulsa=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=pulsa/edit&pulsa=' . $id . '&success=edit-data"</script>';
    }

    if (!empty($_GET['gambar'])) {
        $id = htmlentities($_POST['id']);
        set_time_limit(0);
        $allowedImageType = array("image/gif", "image/JPG", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", 'image/webp');
        $filepath = $_FILES['foto']['tmp_name'];
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);
        $allowedTypes = [
            'image/png'   => 'png',
            'image/jpeg'  => 'jpg',
            'image/gif'   => 'gif',
            'image/jpg'   => 'jpeg',
            'image/webp'  => 'webp'
        ];
        if (!in_array($filetype, array_keys($allowedTypes))) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
            exit;
        } else if ($_FILES['foto']["error"] > 0) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
            exit;
        } elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
            // echo "You can only upload JPG, PNG and GIF file";
            // echo "<font face='Verdana' size='2' ><BR><BR><BR>
            // 		<a href='../../index.php?page=user'>Back to upform</a><BR>";
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
            exit;
        } elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
            // echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
            // echo "<font face='Verdana' size='2' ><BR><BR><BR>
            // 		<a href='../../index.php?page=user'>Back to upform</a><BR>";
            echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB");window.location="../../index.php?page=user"</script>';
            exit;
        } else {
            $dir = '../../assets/img/user/';
            $tmp_name = $_FILES['foto']['tmp_name'];
            $name = time() . basename($_FILES['foto']['name']);
            if (move_uploaded_file($tmp_name, $dir . $name)) {
                //post foto lama
                $foto2 = $_POST['foto2'];
                //remove foto di direktori
                unlink('../../assets/img/user/' . $foto2 . '');
                //input foto
                $id = $_POST['id'];
                $data[] = $name;
                $data[] = $id;
                $sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
                $row = $config->prepare($sql);
                $row->execute($data);
                echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
            } else {
                echo '<script>alert("Masukan Gambar !");window.location="../../index.php?page=user"</script>';
                exit;
            }
        }
    }

    if (!empty($_GET['profil'])) {
        $id = htmlentities($_POST['id']);
        $nama = htmlentities($_POST['nama']);
        $alamat = htmlentities($_POST['alamat']);
        $tlp = htmlentities($_POST['tlp']);
        $email = htmlentities($_POST['email']);
        $nik = htmlentities($_POST['nik']);

        $data[] = $nama;
        $data[] = $alamat;
        $data[] = $tlp;
        $data[] = $email;
        $data[] = $nik;
        $data[] = $id;
        $sql = 'UPDATE member SET nm_member=?,alamat_member=?,telepon=?,email=?,NIK=? WHERE id_member=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
    }

    if (!empty($_GET['pass'])) {
        $id = htmlentities($_POST['id']);
        $user = htmlentities($_POST['user']);
        $pass = htmlentities($_POST['pass']);

        $data[] = $user;
        $data[] = $pass;
        $data[] = $id;
        $sql = 'UPDATE login SET user=?,pass=md5(?) WHERE id_member=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
    }

    if (!empty($_GET['jual'])) {
        $id = htmlentities($_POST['id']);
        $id_barang = htmlentities($_POST['id_barang']);
        $jumlah = htmlentities($_POST['jumlah']);

        $sql_tampil = "select *from barang where barang.id_barang=?";
        $row_tampil = $config->prepare($sql_tampil);
        $row_tampil->execute(array($id_barang));
        $hasil = $row_tampil->fetch();

        if ($hasil['stok'] > $jumlah) {
            $jual = $hasil['harga_jual'];
            $total = $jual * $jumlah;
            $data1[] = $jumlah;
            $data1[] = $total;
            $data1[] = $id;
            $sql1 = 'UPDATE penjualan SET jumlah=?,total=? WHERE id_penjualan=?';
            $row1 = $config->prepare($sql1);
            $row1->execute($data1);
            echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
        } else {
            echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }

    if (!empty($_GET['cari_pulsa'])) {
        $cari = trim(strip_tags($_POST['keyword']));
        if ($cari == '') {
        } else {
            $sql = "SELECT pulsa.*, operator_seluler.id_operator, operator_seluler.nama_operator
					from pulsa inner join operator_seluler on pulsa.id_operator = operator_seluler.id_operator
					where pulsa.id_pulsa like '%$cari%' or pulsa.pulsa_berapa like '%$cari%' or operator_seluler.nama_operator like '%$cari%'";
            $row = $config->prepare($sql);
            $row->execute();
            $hasil1 = $row->fetchAll();
?>
            <table class="table table-stripped" width="100%" id="example2">
                <tr>
                    <th>ID Pulsa</th>
                    <th>Pulsa</th>
                    <th>Seluler</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($hasil1 as $hasil) { ?>
                    <tr>
                        <td><?php echo $hasil['id_pulsa']; ?></td>
                        <td><?php echo $hasil['pulsa_berapa']; ?></td>
                        <td><?php echo $hasil['nama_operator']; ?></td>
                        <td><?php echo $hasil['pulsa_berapa'] + $hasil['profit']; ?></td>
                        <td>
                            <a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['id_pulsa']; ?>&id_kasir=<?php echo $_SESSION['admin']['id_member']; ?>" class="btn btn-success">
                                <i class="fa fa-shopping-cart"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
<?php
        }
    }
}
