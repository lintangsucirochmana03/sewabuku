<?php
	$judul="";
	if (isset($_POST["judul"]))
		$judul=$_POST["judul"];
		$pengarang="";
	if (isset($_POST["pengarang"]))
		$pengarang=$_POST["pengarang"];
		
	include "koneksi.php";
	$sql = "select * from buku where judul like '%".$judul."%' order by kode desc";
	$hasil = mysqli_query ($kon, $sql);
	if (!$hasil)
		die("Gagal query..".mysqli_error($kon));
		
	$row = mysqli_fetch_assoc($hasil);
	$kode = $row['kode'];
	$judul = $row['judul'];
	$pengarang = $row['pengarang'];
	$penerbit = $row['penerbit'];
	$foto = $row['foto'];
?>

<table border="1" cellspacing="0" width="400"><tr><td><br/>
<a href="input.php">INPUT BUKU</a>
&nbsp;&nbsp;&nbsp;
<a href="cari.php">CARI BUKU</a>
&nbsp;&nbsp;&nbsp;
<a href="index.php"/>DAFTAR BUKU</a>
	<h2>.::INFORMASI BUKU::.</h2><hr/>
	<form action="tampil.php" method="post">
<table border="1" cellspacing="3" width="390" text="align" ><tr><td><br/>
<?php
		echo "<a href='pict/{$row['foto']}'/>
				<img src='thumb/t_{$row['foto']}' width='200' />
				</a><br/>";
?>
	</tr></td>	
</table>
<table border="1" cellspacing="3" width="390" text="align" >
		<?php
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
		?>
	</tr>
</table>
</tr></td>
</table>
</form>

