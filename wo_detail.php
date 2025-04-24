<?php 
session_start();
include('includes/config.php');
include('includes/format_rupiah.php');
error_reporting(0);
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
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> 
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->

<?php 
$id=intval($_GET['id']);
$sql = "SELECT wedding_org.*, jenis.* from wedding_org, jenis WHERE wedding_org.id_jenis=jenis.id_jenis AND wedding_org.id_jasa='$id'";
$query = mysqli_query($koneksidb,$sql);
if(mysqli_num_rows($query)>0)
{
while($result = mysqli_fetch_array($query))
{ 
//	$_SESSION['brndid']=$result['id_merek'];  
?>  

<section id="listing_img_slider">
  <div><img src="admin/img/baju/<?php echo htmlentities($result['gambar1']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/baju/<?php echo htmlentities($result['gambar2']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/baju/<?php echo htmlentities($result['gambar3']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
</section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result['nama_jasa']);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p><?php echo htmlentities(format_rupiah($result['harga']));?> </p>/ <?php echo ($result['kategori'] == 'Katering' ? 'Pax' : 'Hari'); ?>
         
        </div>
      </div>
      <div class="col-md-9">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#infoModal">Lihat Informasi</button>
        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <t class="modal-body">
                <p>Nama Produk atau Layanan : <?php echo htmlentities($result['nama_jasa']);?></p>
                <p>Nama Vendor : <?php echo htmlentities($result['nama_vendor']);?></p>
                <p>Lokasi : <?php echo htmlentities($result['nama_lokasi']);?></p>
                <p>Jenis : <?php echo htmlentities($result['nama_jenis']);?></p>
                <p>Kategori : <?php echo htmlentities($result['kategori']);?></p>
                <?php if($result['kategori'] == 'Katering') { ?>
                  <p>Makanan : <?php echo htmlentities($result['m_makanan']);?></p>
                  <p>Minuman : <?php echo htmlentities($result['m_minuman']);?></p>
                  <p>Minimal Pembelian : <?php echo htmlentities($result['min_beli']);?></p>
                <?php } ?>
              </t>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#komentarModal">Tambah Komentar</button>
        <div class="modal fade" id="komentarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="simpan_komentar.php">
                  <input type="hidden" name="id_jasa" value="<?php echo $id; ?>">
                  <div class="form-group">
                    <label for="username">Nama Anda</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="form-group">
                    <label for="komentar">Komentar</label>
                    <textarea class="form-control" id="komentar" name="komentar" rows="3" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lihatKomentarModal">Lihat Komentar</button>
        <div class="modal fade" id="lihatKomentarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="komentar-list">
                  <?php
                  // Ambil komentar dari database
                  $sql_komentar = "SELECT * FROM komentar WHERE id_jasa='$id' ORDER BY tanggal DESC";
                  $query_komentar = mysqli_query($koneksidb, $sql_komentar);
                  while ($row = mysqli_fetch_array($query_komentar)) {
                      echo "<p><strong>" . htmlentities($row['username']) . ":</strong> " . htmlentities($row['komentar']) . " - " . htmlentities($row['tanggal']) . "</p>";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview" aria-controls="vehicle-overview" role="tab" data-toggle="tab">Deskripsi Produk dan Layanan</a></li>

            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">                
                <p><?php echo htmlentities($result['deskripsi']);?></p>
              </div>
              </div>
          </div>
        </div>
<?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3" ">

		  <div class="sidebar_widget ">
          <div class="widget_heading ">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Pesan Sekarang</h5>
          </div>
          <form method="get" action="booking.php">
			<input type="hidden" class="form-control" name="id" value=<?php echo $id;?> required>
			<?php if($_SESSION['ulogin'])
              {?>
              <div class="form-group" align="center">
                <button class="btn" align="center">Pesan Sekarang</button>
              </div>
              <?php } else { ?>
				<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login Untuk Menyewa</a>

              <?php } ?>
          </form>
        </div>
		<div class="share_vehicle" style="background-color: white; border: 1px solid black;">
          <p style="color: black; font-weight: bold;"> Bagikan: <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://example.com/wo_details.php?id=' . $id); ?>" target="_blank"><img src="assets/images/favicon-icon/png_facebook.png" alt="Facebook Logo" style="width: 30px; height: 30px;"></a> <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://example.com/wo_details.php?id=' . $id); ?>&text=<?php echo urlencode($result['nama_jasa']); ?>" target="_blank"><img src="assets/images/favicon-icon/png_twitter.png" alt="Twitter Logo" style="width: 30px; height: 30px;"></a> <a href="https://www.instagram.com/sharer/sharer.php?u=<?php echo urlencode('http://example.com/wo_details.php?id=' . $id); ?>" target="_blank"><img src="assets/images/favicon-icon/png_instagram.png" alt="Instagram Logo" style="width: 30px; height: 30px;"></a> </p>
        </div>
              </aside>
      <!--/Side-Bar--> 
    
         <!--/Batas Suci--> 
    <!--?php include('komentar/index.php'); ?>
    <div class="space-20"></div>
    <div class="divider"></div>    
      ?php include('komentar/tambah_komentar.php'); ?>
      ?php include('komentar/ambil_komentar.php'); ?>
      ?php include('komentar/db.php'); ?-->    
    
    <!--End Batas Suci-->
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Produk / Layanan Lainnya</h3>
      <div class="row">
<?php 
$sql1="SELECT wedding_org.*, jenis.* FROM wedding_org, jenis WHERE wedding_org.id_jenis=jenis.id_jenis AND wedding_org.id_jasa!='$id'";
$query1 = mysqli_query($koneksidb,$sql1);
if(mysqli_num_rows($query1)>0){
while($result = mysqli_fetch_array($query1))
{ 
 ?>      

        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="wo_details.php?id=<?php echo htmlentities($result['id_jasa']);?>"><img src="admin/img/baju/<?php echo htmlentities($result['gambar1']);?>" class="img-responsive" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="wo_details.php?id=<?php echo htmlentities($result['id_jasa']);?>"><?php echo htmlentities($result['nama_jasa']);?></a></h5>
              <p class="list-price"><?php echo htmlentities(format_rupiah($result['harga']));?></p>         
            </div>
          </div>
        </div>
 <?php }} ?>       

      </div>
    </div>
    <!--/Similar-Cars--> 
    
  </div>
</section>
<!--/Listing-detail--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>