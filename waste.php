<!-- product.php-->

<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
// Get sector_id from URL
$sector_id = isset($_GET['sector_id']) ? intval($_GET['sector_id']) : 0;

// Fetch sector name
$sector_name = "All Products";
if ($sector_id > 0) {
    $res = $conn->query("SELECT sector_name FROM sectors WHERE id = $sector_id");
    if ($row = $res->fetch_assoc()) {
        $sector_name = $row['sector_name'];
    }
}
?>

<!-- Header Section -->
<div class="container text-center py-5">
  <h6 class="section-title text-center text-primary text-uppercase">Our Product Collection</h6>
  <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase"><?php echo htmlspecialchars($sector_name); ?></span></h1>
</div>

<!-- Main Content with Sidebar -->
<div class="container">
  <div class="row">
    
    <!-- Sidebar -->
<style>
.sidebar-box {
    background: linear-gradient(145deg, #1e1e2f, #2e2e3e);
    border-radius: 10px;
    color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}
.sidebar-box h5 {
    border-bottom: 2px solid #ffc107;
    padding-bottom: 10px;
    font-weight: 600;
}
.sidebar-box ul li {
    margin-bottom: 10px;
}
.sidebar-box a {
    display: block;
    padding: 10px 15px;
    border-radius: 8px;
    color: #f8f9fa;
    background-color: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
    font-weight: 500;
}
.sidebar-box a:hover {
    background-color: #ffc107;
    color: #000;
    transform: translateX(5px);
}
.sidebar-box .active-link {
    background-color: #ffc107;
    color: #000 !important;
    font-weight: bold;
}
</style>

<div class="col-md-3 mb-4">
  <div class="p-3 sidebar-box">
    <h5 class="text-uppercase">Sectors</h5>
    <ul class="list-unstyled">
      <?php
      $res = $conn->query("SELECT * FROM sectors ORDER BY sector_name ASC");
      while ($row = $res->fetch_assoc()) {
          $active = $sector_id == $row['id'] ? 'active-link' : '';
          echo '<li>
                  <a href="products.php?sector_id=' . $row['id'] . '" class="' . $active . '">
                    <i class="bi bi-chevron-right"></i> ' . $row['sector_name'] . '
                  </a>
                </li>';
      }
      ?>
    </ul>
  </div>
</div>


    <!-- Products Section -->
    <div class="col-md-9">
      <div class="row g-4">
        <?php
        $query = "SELECT * FROM products";
        if ($sector_id > 0) {
            $query .= " WHERE sector_id = $sector_id";
        }
        $query .= " ORDER BY id DESC";

        $products = $conn->query($query);

        if ($products->num_rows > 0) {
            while ($row = $products->fetch_assoc()) {
                echo '
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="uploads/' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">' . $row['name'] . '</h5>
                            <p class="text-muted">Code: ' . $row['code'] . '</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-muted">No products found for this sector.</p>';
        }
        ?>
      </div>
    </div>

  </div>
</div>

<?php include 'footer.php'; ?>



<!-- product.php-->



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

<!-- catalogue -->