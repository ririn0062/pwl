<?php 
session_start();
include 'koneksi.php';

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan login terlebih dahulu')</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

$idpembeli = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpembeli'");
$detpembeli = $ambil->fetch_assoc();

$id_pelanggan_beli = $detpembeli["id_pelanggan"];

$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli) 
{
	echo "<script>alert('Akses ditolak')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-default">
	<div class="container">
		<ul class="nav navbar-nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="keranjang.php">Keranjang</a></li>
			<!-- jika sudah login ada session pelanggan -->
			<?php if(isset($_SESSION["pelanggan"])): ?>
				<li><a href="riwayat.php">Riwayat Belanja</a> </li>
				<li><a href="logout.php">Logout</a> </li>
			<!-- jika sudah login ada session pelanggan -->
			<?php else: ?>
				<li><a href="login.php">Login</a></li>	
				<li><a href="daftar.php">Daftar</a></li>	
			<?php endif ?>

			<li><a href="checkout.php">Checkout</a></li>
		</ul>
	</div>
</nav>

<div class="container">
	<h2>Konfirmasi Pembayaran</h2>
	<p>Kirim bukti pembayaran Adnda disini</p>
	<div class="alert alert-info">Total yang harus dibayar : <strong>Rp. <?php echo number_format($detpembeli['total_pembelian']); ?></strong></div>


	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama Penyetor</label>
			<input type="text" class="form-control" name="nama" required>
		</div>
		<div class="form-group">
			<label>Bank</label>
			<select class="form-control" name="id_ongkir">
						<option value="">Bank</option>
						<option value="BRI">BRI</option>
						<option value="BNI">BNI</option>
			</select>
		</div>
		<div class="form-group">
			<label>Jumlah</label>
			<input type="number" class="form-control" name="jumlah" min="1" required>
		</div>
		<div class="form-group">
			<label>Foto Bukti</label>
			<input type="file" class="form-control" name="bukti" required>
			<p class="text-danger">Foto Bukti Harus JPG, Ukuran Maksimal 2MB</p>
		</div>
		<button class="btn btn-primary" name="kirim">Kirim</button>
	</form>
</div>

<?php 

if (isset($_POST["kirim"])) 
{
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namabukti");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");


	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpembeli','$nama','$bank','$jumlah','$tanggal','$namabukti')");

	$koneksi->query("UPDATE pembelian SET status_pembelian='Sudah kirim pembayaran' WHERE id_pembelian='$idpembeli'");

	echo "<script>alert('Terimakasih Telah Melakukan Pembyaran, Pesanan Anda Akan Segera di Kirim')</script>";
	echo "<script>location='riwayat.php';</script>";

}

 ?>
 
 </body>
 </html>