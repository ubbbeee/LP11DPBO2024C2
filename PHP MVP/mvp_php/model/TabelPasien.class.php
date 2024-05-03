<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}
	//query untuk ambil data pasien dengan parameter id
	function getPasienById($id){
		$query = "SELECT * FROM pasien WHERE id = '$id'";
		return $this->execute($query);
	}
	//query untuk menambah data
	function tambahData($data){
		$nik = $data['nik'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$tl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$telepon = $data['telp'];
		
		$query = "INSERT INTO pasien VALUES('', '$nik', '$nama', '$tempat', '$tl', '$gender', '$email', '$telepon')";
		return $this->execute($query);
	}
	//query untuk mengupadte data
	function updateData($id, $data){
		$nik = $data['nik'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$tl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$telepon = $data['telp'];

		$query = "UPDATE pasien SET nik = '$nik', nama = '$nama', tempat = '$tempat', tl = '$tl', gender = '$gender', email = '$email', telp = '$telepon' WHERE id = '$id'";

		return $this->execute($query);
	}
	//query untuk menghapus data
	function deleteData($id){
		$query = "DELETE FROM pasien WHERE id = '$id'";
		return $this->execute($query);

	}
}
