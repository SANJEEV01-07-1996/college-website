<?php include_once('header.php'); ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="3000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <div class="carousel-inner" role="listbox">

        <?php 
            $query = mysqli_query($conn, "SELECT * FROM slider ORDER By sdr_id ASC");
            while(@$row = mysqli_fetch_array($query)){
              $file = $row['file'];
              $heading = $row['heading'];
              $description = $row['description'];
          ?>
          <div class="carousel-item active" style="background-image: url(assets/img/slider/<?php echo $file; ?>);">
            <?php if($heading != ""){ ?>
              <div class="carousel-container">
                <div class="carousel-content animate__animated animate__fadeInUp">
                  <h2><?php echo $heading; ?></h2>
                  <p><?php echo substr($description, 0, 450); ?></p>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section><!-- End Hero -->

  <main id="main">
    <section id="blog" class="blog" style="margin-top: -20px;">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-6 entries">

            <article class="entry">

              <div class="entry-img">
                <img src="assets/img/director/director.jpg" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a>Director of BIT Sindri</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a">Prof. (Dr.) D.K Singh</a></li><li class="d-flex align-items-center"><i class="bi bi-phone"></i> <a>+91-326-2350495, +91-326-2350496</a></li><li class="d-flex align-items-center"><i class="fa fa-envelope-o"></i> <a>director@bitsindri.ac.in </a></li>
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  BIT Sindri is a premier technical institution offering undergraduate and postgraduate courses in various disciplines of engineering approved by AICTE, New Delhi. It is wholly owned and administered by the Department of Science and Technology, Govt of Jharkhand, Ranchi.
                </p>

                <h4>Directors Message</h4>
                <p>                  
                  Welcome to BIT Sindri. It gives me great pride and satisfaction to write about BIT which has served as nation’s flagship institute of technical education for more than six decades now. We are proud to be preparing the dynamic leaders, people who can make a difference and a pool of intellectuals who can contribute to the workforce of tomorrow.
                </p>
                <a href="#" class="">View More...</a>
              </div>

            </article><!-- End blog entry -->

          </div><!-- End blog entries list -->

          <div class="col-lg-6">

            <div class="sidebar">
              <h3 class="sidebar-title text-center">NOTICE BOARD</h3>

              <div class="noticebar">
                <table>
                  <?php 
                    $cdt = date('Y-m-d H:i:s');
                    $query = mysqli_query($conn, "SELECT * FROM notice WHERE start_date_time<=LOCALTIMESTAMP() AND end_date_time>=LOCALTIMESTAMP() ORDER BY notice_id DESC");
                    while(@$row = mysqli_fetch_array($query)){
                      $msg = $row['msg'];
                      $file = $row['file']; 
                      $link = $row['link']; 
                      $sdt = $row['start_date_time'];
                      $edt = $row['end_date_time'];
                      $dcs_days = intval((strtotime($cdt)-strtotime($sdt))/(60*60*24));
                  ?>
                  <tr class="rw">
                    <td>
                      <i class="fa fa-hand-o-right text-danger"></i>

                      <?php if($link==""){ ?>
                        <a href='./assets/notice/<?php echo $file; ?>' target="_blank" class="n-c"><?php echo $msg; ?>
                      <?php }else{ ?>
                        <a href='<?php echo $link; ?>' target="_blank" class="n-c"><?php echo $msg; ?>
                      <?php  } ?>

                          <sub style="color: #ababab;">[ <time><?php echo substr($sdt, 0,10); ?></time> ]</sub>
                          <?php if($dcs_days <= 7){ ?>
                            <img src="assets/img/icon/new3.gif" alt="" class="notice-icon">
                          <?php } ?>
                        </a>
                    </td>
                  </tr>
                <?php } ?>
                </table>
              </div>

            </div><!-- End sidebar -->
          </div><!-- End sidebar -->

        </div>

      </div>
    </section>

    <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Our Departments</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix carousel" data-aos="fade-up" data-flickity='{"autoPlay": true, "groupCells": true }'>

          <div class="col-lg-3 col-md-4 col-6 carousel-cell">

            <div class="achievement">
              <a href="civil.php">
              <img src="assets/img/dept/civil.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="chemical.php">
              <img src="assets/img/dept/chemical.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="cse.php">
              <img src="assets/img/dept/cse.jpg" class="img-fluid" alt="">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="ece.php">
              <img src="assets/img/dept/ece.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>
           <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="electrical.php">
              <img src="assets/img/dept/electrical.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>
           <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="it.php">
              <img src="assets/img/dept/it.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>
           <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="mach.php">
              <img src="assets/img/dept/mach.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>
           <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="metal.php">
              <img src="assets/img/dept/metal.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>
           <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="mining.php">
              <img src="assets/img/dept/mining.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 carousel-cell">
            <div class="achievement">
              <a href="production.php">
              <img src="assets/img/dept/production.jpg" class="img-fluid" alt="">
            </a>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ======= Services Section ======= -->
    


    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Achievement</h2>
        </div>        
        <div class="row no-gutters clients-wrap clearfix carousel" data-aos="fade-up" data-flickity='{"autoPlay": true, "groupCells": true }'>
          <?php 
            $query = mysqli_query($conn, "SELECT * FROM achievement ORDER BY acmt_id DESC");
            while(@$row = mysqli_fetch_array($query)){
              $file = $row['file'];
          ?>
            <div class="col-lg-3 col-md-4 col-6 carousel-cell">
              <div class="achievement">
                <img src="assets/img/achievement/<?php echo $file; ?>" class="img-fluid" alt="">
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section><!-- End Our Clients Section -->

  </main><!-- End #main -->

  <?php include_once('footer.php'); ?>
