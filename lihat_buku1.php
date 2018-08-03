<?php
$kode= $_GET["kode"];
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "sewabuku";
$kon = mysqli_connect($host, $user, $pass, $dbName);
if (!$kon)
		die("Gagal Koneksi...");
 $sql = "select * from buku where kode ='$kode'";
 $hasil = mysqli_query($kon, $sql);
	$row = mysqli_fetch_assoc($hasil);
	$kode = $row['kode'];
	$judul = $row['judul'];
	$pengarang = $row['pengarang'];
	$penerbit = $row['penerbit'];
	$foto = $row['foto'];
	?>
<a href="input.php">INPUT BUKU</a>
&nbsp;&nbsp;&nbsp;
<a href="cari.php">CARI BUKU</a>
&nbsp;&nbsp;&nbsp;
<a href="tampil.php"/>DAFTAR BUKU</a>
<table border="1">
	<?php
		echo "<h1> Informasi Buku</h1><br/>";
		echo "<a href='pict/{$row['foto']}'/>
				<img src='thumb/t_{$row['foto']}' width='200' height='280' />
				</a><br/>";
		echo "<br/>";
		echo "<tr>
				<td> Kode Buku";
		echo "<td>$kode</td></tr>";
		echo "<tr>
				<td>Judul Buku </td>";
		echo "<td>$judul</td></tr>";
		echo "<tr>
				<td>Pengarang </td>";
		echo "<td>$pengarang</td></tr>";
		echo "<tr>
				<td>Penerbit </td>";
		echo "<td>$penerbit</td></tr>";

mysqli_close($kon);
	?>
</table>
		