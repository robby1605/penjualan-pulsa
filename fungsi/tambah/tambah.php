<?php

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    if (!empty($_GET['seluler'])) {
        $nama = htmlentities(htmlentities($_POST['seluler']));
        var_dump($nama);
        $tgl = date("Y-m-d");
        $data[] = $nama;
        $data[] = $tgl;
        $sql = 'INSERT INTO operator_seluler (nama_operator,tgl_input) VALUES(?,?)';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=seluler&&success=tambah-data"</script>';
    }

    if (!empty($_GET['pulsa'])) {

        $id = htmlentities($_POST['id']);
        $kategori = htmlentities($_POST['seluler']);
        $pulsa = htmlentities($_POST['nama']);
        $jual = htmlentities($_POST['jual']);
        $tgl = htmlentities($_POST['tgl']);

        $data[] = $id;
        $data[] = $kategori;
        $data[] = $pulsa;
        $data[] = $jual;
        $data[] = $tgl;
        $sql = 'INSERT INTO pulsa (id_pulsa,id_operator,pulsa_berapa,profit,tgl_input) 
			    VALUES (?,?,?,?,?)';
        $row = $config->prepare($sql);
        var_dump($row->execute($data));
        echo '<script>window.location="../../index.php?page=pulsa&success=tambah-data"</script>';
    }

    if (!empty($_GET['jual'])) {
        $id = $_GET['id'];
        // get tabel pulsa id_pulsa
        $sql = 'SELECT * FROM pulsa WHERE id_pulsa = ?';
        $row = $config->prepare($sql);
        $row->execute(array($id));
        $hsl = $row->fetch();
        // var_dump($hsl);
        $sqlsaldo = 'SELECT * FROM saldo';
        $rowsaldo = $config->prepare($sqlsaldo);
        $rowsaldo->execute();
        $hslsaldo = $rowsaldo->fetch();
        // var_dump($hslsaldo['saldo']);

        if ($hslsaldo['saldo'] >= 50000) {
            $kasir =  $_GET['id_kasir'];
            $pulsa = $hsl['pulsa_berapa'];
            $total = $hsl['pulsa_berapa'] + $hsl['profit'];
            $tgl = date("Y-m-d");

            $data1[] = $id;
            $data1[] = $kasir;
            $data1[] = $pulsa;
            $data1[] = $total;
            $data1[] = $tgl;

            $sql1 = 'INSERT INTO penjualan (id_pulsa,id_member,harga_awal,total,tanggal_input) VALUES (?,?,?,?,?)';
            $row1 = $config->prepare($sql1);
            $row1->execute($data1);


            echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
        } else {
            echo '<script>alert("Saldo anda tidak cukup !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }
}
