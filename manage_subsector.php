<?php
include 'db.php';
$success = $error = '';

// Function to create slug from name
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
    $stmt = $conn->prepare("DELETE FROM subsectors WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) $success = "Subsector deleted!";
    else $error = "Delete failed.";
}

// Edit mode
$edit_mode = false;
$edit_id = $edit_sector_id = $edit_name = $edit_slug = '';
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM subsectors WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $edit_sector_id = $result['sector_id'];
    $edit_name = $result['subsector_name'];
    $edit_slug = $result['slug'];
}

// Add or Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sector_id = $_POST['sector_id'];
    $subsector_name = $_POST['subsector_name'];
    $slug = !empty($_POST['slug']) ? slugify($_POST['slug']) : slugify($subsector_name);

    if (isset($_POST['edit_id']) && $_POST['edit_id'] != '') {
        // Update
        $edit_id = $_POST['edit_id'];
        $stmt = $conn->prepare("UPDATE subsectors SET sector_id=?, subsector_name=?, slug=? WHERE id=?");
        $stmt->bind_param("issi", $sector_id, $subsector_name, $slug, $edit_id);
        if ($stmt->execute()) {
            $success = "Subsector updated!";
            $edit_mode = false;
        } else {
            $error = "Update failed.";
        }
    } else {
        // Add
        $stmt = $conn->prepare("INSERT INTO subsectors (sector_id, subsector_name, slug) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $sector_id, $subsector_name, $slug);
        if ($stmt->execute()) {
            $success = "Subsector added!";
        } else {
            $error = "Insert failed.";
        }
    }
}
?>

<?php include 'adminhead.php'; ?>

<div class="container py-4">
    <h3><?= $edit_mode ? 'Edit Subsector' : 'Manage Subsectors' ?></h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- Subsector Form -->
    <form method="POST" class="border p-3 rounded bg-light mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Select Sector</label>
                <select name="sector_id" class="form-control" required>
                    <option value="">-- Choose --</option>
                    <?php
                    $sectors = $conn->query("SELECT * FROM sectors");
                    while ($s = $sectors->fetch_assoc()) {
                        $selected = ($s['id'] == $edit_sector_id) ? 'selected' : '';
                        echo "<option value='{$s['id']}' $selected>{$s['sector_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Subsector Name</label>
                <input type="text" name="subsector_name" value="<?= htmlspecialchars($edit_name) ?>" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Slug (optional)</label>
                <input type="text" name="slug" value="<?= htmlspecialchars($edit_slug) ?>" class="form-control" placeholder="auto if blank">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <input type="hidden" name="edit_id" value="<?= $edit_mode ? $edit_id : '' ?>">
                <button type="submit" class="btn btn-<?= $edit_mode ? 'warning' : 'primary' ?>">
                    <?= $edit_mode ? 'Update' : 'Add' ?>
                </button>
            </div>
        </div>
    </form>

    <!-- Subsector Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
              <tr>
                 <th>#</th>
                 <th>Subsector Name</th>
                 <th>Slug</th>
                 <th>Sector Name</th>
                 <th>Action</th>
              </tr>
            </thead>
            <tbody>
<?php
$res = $conn->query("SELECT subsectors.*, sectors.sector_name 
                     FROM subsectors 
                     JOIN sectors ON subsectors.sector_id = sectors.id 
                     ORDER BY subsectors.id DESC");
$i = 1;
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$i}</td>
                <td>{$row['subsector_name']}</td>
                <td>{$row['slug']}</td>
                <td>{$row['sector_name']}</td>
                <td>
                    <a href='?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>

                    <a href='?delete={$row['id']}' onclick=\"return confirm('Delete this subsector?')\" class='btn btn-sm btn-danger'>Delete</a>
                </td>
              </tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='5'>No subsectors found.</td></tr>";
}
?>
</tbody>

        </table>
    </div>
</div>

<?php include 'adminfoot.php'; ?>
