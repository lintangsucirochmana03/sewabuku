<?php
	$judul="";
	if (isset($_POST["judul"]))
		$judul=$_POST["judul"];
		
	include "koneksi.php";
	$sql = "select * from buku where judul like '%".$judul."%' order by kode desc";
	$hasil = mysqli_query ($kon, $sql);
	if (!$hasil)
		die("Gagal query..".mysqli_error($kon));
?>
<a href="input.php">INPUT BUKU</a>
&nbsp;&nbsp;&nbsp;
<a href="cari.php">CARI BUKU</a>
&nbsp;&nbsp;&nbsp;
<a href="index.php"/>DAFTAR BUKU</a>

<table border="1">
	<tr>
		<th>FOTO</th>
		<th>Judul Buku</th>
		<th>Pengarang</th>
		<th>&nbsp;</th>
	</tr>
	<?php
		$no=0;
		while ($row = mysqli_fetch_assoc($hasil)){
			echo " <tr> ";
			echo " 	<td> <a href='pict/{$row['foto']}'/>
					<img src='thumb/t_{$row['foto']} ' width='100' />
					</a></td>";
			echo " <td> ".$row['judul']."</td>";
			echo " <td> ".$row['pengarang']."</td>";
			echo " <td> ";
			echo " <a href='edit.php?kode=".$row['kode']." '>
				   EDIT </a> ";
			echo " &nbsp;&nbsp; ";
			echo " <a href='hapus.php?kode=".$row['kode']." '>
				   HAPUS </a> ";
			echo " &nbsp;&nbsp; ";
			echo " <a href='lihat_buku.php'/>Lihat Buku</a>";
			echo " </td>";
			echo " </tr>";
		}
	?>
</table>









