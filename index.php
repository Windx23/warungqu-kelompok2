<?php
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
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
		<h1><a class="navbar-logo" href="index.php">WarungQu</a></h1>
		<div class="container">
			<ul>
				<li><a href="login.php">Login Admin</a></li>
				<li><a href="produk.php">Produk</a></li>
			</ul>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- category -->
	<div class="section">
		<div class="container">
			<h3>Kategori</h3>
			<div class="box">
				<?php
				$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
				if (mysqli_num_rows($kategori) > 0) {
					while ($k = mysqli_fetch_array($kategori)) {
				?>
						<a href="produk.php?kat=<?php echo $k['category_id'] ?>">
							<div class="col-5">
								<img src="img/<?php echo $k['category_image'] ?>" width="50px" style="margin-bottom:5px;">
								<p><?php echo $k['category_name'] ?></p>
							</div>
						</a>
					<?php }
				} else { ?>
					<p>Kategori tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- new product -->
	<div class="section">
		<div class="container">
			<h3>Produk Terbaru</h3>
			<div class="box">
				<?php
				$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
				if (mysqli_num_rows($produk) > 0) {
					while ($p = mysqli_fetch_array($produk)) {
				?>
						<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
							<div class="col-4">
								<img src="produk/<?php echo $p['product_image'] ?>">
								<p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
								<p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
							</div>
						</a>
					<?php }
				} else { ?>
					<p>Produk tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- contact section -->
	<div class="contact-section">
		<div class="container">
			<div class="card">
				<div class="card-left">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.378919242786!2d106.69154909999999!3d-6.3449512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e50078ae00b1%3A0x81a60674ba49b072!2sUnpam%20Viktor!5e0!3m2!1sid!2sid!4v1719458911820!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
				</div>
				<div class="card-right">
					<form action="">
						<div class="input-group">
							<i data-feather="user"></i>
							<input type="text" placeholder="Nama" />
						</div>
						<div class="input-group">
							<i data-feather="mail"></i>
							<input type="text" placeholder="Email" />
						</div>
						<div class="input-group">
							<i data-feather="phone"></i>
							<input type="text" placeholder="No HP" />
						</div>
						<button class="btn" type="submit"><span>Kirim Pesan</span></button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?php echo $a->admin_telp ?></p>
			<small>Copyright &copy; 2024 - <b>Bayu Nur Indra Jati Irawan & Badriatun Nabila.</b></small>
		</div>
	</div>
</body>

</html>