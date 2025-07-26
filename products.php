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
                        <img src="uploads/' . htmlspecialchars($row['image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>
                            <p class="text-muted">Code: ' . htmlspecialchars($row['code']) . '</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12"><p class="text-muted text-center">No products found for this sector.</p></div>';
        }
        ?>
      </div>
    </div>

  </div>
</div>

<?php include 'footer.php'; ?>
