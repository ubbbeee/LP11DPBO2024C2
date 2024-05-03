<?php
interface KontrakPasienView
{
    public function tampil();

	function updateFormPasien($id);

	function tambahFormPasien();

	function update($id, $data);

	function tambah($data);

	function delete($id);
}