<?php
	$namacust     = $_POST ['namacust'];
	$email        = $_POST ['email'];
	$notelp       = $_POST ['notelp'];
	$tanggal      = date ("Y-m-d");
	$buku_pilih = '';
	$qty          = 1;

$datavalid = "YA";
if  (strlen(trim($namacust))==0) {
	echo "Nama Harus Diisi..<br/>";
	$datavalid="TIDAK";
	}
if  (strlen(trim($notelp))==0) {
	echo "No. Telp Harus Diisi..<br/>";
	$datavalid="TIDAK";
}
if (isset($_COOKIE['keranjang'])){
	$buku_pilih = $_COOKIE['keranjang'];
}else{
	echo "Keranjang Pinjam Kosong <br/>";
	$datavalid="TIDAK";
}
if ($datavalid == "TIDAK") {
	echo "Masih Ada Kesalahn, Silahkan Perbaiki! <br/>";
	echo "<input type='button' value='kembali'
		  onClick='self.history.back()'>";
	exit;
}

echo "Data Siap Disimpan.";

setcookie('keranjang',$buku_pilih, time()-3600);

?>
