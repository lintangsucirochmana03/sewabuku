<?php
	$kode = $_GET["kode"];
	include "koneksi.php";
	$sql = "select * from buku where kode = '$kode' ";
	$hasil = mysqli_query($kon, $sql);
	if(!$hasil) die("Gagal query..");
	
	$data = mysqli_fetch_array($hasil);
	$judul = $data["judul"];
	$pengarang = $data["pengarang"];
	$penerbit = $data["penerbit"];
	$stok = $data["stok"];
	$foto = $data["foto"];
?>

<form action="proses.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
<table border="1">
<tr>
	<td>
		<h2>.:: EDIT BUKU ::.</h2><hr/>
<pre>
Judul Buku 		<input type="text" name="judul" value="<?php echo $judul; ?>"/><br/>
Pengarang 		<input type="text" name="pengarang" value="<?php echo $pengarang; ?>"/><br/>
Penerbit 		<input type="text" name="penerbit" value="<?php echo $penerbit; ?>"/><br/>
Jumlah Stok		<input type="text" name="stok" value="<?php echo $stok; ?>"/><hr/>
</pre>
		FOTO SAMPUL 
		<input type="file" name="foto">
		<input type="hidden" name="foto_lama" value="<?php echo $foto; ?>" /><br/>
		<img src="<?php echo "thumb/t_".$foto; ?>" width="100" />
		<hr/>
		<input type="submit" value="simpan" name="proses" />
		<input type="reset" value="reset" name="reset" />
	</td>
</tr>
</table>
</form>




	