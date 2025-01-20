<?php
// Visitor Analitics
if(!isset($_SESSION["login"]) && !isset($_SESSION["email"])){
	header ("location: ".DB_LOCAL.DB_LINK."/login/");
}
else {
	$email = $_SESSION["email"];
	$usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'") -> fetch_assoc();
	if($usersessionDB["user_position"] != "subscriber"){
	include "header-user.php";
?>
    <main id="main">
		<section class="breadcrumbs">
		  <div class="container">

			<ol>
			  <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>" title="Home">Home</a></li>
			  <li>Visitors</li>
			</ol>
			<h2>Visitors Analytic By JIFBW</h2>

		  </div>
		</section>
		<!--
		<section class="inner-page">
		  <div class="container"></div>
		</div>
		-->
		<section class="content">
		  <div class="container-fluid" style="max-width: 1750px;">
			<div class="row">
			  <div class="col-12 col-lg-3 col-md-4">
				<div class="small-box bg-info rounded-2">
				  <div class="inner">
					<?php $subscriber = $db->conn -> query("SELECT `user_id` FROM `mdl_user` WHERE `user_position` = 'subscriber'");
					$subscriberNUM = $subscriber -> num_rows;
					echo "<h3><b>".ANGKA($subscriberNUM)."</b></h3>";
					?>

					<p><b>User Registrations</b></p>
				  </div>
				  <div class="icon">
					<i class="fas fa-user-plus"></i>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-12 col-lg-3 col-md-4">
				<div class="small-box bg-info rounded-2">
				  <div class="inner">
					<?php $member = $db->conn -> query("SELECT `user_id` FROM `mdl_user` WHERE `user_position` = 'member'");
					$memberNUM = $member -> num_rows;
					echo "<h3><b>".ANGKA($memberNUM)."</b></h3>";
					?>

					<p><b>Exhibitor Registrations</b></p>
				  </div>
				  <div class="icon">
					<i class="fas fa-user-tie"></i>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-12 col-lg-3 col-md-4">
				<div class="small-box bg-info rounded-2">
				  <div class="inner">
					<?php $member2 = $db->conn -> query("SELECT `user_id` FROM `mdl_user` WHERE `user_position` = 'member' && `user_status`='published'");
					$memberNUM2 = $member2 -> num_rows;
					echo "<h3><b>".ANGKA($memberNUM2)."</b></h3>";
					?>

					<p><b>Exhibitor Published</b></p>
				  </div>
				  <div class="icon">
					<i class="fas fa-user-check"></i>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-12 col-lg-3 col-md-4">
				<div class="small-box bg-info rounded-2">
				  <div class="inner">
					<?php $guest = $db->conn -> query("SELECT * FROM `mdl_guest`");
					$guestNUM = $guest -> num_rows;
					echo "<h3><b>".ANGKA($guestNUM)."</b></h3>";
					?>

					<p><b>Guests at the Meeting Point</b></p>
				  </div>
				  <div class="icon">
					<i class="fas fa-users"></i>
				  </div>
				</div>
			  </div>
			  <!--
			  <div class="col-12 col-lg-3 col-md-4">
				<div class="small-box bg-warning rounded-2">
				  <div class="inner">
					<h3>44</h3>

					<p>User Chat to Exhibitor</p>
				  </div>
				  <div class="icon">
					<i class="fas fa-user-plus"></i>
				  </div>
				</div>
			  </div>-->
			</div>
			
<!------- Edite Disini ------>
			
			<div class="row">
			  <div class="col-12 mb-3">
				<div class="card">
				  <div class="card-header">
					<div class="d-flex justify-content-between">
					  <h3 class="card-title" style="font-size: 18px;"><b>Visitors in the last 70 days</b></h3>
					  <!--<a href="javascript:void(0);">View Report</a>-->
					</div>
				  </div>
				  <div class="card-body">
					<div class="d-flex">
					  <?php
					  $today     = new DateTime(); // today
					  $begin     = $today->sub(new DateInterval('P30D')); //created 30 days interval back
					  $end       = new DateTime();
					  $end       = $end->modify('+1 day'); // interval generates upto last day
					  $interval  = new DateInterval('P1D'); // 1d interval range
					  $daterange = new DatePeriod($begin, $interval, $end); // it always runs forwards in date
					  foreach ($daterange as $date) { // date object
						$tgl = $date->format("Y-m-d");
						$visitorsQR = $db->conn -> query("SELECT * FROM `mdl_visitors` WHERE `visitors_date` = '".$tgl."' GROUP BY `visitors_ip`");
						$visitorsNUM = $visitorsQR -> num_rows;
						$count[] = $visitorsNUM;
					  }
					  echo "
					  <p class='d-flex flex-column p-2' style='border: 1px solid #ccc;'>
						<span class='text-bold text-lg'><b>".ANGKA(array_sum($count))."</b></span>
						<span>Visitors in the last 30 days</span>
					  </p>";
					  ?>
					  <!--
					  <p class="ml-auto d-flex flex-column text-right">
						<span class="text-success">
						  <i class="fas fa-arrow-up"></i> 12.5%
						</span>
						<span class="text-muted">Since last week</span>
					  </p>-->
					</div>
					
					<div class="position-relative mb-4">
					  <canvas id="visitors-chart" height="300"></canvas>
					</div>
					
					<div class="row">
					  <div class="col-12 col-lg-6" style="font-size: 14px;">
						<span><b>Keterangan :</b></span>
						<span>Pada grafik statistik diatas, Visitor perhari kami hitung berdasarkan IP yang digunakan oleh pengunjung per-satu hari. Visitor bisa mengunjungi beberapa halaman dalam satu hari, pada grafik diatas kami tetap menghitungya sebagai 1 visitor. Ketika exhibitor masuk / login di dasboard profile, kami tidak menghitungnya sebagai visitor.</span>
					  </div>
					  <div class="col-12 col-lg-6">
						<div class="d-flex flex-row justify-content-end">
						  <span class="mr-4">
							<i class="fas fa-square text-primary"></i> last 30 days &nbsp;
						  </span>
						  <span>
							<i class="fas fa-square text-gray"></i> last 30 days yesterday
						  </span>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>

<!------- Edite Disini ------>

			<div class="row">
			  <div class="col-12 col-lg-4 mb-3">
				<div class="card card-info">
				  <div class="card-header p-2">
					<div class="d-flex justify-content-between">
					  <h3 class="card-title" style="font-size: 18px;"><b>Visitors By Country Name</b></h3>
					</div>
				  </div>
				  <div class="card-body p-1" style="font-size:14px;">
					<table class="table table-bordered table-striped table-hover bg-white global-table">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Country Name</th>
						  <th>Total Visitors</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
						$no = 1;
						$visitorsQR = $db->conn -> query("SELECT `visitors_country`, COUNT(*) AS COUNT FROM `mdl_visitors` GROUP BY `visitors_country` ORDER BY COUNT DESC");
						$visitorsNUM = $visitorsQR -> num_rows;
						while($visitorsDB = $visitorsQR -> fetch_assoc()){
							echo "<tr>
							  <td>".$no."</td>
							  <td>";
								if($visitorsDB["visitors_country"] == ""){
									echo "Undefined";
								} else {
									echo $visitorsDB["visitors_country"];
								}
							  echo "</td>
							  <td>".ANGKA($visitorsDB["COUNT"])."</td>
							</tr>";
						$no++;
						}
						?>
					  </tbody>
					  <tfoot>
						<tr>
						  <th>#</th>
						  <th>Country Name</th>
						  <th>Total Visitors</th>
						</tr>
					  </tfoot>
					</table>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-12 col-lg-4 mb-3">
				<div class="card card-info">
				  <div class="card-header p-2">
					<div class="d-flex justify-content-between">
					  <h3 class="card-title" style="font-size: 18px;"><b>Visitors By URL / Page</b></h3>
					</div>
				  </div>
				  <div class="card-body p-1" style="font-size:14px;">
					<table class="table table-bordered table-striped table-hover bg-white global-table">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Page Name</th>
						  <th>Total Visitors</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
						$no = 1;
						$visitorsQR = $db->conn -> query("SELECT `visitors_url_name`, `visitors_url`, COUNT(*) AS COUNT FROM `mdl_visitors` WHERE `visitors_url_name` NOT LIKE '%User%' && `visitors_url_name` NOT LIKE '%Company Profile%' && `visitors_url_name` != '' GROUP BY `visitors_url_name` ORDER BY COUNT DESC");
						$visitorsNUM = $visitorsQR -> num_rows;
						while($visitorsDB = $visitorsQR -> fetch_assoc()){
						  $urlname = $visitorsDB["visitors_url_name"];
						  if($urlname == "undefined" || $urlname == "Login" || $urlname == "Sign Up" || $urlname == "Register" || $urlname == "404 Page" || $urlname == "Reset Passwords" || $urlname == "Reset Passwords" || $urlname == "Verify Success | JIFBW"){
						  }
						  else{
							echo "<tr>
							  <td>".$no."</td>
							  <td>";
								if($urlname == ""){
									echo "Undefined";
								} else {
									$page = $urlname;
									if($page == "Exhibitors Platinum"){
										$page = "Platinum Exhibitors";
									}
									else if($page == "Exhibitors Gold"){
										$page = "Gold Exhibitors";
									}
									else if($page == "Exhibitors Silver"){
										$page = "Silver Exhibitors";
									} 
									else if($page == "Exhibitors Bronze"){
										$page = "Bronze Exhibitors";
									} else {
										$page = $urlname;
									}
									echo $page;
								}
							  echo "</td>
							  <td>".ANGKA($visitorsDB["COUNT"])."</td>
							</tr>";
						  }
						$no++;
						}
						?>
					  </tbody>
					  <tfoot>
						<tr>
						  <th>#</th>
						  <th>Page Name</th>
						  <th>Total Visitors</th>
						</tr>
					  </tfoot>
					</table>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-12 col-lg-4 mb-3">
				<div class="card card-info">
				  <div class="card-header p-2">
					<div class="d-flex justify-content-between">
					  <h3 class="card-title" style="font-size: 18px;"><b>Visitors By Exhibitor</b></h3>
					</div>
				  </div>
				  <div class="card-body p-1" style="font-size:14px;">
					<table class="table table-bordered table-striped table-hover bg-white global-table">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Company Profile</th>
						  <th>Total Visitors</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
						$no = 1;
						$visitorsQR = $db->conn -> query("SELECT `visitors_url_name`, `visitors_url`, COUNT(*) AS COUNT FROM `mdl_visitors` WHERE `visitors_url_name` LIKE '%Company Profile%' && `visitors_url_name` != '' GROUP BY `visitors_url_name` ORDER BY COUNT DESC");
						$visitorsNUM = $visitorsQR -> num_rows;
						while($visitorsDB = $visitorsQR -> fetch_assoc()){
							echo "<tr>
							  <td>".$no."</td>
							  <td>";
								if($visitorsDB["visitors_url_name"] == ""){
									echo "Undefined";
								} else {
									$company = $visitorsDB["visitors_url_name"];
									$company = str_replace("Company Profile ", "", $company);
									echo $company;
								}
							  echo "</td>
							  <td>".ANGKA($visitorsDB["COUNT"])."</td>
							</tr>";
						$no++;
						}
						?>
					  </tbody>
					  <tfoot>
						<tr>
						  <th>#</th>
						  <th>Company Profile</th>
						  <th>Total Visitors</th>
						</tr>
					  </tfoot>
					</table>
				  </div>
				</div>
			  </div>
			</div>
			
			<div class="row">
			  <div class="col-12 col-lg-4 mb-3">
				<div class="card card-info">
				  <div class="card-header p-2">
					<div class="d-flex justify-content-between">
					  <h3 class="card-title" style="font-size: 18px;"><b>Visitors By Search</b></h3>
					</div>
				  </div>
				  <div class="card-body p-1" style="font-size:14px;">
					<table class="table table-bordered table-striped table-hover bg-white global-table">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Search Keywords</th>
						  <th>Total Searching</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
						$no = 1;
						$visitorsQR = $db->conn -> query("SELECT `visitors_url`, COUNT(*) AS COUNT FROM `mdl_visitors` WHERE `visitors_url_name`='Search' GROUP BY `visitors_url` ORDER BY COUNT DESC");
						$visitorsNUM = $visitorsQR -> num_rows;
						while($visitorsDB = $visitorsQR -> fetch_assoc()){
							echo "<tr>
							  <td>".$no."</td>
							  <td>";
								if($visitorsDB["visitors_url"] == ""){
									echo "Undefined";
								} else {
								  $keywords = $visitorsDB["visitors_url"];
								  $keywords = str_replace("https://www.jifbw.com/search/?q=", "", $keywords);
								  $keywords = str_replace("+", " ", $keywords);
								  echo ucwords($keywords);
								}
							  echo "</td>
							  <td>".ANGKA($visitorsDB["COUNT"])."</td>
							</tr>";
						$no++;
						}
						?>
					  </tbody>
					  <tfoot>
						<tr>
						  <th>#</th>
						  <th>Search Keywords</th>
						  <th>Total Searching</th>
						</tr>
					  </tfoot>
					</table>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</section>
	</main>
<?php include "footer-user.php";
}
else {
  header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/");
}
};?>