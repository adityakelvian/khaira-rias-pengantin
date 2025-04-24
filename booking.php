<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{
	$tglnow   = date('Y-m-d');
	$tglmulai = strtotime($tglnow);
	$jmlhari  = 86400*1;
	$tglplus  = $tglmulai+$jmlhari;
	$now = date("Y-m-d",$tglplus);

	if(isset($_POST['submit'])){
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
		$id=$_POST['id'];
		$pickup=$_POST['pickup'];
		$ukuran=$_POST['ukuran'];

		//cek size	
		//cek
		$sql 	= "SELECT kode_booking FROM cek_booking WHERE tgl_booking between '$fromdate' AND '$todate' AND id_jasa='$id' AND ukuran='$ukuran' AND status!='Cancel'";
		$query 	= mysqli_query($koneksidb,$sql);
		$tersewa = mysqli_num_rows($query);
		if($tersewa>0){
			$sql2 	= "SELECT * FROM jasa WHERE id_jasa='$id'";
			$query2 	= mysqli_query($koneksidb,$sql2);
			$res2 = mysqli_fetch_array($query2);
			$stok1 = $res2[$ukuran];
			if($tersewa<$stok1){
				echo "<script type='text/javascript'> document.location = 'booking_ready.php?id=$id&mulai=$fromdate&selesai=$todate&pickup=$pickup&size=$ukuran'; </script>";
			}else{
				echo " <script> alert ('Produk atau Layanan tidak tersedia di tanggal yang anda pilih, silahkan pilih tanggal atau ukuran lain!'); 
				</script> ";
			}
		}else{
			$sql1 	= "SELECT * FROM jasa WHERE id_jasa='$id'";
			$query1 	= mysqli_query($koneksidb,$sql1);
			$res1 		= mysqli_fetch_array($query1);
			$stok 		= $res1[$ukuran];

			if($stok>0){
				echo "<script type='text/javascript'> document.location = 'booking_ready.php?id=$id&mulai=$fromdate&selesai=$todate&pickup=$pickup&size=$ukuran'; </script>";
			}else{
				echo " <script> alert ('Produk atau Layanan tidak tersedia di tanggal yang anda pilih, silahkan pilih tanggal atau ukuran lain!.'); 
				</script> ";
			}
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title><?php echo $pagedesc;?></title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="admin/img/fav.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<?php 
$id=$_GET['id'];
$useremail=$_SESSION['login'];
$sql1 = "SELECT jasa.*,jenis.* FROM jasa,jenis WHERE jasa.id_jenis=jenis.id_jenis and jasa.id_jasa='$id'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
?>
<script type="text/javascript">
function valid()
{
	if(document.sewa.todate.value < document.sewa.fromdate.value){
		alert("Tanggal selesai harus lebih besar dari tanggal mulai sewa!");
		return false;
	}
	if(document.sewa.fromdate.value < document.sewa.now.value){
		alert("Tanggal sewa minimal H-1!");
		return false;
	}
	if(document.sewa.fullname.value == "" || document.sewa.address.value == "" || document.sewa.phone.value == ""){
		alert("Semua field harus diisi!");
		return false;
	}
	return true;
}
</script>

	<section class="user_profile inner_pages">
	<div class="container">
	<div class="col-md-6 col-sm-8">
	      <div class="product-listing-img"><img src="admin/img/baju/<?php echo htmlentities($result['gambar1']);?>" class="img-responsive" alt="Image" /> </a> </div>
          <div class="product-listing-content">
            <h5><?php echo htmlentities($result['nama_jasa']);?></a></h5>
            <p class="list-price"><?php echo htmlentities(format_rupiah($result['harga']));?> / Hari</p>
          </div>	
	</div>
	
	<div class="user_profile_info">	
		<div class="col-md-12 col-sm-10">
        <form method="post" name="sewa" onSubmit="return valid();"> 
			<input type="hidden" class="form-control" name="id"  value="<?php echo $id;?>"required>
            <div class="form-group">
			<label>Tanggal Mulai</label>
				<input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
				<input type="hidden" name="now" class="form-control" value="<?php echo $now;?>">
            </div>
            <div class="form-group">
			<label>Tanggal Selesai</label>
				<input type="date" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
            </div>
			<div class="form-group">
			<label>Ukuran</label><br/>
				<select class="form-control" name="ukuran" required>
					<option value="">== Pilih Ukuran ==</option>
					<option value="s">S</option>
					<option value="m">M</option>
					<option value="l">L</option>
					<option value="xl">XL</option>
				</select>
            </div>
			<div class="form-group">
			<label>Metode Pickup</label><br/>
				<select class="form-control" name="pickup" required>
					<option value="">== Metode Pickup ==</option>
					<option value="Ambil Sendiri">Ambil Sendiri</option>
					<option value="Kurir">Kurir</option>
				</select>
            </div>
			<div class="form-group">
				<label>Nama Lengkap</label>
				<input type="text" class="form-control" name="fullname" required>
			</div>
			<div class="form-group">
				<label>Alamat Lengkap</label>
				<textarea class="form-control" name="address" required></textarea>
			</div>
			<div class="form-group">
				<label>Nomor Telepon</label>
				<input type="text" class="form-control" name="phone" required>
			</div>
			<div class="form-group">
				<label>Pesan untuk Vendor</label>
				<textarea class="form-control" name="message"></textarea>
			</div>
			<div class="form-group">
				<label>Jumlah Pesanan</label>
				<input type="number" class="form-control" name="quantity" min="1" required>
			</div>
			<div class="form-group">
				<label>Tanggal Pemesanan</label>
				<input type="date" class="form-control" name="order_date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
			</div>
			<div class="form-group">
                <input type="submit" name="submit" value="Cek Ketersediaan" class="btn btn-block">
            </div>
        </form>
		</div>
		</div>
      </div>
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>