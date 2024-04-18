<?php

require_once './db_koneksi.php';

// Tangkap data form yang dikirim
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$tmp_lahir = $_POST['tmp_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$gender = $_POST['gender'];
$kelurahan_id = $_POST['kelurahan'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];

// Simpan data ke dalam array
$data = [$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $kelurahan_id, $email, $alamat];

// Check nilai proses
switch ($_POST['proses']) {
    case 'Simpan':
        // Membuat sql
        $insertPasienSQL = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, kelurahan_id, email, alamat) VALUES (?,?,?,?,?,?,?,?)";
        // Mendefinisikan prepare statement
        $stmt = $dbh->prepare($insertPasienSQL);
        // Eksekusi statement
        $stmt->execute($data);
        break;
    case 'Ubah':
        // Logic mengubah data
        break;
    case 'Hapus':
        // Logic menghapus datax
        break;
    default:
        header('location: ./data_pasien.php');
}

// Redirect ke halaman data pasien
header('location: ./data_pasien.php');
