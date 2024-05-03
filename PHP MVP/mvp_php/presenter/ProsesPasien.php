<?php

include("KontrakPasienPresenter.php");


class ProsesPasien implements KontrakPasienPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_test"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']); //mengisi gender
				$pasien->setEmail($row['email']); //mengisi gender
				$pasien->setTelepon($row['telp']); //mengisi gender


				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}

	function prosesDataPasienById($id){
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->getPasienById($id);//ambil data pasien dengan id
			$data = $this->tabelpasien->getResult();
			$pasien = new Pasien($data['id'], $data['nik'], $data['nama'], $data['tempat'], $data['tl'], $data['gender'], $data['email'], $data['telp']);//intansiasi objek pasien dengan atribut atributnya
			$this->data[] = $data;//masukkan data ke dalam list
			$this->tabelpasien->close();
		} catch (Exception $e) {
			echo "Gagal mengambil data" . $e->getMessage();
		}
	}

	function tambahDataPasien($data){
		try {
			$this->tabelpasien->open();//buka koneksi
			$this->tabelpasien->tambahData($data);//tambah data
			$this->tabelpasien->close();//tutup koneksi
			echo ("<script>location.href = 'index.php';</script>");//balik ke halaman utama
		} catch (Exception $e) {//kalau gagal
			echo "Gagal menambah data: " . $e->getMessage();
		}
	}

	function updateDataPasien($id, $data){
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->updateData($id, $data);
			$this->tabelpasien->close();
			echo ("<script>location.href = 'index.php';</script>");
		} catch (Exception $e) {
			echo "Gagal mengedit data: " . $e->getMessage();
		}
	}

	function deleteDataPasien($data){
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->deleteData($data);
			$this->tabelpasien->close();
			echo ("<script>location.href = 'index.php';</script>");
		} catch (Exception $e) {
			echo "Gagal menghapus data: " . $e->getMessage();
		}
	}

	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}

	function getEmail($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelepon($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}
}
