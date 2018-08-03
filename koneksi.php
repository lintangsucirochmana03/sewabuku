<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	$host   = "localhost";
	$user   = "root";
	$pass   = "";
	$dbName = "sewabuku";
	
	$kon = mysqli_connect ($host, $user, $pass);
	if (!$kon)
		die("Gagal Koneksi...");
	
	$hasil = mysqli_select_db($kon, $dbName);
	if (!$hasil) {
		$hasil = mysqli_query($kon, "CREATE DATABASE $dbName");
		if (!$hasil)
			die("Gagal Buat Database");
		else
			$hasil = mysqli_select_db($kon, $dbName);
			if (!$hasil) die ("Gagal Konek Database");
}

$sqlTabelBuku = "create table if not exists buku (
					kode int(11) auto_increment not null primary key,
					judul varchar(40) not null,
					pengarang varchar(40) not null default 0,
					penerbit varchar(40) not null default 0,
					stok int(11),
					foto varchar(70) not null,
					KEY(judul) )";
					
mysqli_query ($kon, $sqlTabelBuku) or die ("Gagal Buat Tabel Buku: ".mysqli_error($kon));

$sqlTabelHpinjam="create table if not exists hpinjam (
				idhpinjam int auto_increment not null primary key,
				tanggal date not null,
				namacust varchar(40) not null,
				email varchar(50) not null default '',
				notelp varchar(20) not null default ''
				)";
				
mysqli_query ($kon, $sqlTabelHpinjam) or die("Gagal Buat Tabel Header Pinjam");

$sqlTabelDpinjam = "create table if not exists dpinjam (
				iddpinjam int auto_increment not null primary key,
				idhpinjam int not null,
				kode int not null,
				qty int not null,
				judul int not null
				)";
				
mysqli_query ($kon, $sqlTabelDpinjam) or die("Gagal Buat Tabel Detail Pinjam");

echo "Tabel Siap <hr/>";

?>

