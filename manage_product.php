<?php include 'db.php'; ?>

<?php
// Handle Add or Update
$success = $error = "";
$edit = false;
$productData = ["id"=>"", "name"=>"", "code"=>"", "image"=>"", "sector_id"=>"", "subsector_id"=>""];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'];
    $code = $_POST['code'];
    $sector_id = $_POST['sector_id'];
    $subsector_id = $_POST['subsector_id'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if ($id) {
        // Update
        if (!empty($image)) {
            move_uploaded_file($tmp, "uploads$image");
            $conn->query("UPDATE products SET name='$name', code='$code', image='$image', sector_id='$sector_id', subsector_id='$subsector_id' WHERE id=$id");
        } else {
            $conn->query("UPDATE products SET name='$name', code='$code', sector_id='$sector_id', subsector_id='$subsector_id' WHERE id=$id");
        }
        $success = "Product updated.";
    } else {
        // Insert
        if (move_uploaded_file($tmp, "uploads/$image")) {
            $stmt = $conn->prepare("INSERT INTO products (name, code, image, sector_id, subsector_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssii", $name, $code, $image, $sector_id, $subsector_id);
            if ($stmt->execute()) $success = "Product added!";
            else $error = "Error: " . $stmt->error;
        } else {
            $error = "Image upload failed!";
        }
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $did = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$did");
    header("Location: manage_product.php");
    exit;
}

// Handle Edit
if (isset($_GET['edit'])) {
    $edit = true;
    $eid = $_GET['edit'];
    $result = $conn->query("SELECT * FROM products WHERE id=$eid");
    if ($result->num_rows > 0) {
        $productData = $result->fetch_assoc();
    }
}
?>
<?php include 'adminhead.php'; ?>
<div class="container mt-4">
    <h4><?= $edit ? "Edit Product" : "Add Product" ?></h4>
    <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" enctype="multipart/form-data" class="border p-3 rounded bg-light mb-4">
        <input type="hidden" name="id" value="<?= $productData['id'] ?>">
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="text" name="name" value="<?= $productData['name'] ?>" placeholder="Product Name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="code" value="<?= $productData['code'] ?>" placeholder="Product Code" class="form-control" required>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <select name="sector_id" class="form-control" required>
                    <option value="">Select Sector</option>
                    <?php
                    $sectors = $conn->query("SELECT * FROM sectors");
                    while ($row = $sectors->fetch_assoc()) {
                        $sel = $row['id'] == $productData['sector_id'] ? 'selected' : '';
                        echo "<option value='{$row['id']}' $sel>{$row['sector_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <select name="subsector_id" class="form-control" required>
                    <option value="">Select Subsector</option>
                    <?php
                    $subs = $conn->query("SELECT * FROM subsectors");
                    while ($row = $subs->fetch_assoc()) {
                        $sel = $row['id'] == $productData['subsector_id'] ? 'selected' : '';
                        echo "<option value='{$row['id']}' $sel>{$row['subsector_name']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="mb-2">
            <input type="file" name="image" class="form-control" <?= $edit ? '' : 'required' ?>>
            <?php if ($edit && $productData['image']) echo "<small>Current: <img src='uploads/{$productData['image']}' width='50'></small>"; ?>
        </div>
        <button type="submit" class="btn btn-<?= $edit ? 'info' : 'primary' ?>"><?= $edit ? 'Update' : 'Add' ?> Product</button>
        <?php if ($edit): ?>
            <a href="manage_product.php" class="btn btn-secondary">Cancel</a>
        <?php endif; ?>
    </form>
</div>

<hr>

<div class="container">
    <h4>All Products</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Img</th>
                <th>Name</th>
                <th>Code</th>
                <th>Sector</th>
                <th>Subsector</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = $conn->query("SELECT p.*, s.sector_name, ss.subsector_name 
                                FROM products p 
                                JOIN sectors s ON p.sector_id = s.id 
                                JOIN subsectors ss ON p.subsector_id = ss.id 
                                ORDER BY p.id DESC");
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td><img src='uploads/{$row['image']}' width='50'></td>
                        <td>{$row['name']}</td>
                        <td>{$row['code']}</td>
                        <td>{$row['sector_name']}</td>
                        <td>{$row['subsector_name']}</td>
                        <td>
                            <a href='manage_product.php?edit={$row['id']}' class='btn btn-sm btn-info'>Edit</a>
                            <a href='manage_product.php?delete={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Delete this product?\")'>Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'adminfoot.php'; ?>
