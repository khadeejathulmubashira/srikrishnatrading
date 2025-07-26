<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
$sector_id = isset($_GET['sector_id']) ? intval($_GET['sector_id']) : 0;
$sector = $conn->query("SELECT * FROM sectors WHERE id = $sector_id")->fetch_assoc();
$sector_name = $sector['sector_name'];
?>

<div class="container py-5">
  <h2 class="text-center text-primary mb-4"><?= htmlspecialchars($sector_name) ?> - Subcategories</h2>

  <!-- Subsector Section -->
  <div class="row mb-5">
    <?php
    $res = $conn->query("SELECT * FROM subsectors WHERE sector_id = $sector_id");
    if ($res->num_rows > 0) {
      while ($row = $res->fetch_assoc()) {
        $sub_name = $row['subsector_name'];
        $sub_id = $row['id'];
        $sub_slug = $row['slug'];
        echo '
        <div class="col-md-4 mb-4">
          <a href="products.php?sector_id=' . $sector_id . '&subsector_id=' . $sub_id . '" class="text-decoration-none text-dark">
            <div class="card h-100 shadow-sm">
              <div class="card-body text-center">
                <h5 class="card-title">' . htmlspecialchars($sub_name) . '</h5>
                <p class="text-muted">Explore ' . htmlspecialchars($sub_name) . '</p>
              </div>
            </div>
          </a>
        </div>';
      }
    } else {
      echo '<p>No subsectors found.</p>';
    }
    ?>
  </div>

  <!-- Featured Products -->
  <h3 class="mb-4">Top Products in <?= htmlspecialchars($sector_name) ?></h3>
  <div class="row">
    <?php
    $res = $conn->query("SELECT * FROM products WHERE sector_id = $sector_id ORDER BY id DESC LIMIT 6");
    if ($res->num_rows > 0) {
      while ($row = $res->fetch_assoc()) {
        echo '
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="uploads/' . $row['image'] . '" class="card-img-top" style="height:250px; object-fit:cover;">
            <div class="card-body text-center">
              <h5>' . htmlspecialchars($row['name']) . '</h5>
              <p class="text-muted">Code: ' . $row['code'] . '</p>
            </div>
          </div>
        </div>';
      }
    } else {
      echo '<p>No products found for this sector.</p>';
    }
    ?>
  </div>
</div>

<?php include 'footer.php'; ?>
