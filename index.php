<?php include 'header.php' ?>
<div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100 d-block" src="img\caroussel-8.jpg" alt="Image" style="object-fit: cover; height: 100vh;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
                                <h1 class="display-3 text-white mb-4 animated slideInDown">A Luxurious Experience with Krishna Trading Company</h1>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
    <img class="w-100 d-block" src="img\caroussel-6.jpg" alt="Image" style="object-fit: cover; height: 100vh;">
    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
        <div class="p-3 text-center" style="max-width: 700px;">
            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
            <h1 class="display-3 text-white mb-4 animated slideInDown">Discover A Brand New StoneTouch</h1>
        </div>
    </div>
</div>
<div class="carousel-item">
    <img class="w-100 d-block" src="img\caroussel-7.jpg" alt="Image" style="object-fit: cover; height: 100vh;">
    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
        <div class="p-3 text-center" style="max-width: 700px;">
            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
            <h1 class="display-3 text-white mb-4 animated slideInDown">Discover A Brand New StoneTouch</h1>
        </div>
    </div>
</div>

<div class="carousel-item">
    <img class="w-100 d-block" src="img\coroussel-3.jpg" alt="Image" style="object-fit: cover; height: 100vh;">
    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
        <div class="p-3 text-center" style="max-width: 700px;">
            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
            <h1 class="display-3 text-white mb-4 animated slideInDown">Discover A Brand New StoneTouch</h1>
        </div>
    </div>
</div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>   
        
        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                        <h1 class="mb-4">Welcome to <span class="text-primary text-uppercase">Krishna Trading Company</span></h1>
                        <p class="mb-4">your trusted source for premium tiles, sanitary ware, CP fittings, electrical, and plumbing solutions.<br>
                            We offer a curated selection of stylish, durable products that elevate both residential and commercial spaces. Whether you're building or renovating, our expert team is here to help you create smart, beautiful, and lasting interiors – all under one roof.</p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">100</h2>
                                        <p class="mb-0">Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">1000</h2>
                                        <p class="mb-0">Clients</p>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img\tiles.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img\sanitary.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img\plumbings.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img\cp-fittings.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        
         <section class="our-collection" id="sector-collection">
  <div class="container">
    <div class="text-center mb-4">
      <h6 class="section-title text-primary text-uppercase">Our Sectors</h6>
      <h1 class="mb-3">Explore Our <span class="text-primary text-uppercase">Sectors</span></h1>

      <!-- Filter Buttons -->
      <div class="btn-group filter-btns mb-4">
        
        <?php
        $cat = $conn->query("SELECT * FROM sectors ORDER BY sector_name ASC");
        while ($row = $cat->fetch_assoc()) {
          //echo '<button class="btn btn-outline-dark" data-filter="sector-' . $row['id'] . '">' . $row['sector_name'] . '</button>';
        }
        ?>
      </div>
    </div>

    <div class="row" id="sector-cards">
      <?php
      $query = "SELECT * FROM sectors ORDER BY id ASC";
      $result = $conn->query($query);
      while ($row = $result->fetch_assoc()) {
        $image = htmlspecialchars($row['sector_image']);
        $name = htmlspecialchars($row['sector_name']);
        $link = "sectors.php?sector_id=" . $row['id'];
        $id = $row['id'];
      ?>
        <div class="col-md-4 mb-4 sector-card sector-sector-<?= $id ?>" data-aos="fade-up">
          <a href="<?= $link ?>" class="text-decoration-none text-dark">
            <div class="glass-card p-3 text-center rounded shadow" style="backdrop-filter: blur(8px); background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3);">
              <img src="<?= $image ?>" alt="<?= $name ?>" class="img-fluid mb-3" style="height: 200px; object-fit: cover; border-radius: 8px;">
              <h5 class="text-dark"><?= $name ?></h5>

            </div>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<!-- Our Collection Section End -->
<!-- Catalogue Section -->
<style>
  .catalogue-bg {
    background: url('img/caroussel-8.jpg') no-repeat center center/cover;
    position: relative;
    padding: 80px 0;
    z-index: 1;
  }

  .catalogue-bg::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.2);
    z-index: -1;
  }

  .glass-card {
    backdrop-filter: blur(8px);
    background: rgba(255, 255, 255, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.5);
    transition: transform 0.3s ease;
  }

  .glass-card:hover {
    transform: translateY(-5px);
  }

  .catalogue-logo {
    max-height: 100px;
    object-fit: contain;
  }

  .catalogue-preview {
    max-height: 150px;
    object-fit: cover;
    border-radius: 8px;
  }
</style>

<!-- Section wrapper with background -->
<section class="catalogue-bg">
  <div class="container">
    <div class="text-center mb-5">
      <h6 class="section-title text-primary text-uppercase">Our Designs</h6>
      <h1>Explore Our <span class="text-primary text-uppercase">Designs</span></h1>
    </div>

    <?php
    $res = $conn->query("SELECT * FROM catalogues ORDER BY id DESC");
    if ($res->num_rows > 0):
        while ($row = $res->fetch_assoc()):
    ?>
    <div class="row justify-content-center mb-4">
      <div class="col-md-10">
        <div class="glass-card p-4 rounded shadow">
          <div class="row align-items-center">
            <div class="col-md-3 text-center mb-3 mb-md-0">
              <img src="<?= htmlspecialchars($row['logo_path']) ?>" alt="<?= htmlspecialchars($row['brand_name']) ?> Logo" class="img-fluid catalogue-logo">
            </div>

            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              <h4 class="mb-2 text-dark"><?= htmlspecialchars($row['title']) ?></h4>
              <p class="mb-0 text-dark"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
              <?php if (!empty($row['pdf_path'])): ?>
                <a href="view_pdf.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary mt-3" target="_blank">📄 View PDF</a>
              <?php endif; ?>
            </div>

            <div class="col-md-3 text-center">
              <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['title']) ?> Preview" class="img-fluid catalogue-preview">
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
      <div class="text-center"><p>No catalogues available.</p></div>
    <?php endif; ?>
  </div>
</section>

         <!-- Testimonial Start -->
<div class="container-xxl testimonial my-5 py-5 bg-dark wow zoomIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="owl-carousel testimonial-carousel py-5">
            <?php
            include 'db.php'; // DB connection

            $sql = "SELECT * FROM testimonials ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="img/<?php echo htmlspecialchars($row['photo']); ?>" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($row['name']); ?></h6>
                                <small><?php echo htmlspecialchars($row['profession']); ?></small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-white text-center'>No testimonials yet.</p>";
            }
            ?>
        </div>
    </div>
</div>
<!-- Testimonial End -->


<?php
include 'db.php'; // Adjust path if needed

$result = $conn->query("SELECT * FROM partners ORDER BY id DESC");
?>
<style>
  .partners-section {
    background: url('img/caroussel-4.jpg') no-repeat center center/cover;
    position: relative;
    padding: 80px 0;
    z-index: 1;
  }

  .partners-section::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.2); /* light overlay */
    z-index: -1;
  }

  .partner-box {
    height: 120px;
    width: 180px;
    background: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin: 0 auto;
    transition: transform 0.3s ease;
  }

  .partner-box:hover {
    transform: scale(1.05);
  }

  .partner-box img {
    max-height: 80px;
    max-width: 100%;
    object-fit: contain;
  }
</style>

<section class="partners-section">
  <div class="container text-center">
    <h2 class="mb-4 text-dark">OUR PARTNERS</h2>
    <div class="row justify-content-center">

      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4 d-flex justify-content-center">
            <div class="partner-box">
              <a href="<?= htmlspecialchars($row['website']) ?>" target="_blank">
                <img src="<?= htmlspecialchars($row['logo']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
              </a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No partners found.</p>
      <?php endif; ?>

    </div>
  </div>
</section>
<?php include 'footer.php' ?>

