<?php
/*
* PROSES TAMPIL
*/
class view
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function member()
    {
        $sql = "SELECT member.*, login.*
                FROM member INNER JOIN login ON member.id_member = login.id_member";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function member_edit($id)
    {
        $sql = "SELECT member.*, login.*
                FROM member INNER JOIN login ON member.id_member = login.id_member
                WHERE member.id_member= ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    public function agen()
    {
        $sql = "SELECT*FROM agen WHERE id_agen='1'";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function operator_seluler()
    {
        $sql = "SELECT*FROM operator_seluler";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function pulsa()
    {
        $sql = "SELECT pulsa.*, operator_seluler.id_operator, operator_seluler.nama_operator
                FROM pulsa INNER JOIN operator_seluler on pulsa.id_operator = operator_seluler.id_operator 
                ORDER BY id DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function saldo9()
    {
        $sql = "SELECT pulsa.*, operator_seluler.id_operator, operator_seluler.nama_operator
                FROM pulsa INNER JOIN operator_seluler on pulsa.id_operator = operator_seluler.id_operator 
                WHERE stok <= 3 
                ORDER BY id DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }
    public function saldo()
    {
        $sql = "SELECT * FROM saldo 
                ORDER BY id_saldo DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function pulsa_edit($id)
    {
        $sql = "SELECT pulsa.*, 
        operator_seluler.id_operator, 
        operator_seluler.nama_operator 
        FROM pulsa 
        INNER JOIN operator_seluler 
        on pulsa.id_operator = operator_seluler.id_operator
        WHERE id_pulsa=?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    public function pulsa_cari($cari)
    {
        $sql = "SELECT pulsa.*, operator_seluler.id_operator, operator_seluler.nama_operator
                FROM pulsa INNER JOIN operator_seluler on pulsa.id_operator = operator_seluler.id_operator
                WHERE id_pulsa like '%$cari%' or pulsa_berapa like '%$cari%' or merk like '%$cari%'";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function pulsa_id()
    {
        $sql = 'SELECT * FROM pulsa ORDER BY id DESC';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();

        $urut = substr($hasil['id_pulsa'], 2, 3);
        $tambah = (int) $urut + 1;
        if (strlen($tambah) == 1) {
            $format = 'PLS' . $tambah . '';
        } elseif (strlen($tambah) == 2) {
            $format = 'PLS' . $tambah . '';
        } else {
            $ex = explode('PLS', $hasil['id_pulsa']);
            $no = (int) $ex[1] + 1;
            $format = 'PLS' . $no . '';
        }
        return $format;
    }

    public function operator_seluler_edit($id)
    {
        $sql = "SELECT*FROM operator_seluler WHERE id_operator=?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    public function operator_seluler_row()
    {
        $sql = "SELECT*FROM operator_seluler";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->rowCount();
        return $hasil;
    }

    public function pulsa_row()
    {
        $sql = "SELECT*FROM pulsa";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->rowCount();
        return $hasil;
    }

    public function sisa_saldo()
    {
        // Query untuk mendapatkan saldo dari tabel 'saldo'
        $saldoQuery = "SELECT saldo FROM saldo";
        $saldoStatement = $this->db->prepare($saldoQuery);
        $saldoStatement->execute();
        $saldoResult = $saldoStatement->fetch();
        $saldo = $saldoResult['saldo'];

        return $saldo;
    }

    public function pulsa_beli_row()
    {
        $sql = "SELECT SUM(harga_beli) as beli FROM pulsa";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function jual_row()
    {
        $sql = "SELECT SUM(total) as stok, SUM(harga_awal) as modal FROM nota";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function jual()
    {
        $sql = "SELECT nota.* , pulsa.id_pulsa, pulsa.pulsa_berapa, member.id_member,
                member.nm_member FROM nota 
                left JOIN pulsa on pulsa.id_pulsa=nota.id_pulsa 
                left JOIN member on member.id_member=nota.id_member 
                WHERE nota.periode = ?
                ORDER BY id_nota DESC";
        $row = $this->db->prepare($sql);
        $row->execute(array(date('Y-m-d')));
        $hasil = $row->fetchAll();
        // var_dump($hasil);
        return $hasil;
    }

    public function periode_jual($periode)
    {
        $sql = "SELECT nota.* , pulsa.id_pulsa, pulsa.pulsa_berapa, member.id_member,
        member.nm_member FROM nota 
        left JOIN pulsa on pulsa.id_pulsa=nota.id_pulsa 
        left JOIN member on member.id_member=nota.id_member 
        WHERE DATE_FORMAT(nota.periode, '%Y-%m' )= ?
        ORDER BY id_nota ASC";
        $row = $this->db->prepare($sql);
        $row->execute(array(date($periode)));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function hari_jual($hari)
    {
        // Ubah format $hari ke format 'Y-m-d'
        $ex = explode('-', $hari);
        $year = $ex[0];
        $month = $ex[1];
        $day = $ex[2];
        $formattedDate = "$year-$month-$day";

        // Buat parameter untuk pencarian dengan tanda % sebelum dan sesudah tanggal
        $param = "%$formattedDate%";

        // Buat query SQL dengan parameter placeholder
        $sql = "SELECT nota.*, pulsa.id_pulsa, pulsa.pulsa_berapa, member.id_member, member.nm_member 
            FROM nota 
            LEFT JOIN pulsa ON pulsa.id_pulsa = nota.id_pulsa 
            LEFT JOIN member ON member.id_member = nota.id_member 
            WHERE nota.tanggal_input LIKE ? 
            ORDER BY id_nota ASC";

        // Persiapkan statement SQL
        $stmt = $this->db->prepare($sql);

        // Eksekusi query dengan parameter $param
        $stmt->execute(array($param));

        // Ambil hasilnya sebagai array
        $hasil = $stmt->fetchAll();

        return $hasil;
    }


    public function penjualan()
    {
        $sql = "SELECT penjualan.* , pulsa.id_pulsa, pulsa.pulsa_berapa, member.id_member,
                member.nm_member FROM penjualan 
                left JOIN pulsa on pulsa.id_pulsa=penjualan.id_pulsa 
                left JOIN member on member.id_member=penjualan.id_member
                ORDER BY id_penjualan";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function jumlah()
    {
        $sql = "SELECT SUM(total) as bayar FROM penjualan";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function jumlah_nota()
    {
        $sql = "SELECT SUM(total) as bayar FROM nota";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function jml()
    {
        $sql = "SELECT SUM(harga_beli*stok) as byr FROM pulsa";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }
}
