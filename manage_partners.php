<?php
include 'db.php';

$success = $error = '';
$edit_mode = false;
$edit_id = $edit_name = $edit_website = $edit_logo = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM partners WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $success = "Partner deleted successfully!";
}

// Handle Edit fetch
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM partners WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $edit_name = $result['name'];
    $edit_website = $result['website'];
    $edit_logo = $result['logo'];
}

// Handle Add or Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $website = $_POST['website'];
    $edit_id_post = $_POST['edit_id'];
    $old_logo = $_POST['old_logo'];

    // Handle file upload
    if (!empty($_FILES['logo']['name'])) {
        $logo_path = 'uploads/' . basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'],$logo_path);
    } else {
        $logo_path = $old_logo;
    }

    if (!empty($edit_id_post)) {
        // Update
        $stmt = $conn->prepare("UPDATE partners SET name=?, logo=?, website=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $logo_path, $website, $edit_id_post);
        $stmt->execute();
        $success = "Partner updated successfully!";
    } else {
        // Insert
        $stmt = $conn->prepare("INSERT INTO partners (name, logo, website) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $logo_path, $website);
        $stmt->execute();
        $success = "Partner added successfully!";
    }

    // Reset form
    $edit_mode = false;
    $edit_id = $edit_name = $edit_website = $edit_logo = '';
}
?>

<?php include 'adminhead.php'; ?>

<div class="container py-4">
    <h4 class="mb-3"><?= $edit_mode ? 'Edit Partner' : 'Add Partner' ?></h4>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- Partner Form -->
    <form method="POST" enctype="multipart/form-data" class="border p-4 bg-light rounded mb-4">
        <input type="hidden" name="edit_id" value="<?= $edit_mode ? $edit_id : '' ?>">
        <input type="hidden" name="old_logo" value="<?= $edit_mode ? $edit_logo : '' ?>">

        <div class="mb-3">
            <label class="form-label">Partner Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($edit_name) ?>" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Website</label>
            <input type="url" name="website" class="form-control" value="<?= htmlspecialchars($edit_website) ?>" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Logo <?= $edit_mode ? '(Leave blank to keep existing)' : '' ?></label>
            <input type="file" name="logo" class="form-control" />
            <?php if ($edit_mode && $edit_logo): ?>
                <img src="<?= $edit_logo ?>" alt="Logo" class="mt-2" style="max-height: 80px;">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-<?= $edit_mode ? 'warning' : 'primary' ?>">
            <?= $edit_mode ? 'Update Partner' : 'Add Partner' ?>
        </button>
        <?php if ($edit_mode): ?>
            <a href="manage_partners.php" class="btn btn-secondary ms-2">Cancel</a>
        <?php endif; ?>
    </form>

    <!-- View Table -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM partners ORDER BY id DESC");
                $i = 1;
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row['name']}</td>
                                <td><img src='{$row['logo']}' alt='logo' style='max-height: 60px;'></td>
                                <td><a href='{$row['website']}' target='_blank'>{$row['website']}</a></td>
                                <td>
                                    <a href='?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                    <a href='?delete={$row['id']}' onclick=\"return confirm('Are you sure?')\" class='btn btn-sm btn-danger'>Delete</a>
                                </td>
                              </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No partners found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'adminfoot.php'; ?>
