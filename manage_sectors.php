<?php
include 'db.php';
$success = $error = '';

// Slug generator
function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text);
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM sectors WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) $success = "Sector deleted!";
    else $error = "Delete failed.";
}

// Edit mode
$edit_mode = false;
$edit_id = $edit_name = $edit_slug = '';
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM sectors WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $edit_name = $result['sector_name'];
    $edit_slug = $result['slug'];
}

// Add / Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sector_name = $_POST['sector_name'];
    $slug = !empty($_POST['slug']) ? slugify($_POST['slug']) : slugify($sector_name);

    if (isset($_POST['edit_id']) && $_POST['edit_id'] != '') {
        // Update
        $edit_id = $_POST['edit_id'];
        $stmt = $conn->prepare("UPDATE sectors SET sector_name = ?, slug = ? WHERE id = ?");
        $stmt->bind_param("ssi", $sector_name, $slug, $edit_id);
        if ($stmt->execute()) $success = "Sector updated!";
        else $error = "Update failed.";
    } else {
        // Add
        $image_path = '';
if (isset($_FILES['sector_image']) && $_FILES['sector_image']['error'] == 0) {
    $img_name = time() . '_' . basename($_FILES["sector_image"]["name"]);
    $target_dir = "uploads/";
    $image_path = $target_dir . $img_name;
    move_uploaded_file($_FILES["sector_image"]["tmp_name"], $image_path);
}

$stmt = $conn->prepare("INSERT INTO sectors (sector_name, slug, sector_image) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $sector_name, $slug, $image_path);

        if ($stmt->execute()) $success = "Sector added!";
        else $error = "Insert failed.";
    }
}
?>

<?php include 'adminhead.php'; ?>

<div class="container py-4">
    <h3><?= $edit_mode ? 'Edit Sector' : 'Manage Sectors' ?></h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- Sector Form -->
    <form method="POST" enctype="multipart/form-data" class="border p-3 rounded bg-light mb-4">

        <div class="row g-3">
            <div class="col-md-5">
                <label class="form-label">Sector Name</label>
                <input type="text" name="sector_name" value="<?= htmlspecialchars($edit_name) ?>" class="form-control" required>
            </div>
            <div class="col-md-5">
    <label class="form-label">Sector Image</label>
    <input type="file" name="sector_image" class="form-control" <?= $edit_mode ? '' : 'required' ?>>
    <?php if ($edit_mode && !empty($result['sector_image'])): ?>
        <img src="<?= htmlspecialchars($result['sector_image']) ?>" class="mt-2" style="height:60px;">
    <?php endif; ?>
</div>

            <div class="col-md-5">
                <label class="form-label">Slug (optional)</label>
                <input type="text" name="slug" value="<?= htmlspecialchars($edit_slug) ?>" class="form-control" placeholder="auto if blank">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <input type="hidden" name="edit_id" value="<?= $edit_mode ? $edit_id : '' ?>">
                <button type="submit" class="btn btn-<?= $edit_mode ? 'warning' : 'primary' ?>">
                    <?= $edit_mode ? 'Update' : 'Add' ?>
                </button>
            </div>
        </div>
    </form>

    <!-- Sector Table -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Sector Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $res = $conn->query("SELECT * FROM sectors ORDER BY id DESC");
            $i = 1;
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    echo "<tr>
                        <td>{$i}</td>
                        <td>{$row['sector_name']}</td>
                        <td>{$row['slug']}</td>
                        <td>
                            <a href='?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='?delete={$row['id']}' onclick=\"return confirm('Delete this sector?')\" class='btn btn-sm btn-danger'>Delete</a>
                        </td>
                    </tr>";
                    $i++;
                }
            } else {
                echo "<tr><td colspan='4'>No sectors found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'adminfoot.php'; ?>
