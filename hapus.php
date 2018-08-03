<?php
	$kode = $_GET['kode'];
	include "koneksi.php";
	$sql = "select * from buku where kode = '$kode' ";
	$hasil = mysqli_query($kon, $sql);
	if(!$hasil) die('Gagal query...');
	
	$data = mysqli_fetch_array($hasil);
	$judul = $data["judul"];
	$pengarang = $data["pengarang"];
	$penerbit = $data["penerbit"];
	$stok = $data["stok"];
	$foto = $data["foto"];
	
	echo "<h2>Konfirmasi Hapus</h2>";
	echo "Judul Buku : ".$judul."<br/>";
	echo "Pengarang : ".$pengarang."<br/>";
	echo "Penerbit : ".$penerbit."<br/>";
	echo "stok : ".$stok."<br/>";
	echo "Foto : <img src='thumb/t_".$foto." ' /><br/><br/>";
	echo "APAKAH DATA INI AKAN DI HAPUS ? <br/>";
	echo " <a href='hapus.php?kode=$kode&hapus=1'> YA </a> ";
	echo " &nbsp;&nbsp; ";
	echo " <a href='tampil.php'> TIDAK </a><br/><br/>";
	
	if(isset($_GET['hapus'])){
		$sql = "delete from buku where kode = '$kode' ";
		$hasil = mysqli_query($kon, $sql);
		if(!hasil){
			echo "Gagal Hapus Buku: $judul ..<br/>";
			echo "<a href='tampil.php'>Kembali ke Daftar Buku</a>";
		}else{
			$gbr = "pict/$foto";
			if(file_exists($gbr)) unlink($gbr);
			$gbr = "thumb/t_$foto";
			if(file_exists($gbr)) unlink($gbr);
			header ('location:index.php');
		}
	}
?>