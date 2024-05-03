<?php

interface KontrakPasienPresenter
{
	public function prosesDataPasien();
	public function getId($i);
	public function getNik($i);
	public function getNama($i);
	public function getTempat($i);
	public function getTl($i);
	public function getGender($i);
	public function getEmail($i);
	public function getTelepon($i);
	public function getSize();
	public function prosesDataPasienById($id);
	public function tambahDataPasien($data);
	public function updateDataPasien($id, $data);
	public function deleteDataPasien($id);
}
