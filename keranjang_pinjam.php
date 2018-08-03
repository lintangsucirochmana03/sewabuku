<?php
	$buku_pilih="0";
	if (isset($_COOKIE['keranjang'])){
		$buku_pilih=$_COOKIE['keranjang'];
	}
	if(isset($_GET['kode'])){
		$kode = $_GET['kode'];
		$buku_pilih = $buku_pilih ."," . $kode;
		setcookie('keranjang',$buku_pilih,time()+3600);
	}
	include "koneksi.php";
	$sql = "select * from buku where kode in (".$buku_pilih.")
			order by kode desc";
	$hasil = mysqli_query ($kon, $sql);
	if (!$hasil)
		die("Gagal query..".mysqli_error($kon));
?>
<h2>KERANJANG PEMINJAMAN</h2>

<table border="1">
	<tr>
		<th>FOTO</th>
		<th>Judul Buku</th>
		<th>Pengarang</th>
		<th>Operasi</th>
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
			echo " <a href='".$_SERVER['PHP_SELF']."?kode=".
					$row['kode']."'>BATAL</a>";
			echo " </td>";
			echo " </tr>";
		}
	?>
</table>