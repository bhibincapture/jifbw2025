<?php
/*
// Template Name: Hotels
*/

include "header.php";

?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>" title="Home">Home</a></li>
          <li><?php echo $pageDB["page_title"];?></li>
        </ol>
        <h1><?php echo $pageDB["page_title"];?></h1>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div class="col-12 col-lg-12 entries">
		    <article class="entry">
			  <h2 class="entry-title mb-3">10 Best Hotels Recomended in Jepara</h2>
			  <div class="row">
			    <div class="col-4 col-lg-4 p-1">
                  <a href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/DSCF3904.jpg" data-gallery="TilemBeachHotel" class="portfokio-lightbox" title="Tilem Beach Hotel and Resort Outdoor">
                    <img src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/DSCF3904-450x300.jpg" alt="Tilem Beach Hotel and Resort Outdoor" class="img-fluid">
                  </a>
                </div>
			    <div class="col-4 col-lg-4 p-1">
                  <a href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/DSCF3892.jpg" data-gallery="TilemBeachHotel" class="portfokio-lightbox" title="Tilem Beach Hotel and Resort Swimming Pool">
                    <img src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/DSCF3892-450x300.jpg" alt="Tilem Beach Hotel and Resort Swimming Pool" class="img-fluid">
                  </a>
                </div>
			    <div class="col-4 col-lg-4 p-1">
                  <a href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/DSCF2626.jpg" data-gallery="TilemBeachHotel" class="portfokio-lightbox" title="Tilem Beach Hotel and Resort Room">
                    <img src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/DSCF2626-450x300.jpg" alt="Tilem Beach Hotel and Resort Room" class="img-fluid">
                  </a>
                </div>
			    <div class="col-12 col-lg-12 mb-4 mt-2">
				  <h3 class="entry-title">1. Tilem Beach Hotel and Resort</h3>
				  <p style="color: #ffc107"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                  <p><i class="fas fa-map-marker-alt"></i> <b>Addres</b> : Jl. Tlk. Awur No.42, Telukawur, Kec. Tahunan, Kabupaten Jepara, Jawa Tengah 59427</p>
				  <p><i class="fas fa-phone-square"></i> <b>Telephone</b> : +62291 5900955</p>
				  <p><i class="far fa-envelope"></i> <b>Email</b> : fo@tilemresort.com</p>
				  <p><i class="fas fa-globe"></i> <b>Website</b> : <a href="https://www.tilemresort.com/" title="Tilem Beach Hotel" target="_blank">www.tilemresort.com</a></p>
				  <p><i class="fas fa-share-square"></i> <b>Go to Location</b> : <a href="https://maps.app.goo.gl/wQbg7ac87wTDdb476" title="Tilem Beach Hotel and Resort" target="_blank">maps.app.goo.gl/wQbg7ac87wTDdb476</a></p>
                </div>
				
				<hr></hr>
				
			    <div class="col-4 col-lg-4 p-1">
                  <a href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/49943170.jpg" data-gallery="SyailendraHotel" class="portfokio-lightbox" title="Syailendra Hotel Outdoor">
                    <img src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/49943170-450x300.jpg" alt="Syailendra Hotel Outdoor" class="img-fluid">
                  </a>
                </div>
			    <div class="col-4 col-lg-4 p-1">
                  <a href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/49975709.jpg" data-gallery="SyailendraHotel" class="portfokio-lightbox" title="Syailendra Hotel Indoor">
                    <img src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/49975709-450x300.jpg" alt="Syailendra Hotel Indoor" class="img-fluid">
                  </a>
                </div>
			    <div class="col-4 col-lg-4 p-1">
                  <a href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/47263870.jpg" data-gallery="SyailendraHotel" class="portfokio-lightbox" title="Syailendra Hotel Room">
                    <img src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-content/themes/jifbw2024/assets/img/hotels/47263870-450x300.jpg" alt="Syailendra Hotel Room" class="img-fluid">
                  </a>
                </div>
			    <div class="col-12 col-lg-8 mb-4 mt-2">
				  <h3 class="entry-title">2. Syailendra Hotel</h3>
				  <p style="color: #ffc107"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                  <p><i class="fas fa-map-marker-alt"></i> <b>Addres</b> : Jl. HOS. Cokroaminoto No.27, Kauman, Kec. Jepara, Kabupaten Jepara, Jawa Tengah 59417</p>
				  <p><i class="fas fa-phone-square"></i> <b>Telephone</b> : +62291 4297688</p>
				  <p><i class="fab fa-whatsapp"></i> <b>WhatApp</b> : +6287831133999</p>
				  <p><i class="fab fa-instagram"></i> <b>Instagram</b> : <a href="https://www.instagram.com/syailendrahotel/" title="Syailendra Hotel" target="_blank">www.instagram.com/syailendrahotel/</a></p>
				  <p><i class="fas fa-share-square"></i> <b>Go to Location</b> : <a href="https://maps.app.goo.gl/xL3skAjuvPP4k7ei6" title="Syailendra Hotel" target="_blank">maps.app.goo.gl/xL3skAjuvPP4k7ei6</a></p>
                </div>
				
				<hr></hr>
				
			    <div class="col-4 col-lg-4 mb-4 mt-4">
                  <img src="<?php echo FOLDER_THEMES;?>/assets/img/hotels/DSeason-Premiere-Hotel-Jepara-Exterior.jpg" alt="Hotel d'Season Premiere Jepara" class="img-fluid">
                </div>
			    <div class="col-8 col-lg-8 mb-4 mt-4">
				  <h3 class="entry-title">3. Hotel d'Season Premiere Jepara</h3>
				  <p style="color: #ffc107"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                  <p><i class="fas fa-map-marker-alt"></i> <b>Addres</b> : Jalan Pariwisata No.9, Rw. II, Bandengan, Kec. Jepara, Kabupaten Jepara, Jawa Tengah 59412</p>
				  <p><i class="fas fa-phone-square"></i> <b>Telephone</b> : +62 291 7519888</p>
                </div>
				
				<hr></hr>
				
			    <div class="col-4 col-lg-4 mb-4 mt-4">
                  <img src="<?php echo FOLDER_THEMES;?>/assets/img/hotels/Palm-Beach-Resort-Jepara.jpg" alt="The Palm Beach Resort Jepara" class="img-fluid">
                </div>
			    <div class="col-8 col-lg-8 mb-4 mt-4">
				  <h3 class="entry-title">4. The Palm Beach Resort Jepara</h3>
				  <p style="color: #ffc107"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                  <p><i class="fas fa-map-marker-alt"></i> <b>Addres</b> : Jalan Tirta Samudera No.191, Rw. I, Bandengan, Kec. Jepara, Kabupaten Jepara, Jawa Tengah 59432</p>
				  <p><i class="fas fa-phone-square"></i> <b>Telephone</b> : +62 823 2415 6171</p>
                </div>
				
				<hr></hr>
				
			    <div class="col-4 col-lg-4 mb-4 mt-4">
                  <img src="<?php echo FOLDER_THEMES;?>/assets/img/hotels/villa-suerte-jepara.jpg" alt="Villa Suerte" class="img-fluid">
                </div>
			    <div class="col-8 col-lg-8 mb-4 mt-4">
				  <h3 class="entry-title">5. Villa Suerte</h3>
				  <p style="color: #ffc107"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                  <p><i class="fas fa-map-marker-alt"></i> <b>Addres</b> : Rw. 01, Mororejo, Kec. Mlonggo, Kabupaten Jepara, Jawa Tengah 59452</p>
				  <p><i class="fas fa-phone-square"></i> <b>Telephone</b> : +62 813 9217 9361</p>
                </div>
				
				<hr></hr>
				
			    <div class="col-4 col-lg-4 mb-4 mt-4">
                  <img src="<?php echo FOLDER_THEMES;?>/assets/img/hotels/Jepara-Garden-Resort-Exterior.jpg" alt="Jepara Garden Resort" class="img-fluid">
                </div>
			    <div class="col-8 col-lg-8 mb-4 mt-4">
				  <h3 class="entry-title">6. Jepara Garden Resort</h3>
				  <p style="color: #ffc107"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                  <p><i class="fas fa-map-marker-alt"></i> <b>Addres</b> : Jl. Marsam, Ngabul, Kec. Tahunan, Kabupaten Jepara, Jawa Tengah 59428</p>
				  <p><i class="fas fa-phone-square"></i> <b>Telephone</b> : +62 821 3481 9073</p>
                </div>
				
				<hr></hr>
				
			    <div class="col-4 col-lg-4 mb-4 mt-4">
                  <img src="<?php echo FOLDER_THEMES;?>/assets/img/hotels/ocean-view-resort.jpg" alt="Ocean View Residence" class="img-fluid">
                </div>
			    <div class="col-8 col-lg-8 mb-4 mt-4">
				  <h3 class="entry-title">7. Ocean View Residence</h3>
				  <p style="color: #ffc107"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                  <p><i class="fas fa-map-marker-alt"></i> <b>Addres</b> : Jl. Sunan Mantingan, Tegalsambi, Kec. Tahunan, Kabupaten Jepara, Jawa Tengah 59427</p>
				  <p><i class="fas fa-phone-square"></i> <b>Telephone</b> : +62 812 2788 9918</p>
                </div>
				
				<hr></hr>
				
			    <div class="col-4 col-lg-4 mb-4 mt-4">
                  <img src="<?php echo FOLDER_THEMES;?>/assets/img/hotels/Belaya-Hotel-Jepara.jpg" alt="Belaya Hotel" class="img-fluid">
                </div>
			    <div class="col-8 col-lg-8 mb-4 mt-4">
				  <h3 class="entry-title">8. Belaya Hotel</h3>
				  <p style="color: #ffc107"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                  <p><i class="fas fa-map-marker-alt"></i> <b>Addres</b> : Jl. Dr. Sutomo No.13-15, Kauman, Kec. Jepara, Kabupaten Jepara, Jawa Tengah 59417</p>
				  <p><i class="fas fa-phone-square"></i> <b>Telephone</b> : +62 812-1214-9442</p>
                </div>
				
				<hr></hr>
				
              </div>
			  
			</article>
          </div><!-- End blog entries list -->
		  
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include "footer.php";?>