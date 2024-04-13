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
        // Tangkap ID pasien yang akan diubah
        $pasien_id = $_POST['pasien_id'];

        // Membuat SQL untuk mengubah data pasien berdasarkan ID
        $updatePasienSQL = "UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, kelurahan_id=?, email=?, alamat=? WHERE id=?";

        // Tambahkan pasien_id ke dalam data untuk dieksekusi
        $data[] = $pasien_id;

        // Mendefinisikan prepare statement
        $stmt = $dbh->prepare($updatePasienSQL);

        // Eksekusi statement
        $stmt->execute($data);
        break;
    case 'Hapus':
        // Logic menghapus data
        // Tangkap ID pasien yang akan dihapus
        $pasien_id = $_POST['pasien_id'];

        // Membuat SQL untuk menghapus data pasien berdasarkan ID
        $deletePasienSQL = "DELETE FROM pasien WHERE id=?";

        // Mendefinisikan prepare statement
        $stmt = $dbh->prepare($deletePasienSQL);

        // Eksekusi statement dengan menggunakan ID pasien
        $stmt->execute([$pasien_id]);
        break;
    default:
        header('location: ./data_pasien.php');
}

// Redirect ke halaman data pasien
header('location: ./data_pasien.php');
