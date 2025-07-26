<!-- sanitary.php -->

<?php include 'header.php'; ?>

<?php
// Get the selected category from the URL
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
?>

<!-- Header Section -->
<div class="container text-center py-5">
  <h6 class="section-title text-center text-primary text-uppercase">Our Sanitaryware Collection</h6>
  <h1 class="mb-5">Discover Our Brand New <span class="text-primary text-uppercase">Sanitary Ware Designs</span></h1>
</div>

<!-- Main Content with Sidebar -->
<div class="container">
  <div class="row">
    
    <!-- Sidebar -->
    <div class="col-md-3 mb-4">
      <div class="p-3 bg-dark text-white rounded sidebar-box" style="min-height: 100%;">
        <h5 class="border-bottom pb-2">Categories</h5>

        <h6 class="mt-4">SLAB</h6>
        <ul class="list-unstyled ps-3">
          <li>
            <a href="sanitary.php?category=art-basin" 
               class="text-white text-decoration-none <?php echo ($category == 'art-basin') ? 'fw-bold text-warning' : ''; ?>">
              &#9658; Art Basin
            </a>
          </li>
          <li>• Qube Italia</li>
        </ul>

    
      </div>
    </div>

    <!-- Products Section -->
    <div class="col-md-9">
      <div class="row g-4">
        <?php
        // Sample product data
        $products = [
          ['image' => 'img/Qube Italia Art Basin - May 2025_page-0001.jpg', 'name' => 'ZURIN AQUA', 'code' => 'ZA001'],
          ['image' => 'img/Qube Italia Art Basin - May 2025_page-0002.jpg', 'name' => 'TUSCAN BLANCO', 'code' => 'TB002'],
          ['image' => 'img/Qube Italia Art Basin - May 2025_page-0003.jpg', 'name' => 'TUSCAN BLANCO', 'code' => 'TB002'],
          ['image' => 'img/Qube Italia Art Basin - May 2025_page-0004.jpg', 'name' => 'TUSCAN BLANCO', 'code' => 'TB002'],
          ['image' => 'img/Qube Italia Art Basin - May 2025_page-0007.jpg', 'name' => 'TUSCAN BLANCO', 'code' => 'TB002'],
          ['image' => 'img/Qube Italia Art Basin - May 2025_page-0005.jpg', 'name' => 'TUSCAN BLANCO', 'code' => 'TB002'],
          ['image' => 'img/Qube Italia Art Basin - May 2025_page-0006.jpg', 'name' => 'TUSCAN BLANCO', 'code' => 'TB002'],
        ];

        foreach ($products as $product) {
          // Filter if a category is selected
          if ($category === 'art-basin') {
            if (stripos($product['name'], 'ZURIN') === false && stripos($product['name'], 'TUSCAN') === false) {
              continue; // Skip non-matching products
            }
          }

          // Display product
        ?>
          <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 h-100">
              <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>" style="height: 250px; object-fit: cover;">
              <div class="card-body text-center">
                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                <p class="text-muted">Code: <?php echo $product['code']; ?></p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

  </div>
</div>

<?php include 'footer.php'; ?>
