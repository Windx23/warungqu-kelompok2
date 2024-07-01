<?php
session_start();
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}

include 'db.php';

// Ambil data kategori
$kategori_query = mysqli_query($conn, "SELECT * FROM tb_category");
$categories = [];
$category_names = [];
while ($row = mysqli_fetch_assoc($kategori_query)) {
	$categories[] = $row['category_id'];
	$category_names[] = $row['category_name'];
}

// Hitung jumlah produk per kategori
$product_counts = [];
foreach ($categories as $category_id) {
	$query = "SELECT COUNT(*) AS count FROM tb_product WHERE category_id = $category_id";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($result);
	$product_counts[] = $data['count'];
}

// Konversi data kategori ke format JSON untuk digunakan dalam chart
$category_names_json = json_encode($category_names);
$product_counts_json = json_encode($product_counts);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WarungQu</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

	<!-- Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
			<h3>Dashboard</h3>
			<div class="box">
				<h4>Selamat Datang <?php echo $_SESSION['a_global']['admin_name']; ?> di Toko Online WarungQu</h4>
			</div>

			<!-- Chart Section -->
			<div class="col-2 diagram-container">
				<h3>Diagram Batang: Jumlah Produk per Kategori</h3>
				<canvas id="barChart"></canvas>
			</div>

			<div class="col-2 diagram-container">
				<h3>Diagram Lingkaran: Persentase Jumlah Produk per Kategori</h3>
				<canvas id="pieChart"></canvas>
			</div>

			<div class="col-2 diagram-container">
				<h3>Diagram Garis: Perkembangan Jumlah Produk per Kategori</h3>
				<canvas id="lineChart"></canvas>
			</div>
		</div>
	</div>

	<script>
		// Diagram Batang
		var ctxBar = document.getElementById('barChart').getContext('2d');
		var barChart = new Chart(ctxBar, {
			type: 'bar',
			data: {
				labels: <?php echo $category_names_json; ?>,
				datasets: [{
					label: 'Jumlah Produk',
					data: <?php echo $product_counts_json; ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255, 99, 132, 1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});

		// Diagram Lingkaran
		var ctxPie = document.getElementById('pieChart').getContext('2d');
		var pieChart = new Chart(ctxPie, {
			type: 'pie',
			data: {
				labels: <?php echo $category_names_json; ?>,
				datasets: [{
					label: 'Persentase Jumlah Produk',
					data: <?php echo $product_counts_json; ?>,
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			}
		});

		// Diagram Garis
		var ctxLine = document.getElementById('lineChart').getContext('2d');
		var lineChart = new Chart(ctxLine, {
			type: 'line',
			data: {
				labels: <?php echo $category_names_json; ?>,
				datasets: [{
					label: 'Perkembangan Jumlah Produk',
					data: <?php echo $product_counts_json; ?>,
					fill: false,
					borderColor: 'rgba(75, 192, 192, 1)',
					tension: 0.1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2024 - <b>Bayu Nur Indra Jati Irawan & Badriatun Nabila.</b></small>
		</div>
	</footer>

</body>

</html>