<?php
	if(isset($_POST['kode'])){
		$kode = $_POST['kode'];
		$foto_lama = $_POST['foto_lama'];
		$simpan = "EDIT";
	}else{
		$simpan = "BARU";
	}

	$judul     =  $_POST ['judul'];
	$pengarang =  $_POST ['pengarang'];
	$penerbit  =  $_POST ['penerbit'];
	$stok      =  $_POST ['stok'];
	
	$foto        =  $_FILES['foto']['name'];
	$tmpName     =  $_FILES['foto']['tmp_name'];
	$size        =  $_FILES['foto']['size'];
	$type        =  $_FILES['foto']['type'];
	
	$maxsize     =  1500000;
	$typeYgBoleh =  array("image/jpeg","image/png","image/pjeg");
	
	$dirFoto     =  "pict";
	if(!is_dir($dirFoto))
		mkdir($dirFoto) ;
	$fileTujuanFoto = $dirFoto."/".$foto;
	
	$dirThumb = "thumb";
	if(!is_dir($dirThumb))
		mkdir($dirThumb) ;
	$fileTujuanThumb = $dirThumb."/t_".$foto;
	
$dataValid = "YA";

if ($size > 0 ) {
	if($size > $maxsize) {
		echo "Ukuran File Terlalu Besar <br/>";
		$dataValid="TIDAK";
	}
	if(!in_array($type, $typeYgBoleh)) {
		echo "UType File Tidak Dikenal <br/>";
		$dataValid="TIDAK";
	}
}

if (strlen (trim($judul))==0) {
	echo "Judul Buku Harus Diisi! <br/>";
	$dataValid = "TIDAK";
}
if (strlen(trim($pengarang))==0) {
	echo "Pengarang Harus Diisi! <br />";
	$dataValid = "TIDAK";
}
if (strlen(trim($penerbit))==0) {
	echo "Penerbit Harus Diisi! <br />";
	$dataValid = "TIDAK";
}
if (strlen (trim($stok))==0) {
	echo "Jumlah Stok Buku Harus Diisi! <br/>";
	$dataValid = "TIDAK";
}
if ($dataValid == "TIDAK") {
	echo "Masih ada kesalahan, silahkan perbaiki! <br/>";
	echo "<input type='button' value='kembali'
		onClick='self.history.back()'>";
	exit;
}

include "koneksi.php";

if($simpan == "EDIT"){
		if($size == 0){
			$foto = $foto_lama;
		}
		$sql = "update buku set
				judul = '$judul',
				pengarang = '$pengarang',
				penerbit = '$penerbit',
				stok = $stok,
				foto = '$foto'
				where kode = '$kode' ";
				
	}else {
		$sql = "insert into buku
		(judul,pengarang, penerbit, stok, foto)
		values
		('$judul', '$pengarang', '$penerbit', $stok, '$foto') ";
	}


$hasil = mysqli_query($kon, $sql);

if (!$hasil ) {
	echo "Gagal simpan, silahkan diulangi! <br/>";
	echo mysqli_error($kon);
	echo "<br/><input type='button' valus='kembali'
		onClick='self.history.back()'>";
exit;
} else {
	echo "Simpan data berhasil";
}

if ($size > 0) {
	if (!move_uploaded_file($tmpName, $fileTujuanFoto)) {
		echo "Gagal Upload Gambar..<br/>";
		echo "<a href-'barang_tampil.php'>Daftar Barang</a>";
		exit;
	} else {
		buat_thumbnail($fileTujuanFoto, $fileTujuanThumb);
	}
}

echo "<br/>File sudah di upload. <br/>" ;

function buat_thumbnail ($file_src, $file_dst) {
	//hapus jika thumbnail sebelumnya sudah ada
	list($w_src,$h_src,$type) = getImageSize($file_src);
	
	switch ($type) {
		case 1: // gif -> jpg
			$img_src = imagecreatefromgif($file_src);
			break;
		case 2: // jpeg -> jpg
			$img_src = imagecreatefromjpeg($file_src);
			break;
		case 3: // png -> jpg
			$img_src = imagecreatefrompng($file_src);
			break;
	}
			
	$thumb = 100; // max. size untuk thumb
	if ($w_src > $h_src) {
		$w_dst = $thumb; // landscape
		$h_dst = round($thumb / $w_src * $h_src);
	} else {
		$w_dst = round($thumb / $h_src * $w_src); // potrait
		$h_dst = $thumb;
	}
	
	$img_dst = imagecreatetruecolor($w_dst, $h_dst); // resample
	
	imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0,
		$w_dst, $h_dst, $w_src, $h_src);
	imagejpeg($img_dst, $file_dst); // simpan thumbnail
	//bersihkan memori
	imagedestroy($img_src);
	imagedestroy($img_dst);
}
?>
<hr/>
<a href="index.php"/>DAFTAR BUKU</a>


