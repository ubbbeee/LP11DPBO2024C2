<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");


$tp = new TampilPasien(); // Membuat objek TampilPasien untuk mengelola tampilan data pasien

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Jika sedang dalam mode edit data
    if ($_GET['id_edit'] > 0) {
        $id = $_GET['id_edit']; // Mendapatkan ID data yang akan diubah
        $tp->update($id, $_POST); // Memanggil metode update dengan data yang diubah dari form
    } else {
        $tp->tambah($_POST); // Jika bukan mode edit, panggil metode tambah dengan data dari form
    }
} 
// Jika permintaan adalah untuk menampilkan form tambah data
else if (!empty($_GET['add'])) {
    $tp->tambahFormPasien(); // Memanggil metode untuk menampilkan form tambah data pasien
} 
// Jika permintaan adalah untuk menghapus data pasien
else if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus']; // Mendapatkan ID data yang akan dihapus
    $tp->delete($id); // Memanggil metode untuk menghapus data pasien dengan ID tertentu
    header("location:index.php"); // Redirect kembali ke halaman utama setelah penghapusan
} 
// Jika permintaan adalah untuk menampilkan form edit data pasien
else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit']; // Mendapatkan ID data yang akan diedit
    $tp->updateFormPasien($id); // Memanggil metode untuk menampilkan form edit data pasien dengan ID tertentu
} 
// Jika tidak ada permintaan khusus, tampilkan data pasien secara default
else {
    $tp->tampil(); // Memanggil metode untuk menampilkan data pasien secara default
}
