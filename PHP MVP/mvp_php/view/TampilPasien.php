<?php


include("KontrakPasienView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakPasienView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr> <td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelepon($i) . "</td>
			<td> <a class='btn btn-warning btn-sm' href='index.php?id_edit=" . $this->prosespasien->getId($i) . "'><i class='bi bi-pencil-square'></i></a>
                 <a class='btn btn-danger btn-sm' href='index.php?id_hapus=" . $this->prosespasien->getId($i) . "'><i class='bi bi-trash'></i></a>
        	</td>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}
	//untuk ta,pilan form update
	function updateFormPasien($id){
		$labelform = "Update Data Pasien";
		$tpl = new Template("templates/form.html");
		$this->prosespasien->prosesDataPasienById($id);
		$tpl->replace("DATA_LABEL_FORM", $labelform);
		$tpl->replace("DATA_NIK", $this->prosespasien->getNik(0));
		$tpl->replace("DATA_NAMA", $this->prosespasien->getNama(0));
		$tpl->replace("DATA_TEMPAT", $this->prosespasien->getTempat(0));
		$tpl->replace("DATA_TL", $this->prosespasien->getTl(0));
		$laki = $this->prosespasien->getGender(0) === "Laki-laki" ? "checked" : "";
		$perempuan = $this->prosespasien->getGender(0) === "Perempuan" ? "checked" : "";
		$tpl->replace("DATA_LAKI", $laki);
		$tpl->replace("DATA_PEREMPUAN", $perempuan);
		$tpl->replace("DATA_EMAIL", $this->prosespasien->getEmail(0));
		$tpl->replace("DATA_TELP", $this->prosespasien->getTelepon(0));
		$tpl->write();
	}
	//untuk proses update data
	function update($id, $data)
	{
		$this->prosespasien->updateDataPasien($id, $data);
	}
	//ini untuk menampilkan form tambah
	function tambahFormPasien(){
		$labelform = "Tambah Data Pasien";

		$tpl = new Template("templates/form.html");
		$tpl->replace("DATA_LABEL_FORM", $labelform);
		$tpl->write();
	}
	//untuk proses tambah data

	function tambah($data){
		$this->prosespasien->tambahDataPasien($data);
	}
	//untuk proses delete data

	function delete($id){
		$this->prosespasien->deleteDataPasien($id);
	}
}
