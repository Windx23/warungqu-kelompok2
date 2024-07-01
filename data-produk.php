<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WarungQu</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<!-- Icon -->
	<link rel="icon" href="/img/icons.png" type="image/x-icon" />
</head>

<body>
	<!-- header -->
	<header>
		<img src="/img/icons.png" alt="">
		<div class="container">
			<h1><a href="dashboard.php">WarungQu</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="data-kategori.php">Data Kategori</a></li>
				<li><a href="data-produk.php">Data Produk</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Data Produk</h3>
			<div class="box">
				<p><a style="font-weight: 500;" href="tambah-produk.php" class="btn tambah-data">Tambah Data</a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="30px">No</th>
							<th width="30px">Kategori</th>
							<th width="40%;">Nama Produk</th>
							<th width=" 100px;">Harga</th>
							<th width="120px;">Gambar</th>
							<th width="10px">Status</th>
							<th width="100px">Aksi</>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
						if (mysqli_num_rows($produk) > 0) {
							while ($row = mysqli_fetch_array($produk)) {
						?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $row['category_name'] ?></td>
									<td><?php echo $row['product_name'] ?></td>
									<td>Rp. <?php echo number_format($row['product_price']) ?></td>
									<td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="produk/<?php echo $row['product_image'] ?>" width="70px"> </a></td>
									<td><?php echo ($row['product_status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></td>
									<td>
										<a href="edit-produk.php?id=<?php echo $row['product_id'] ?>" class="btn edit-data">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Yakin ingin hapus ?')" class="btn hapus-data">Hapus</a>
									</td>
								</tr>
							<?php }
						} else { ?>
							<tr>
								<td colspan="7">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2024 - <b>Bayu Nur Indra Jati Irawan & Badriatun Nabila.</b></small>
		</div>
	</footer>
</body>

</html>