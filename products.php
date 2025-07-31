<?php
include('db.php');
include('header.php');

// Show all PHP errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get sector_id and subsector_id from URL
$sector_id = isset($_GET['sector_id']) ? intval($_GET['sector_id']) : 0;
$subsector_id = isset($_GET['subsector_id']) ? intval($_GET['subsector_id']) : 0;
?>

<style>
    .product-box {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 20px;
        text-align: center;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .product-box img {
        max-width: 100%;
        height: 200px;
        object-fit: contain;
        margin-bottom: 10px;
    }
    .sidebar {
        background: #f4f8fc;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.1);
        height: 100%;
    }
    .sidebar h5 {
        font-size: 18px;
        color: #0f172b;
        margin-bottom: 15px;
        font-weight: 600;
        border-bottom: 2px solid #007bff;
        padding-bottom: 5px;
    }

    .sidebar a {
        display: block;
        padding: 10px 15px;
        margin-bottom: 8px;
        border-radius: 6px;
        color: #333;
        background-color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .sidebar a:hover {
        background-color: #e7f1ff;
        color: #007bff;
        border-left: 4px solid #007bff;
    }

    .sidebar a.active {
        background-color: #d0e7ff;
        color: #0056b3;
        font-weight: 600;
        border-left: 4px solid #0056b3;
    }
</style>

<div class="container mt-5 mb-5">

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
    <h5>Subcategories</h5>
    <?php
    if ($sector_id > 0) {
        $sub_q = "SELECT * FROM subsectors WHERE sector_id = $sector_id";
        $sub_result = mysqli_query($conn, $sub_q);
        while ($row = mysqli_fetch_assoc($sub_result)) {
            $active_class = ($row['id'] == $subsector_id) ? 'active' : '';
            echo '<a class="' . $active_class . '" href="products.php?sector_id=' . $sector_id . '&subsector_id=' . $row['id'] . '">' . htmlspecialchars($row['subsector_name']) . '</a>';
        }
    }
    ?>
</div>


        <!-- Products Area -->
        <div class="col-md-9">
            <div class="row">
                <?php
                // Only fetch products if sector and subsector are set properly
                if ($sector_id > 0 && $subsector_id > 0) {
                    $q = "SELECT * FROM products WHERE sector_id = $sector_id AND subsector_id = $subsector_id";
                } else {
                    // Show message if not selected properly
                    $q = "";
                }

                if (!empty($q)) {
                    $result = mysqli_query($conn, $q);
                    if (mysqli_num_rows($result) > 0) {
                        while ($product = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-md-4">
                                <div class="product-box">
                                    <img src="uploads/' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">
                                    <h5>' . htmlspecialchars($product['name']) . '</h5>
                                    <p><strong>Code:</strong> ' . htmlspecialchars($product['code']) . '</p>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<div class="col-12"><p>No products found.</p></div>';
                    }
                } else {
                    echo '
<div class="col-12">
    <div style="text-align:center; background-color:#f8f9fa; border: 1px solid #ddd; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        
        <h5 style="color:#555;">Please select a <strong>subcategory</strong> to view the products.</h5>
        <p style="color:#888;">Choose an option from the left menu to get started.</p>
    </div>
</div>';

                }
                ?>
                <div class="container mt-4">
    <a href="index.php" style="text-decoration:none; color:#007bff; display:inline-flex; align-items:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#007bff" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        <span style="margin-left:8px;">Back to Home</span>
    </a>
</div>

            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
