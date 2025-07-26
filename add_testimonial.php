<?php
include 'db.php';

$success = $error = '';
$edit_mode = false;
$edit_id = $edit_name = $edit_profession = $edit_description = $edit_photo = '';

// Delete Testimonial
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM testimonials WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $success = "Testimonial deleted!";
    } else {
        $error = "Failed to delete testimonial!";
    }
}

// Edit Testimonial
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $edit_name = $result['name'];
    $edit_profession = $result['profession'];
    $edit_description = $result['description'];
    $edit_photo = $result['photo'];
}

// Add or Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $profession = $_POST['profession'];
    $description = $_POST['description'];
    $photo = $edit_photo;

    // Handle Image Upload
    if (!empty($_FILES['photo']['name'])) {
        $image_name = basename($_FILES['photo']['name']);
        $image_tmp = $_FILES['photo']['tmp_name'];
        $upload_dir = "img/";
        $image_path = $upload_dir . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            $photo = $image_name;
        } else {
            $error = "Failed to upload image.";
        }
    }

    if (isset($_POST['edit_id']) && $_POST['edit_id'] != '') {
        // Update
        $id = $_POST['edit_id'];
        $stmt = $conn->prepare("UPDATE testimonials SET name=?, profession=?, description=?, photo=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $profession, $description, $photo, $id);
        if ($stmt->execute()) {
            $success = "Testimonial updated!";
            $edit_mode = false;
        } else {
            $error = "Update failed!";
        }
    } else {
        // Insert
        $stmt = $conn->prepare("INSERT INTO testimonials (name, profession, description, photo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $profession, $description, $photo);
        if ($stmt->execute()) {
            $success = "Testimonial added!";
        } else {
            $error = "Insert failed!";
        }
    }
}
?>

<?php include 'adminhead.php'; ?>

<div class="container py-4">
    <h3><?= $edit_mode ? 'Edit Testimonial' : 'Manage Testimonials' ?></h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- Form -->
    <form method="POST" enctype="multipart/form-data" class="border p-3 bg-light rounded mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Client Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($edit_name) ?>" class="form-control" required />
            </div>
            <div class="col-md-4">
                <label class="form-label">Profession</label>
                <input type="text" name="profession" value="<?= htmlspecialchars($edit_profession) ?>" class="form-control" required />
            </div>
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($edit_description) ?></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">Photo <?= $edit_photo ? "(Leave blank to keep current)" : "" ?></label>
                <input type="file" name="photo" class="form-control" accept="image/*" <?= $edit_mode ? "" : "required" ?> />
                <?php if ($edit_photo): ?>
                    <img src="img/<?= $edit_photo ?>" class="img-fluid mt-2 rounded" width="100">
                <?php endif; ?>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <input type="hidden" name="edit_id" value="<?= $edit_mode ? $edit_id : '' ?>">
                <button type="submit" class="btn btn-<?= $edit_mode ? 'warning' : 'primary' ?>">
                    <?= $edit_mode ? 'Update' : 'Add' ?>
                </button>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Profession</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM testimonials ORDER BY id DESC");
                $i = 1;
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>
                                <td>{$i}</td>
                                <td><img src='img/{$row['photo']}' width='60' class='rounded'></td>
                                <td>{$row['name']}</td>
                                <td>{$row['profession']}</td>
                                <td style='white-space: normal; word-wrap: break-word; max-width: 300px;'>{$row['description']}</td>

                                <td>
                                    <a href='?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                    <a href='?delete={$row['id']}' onclick=\"return confirm('Delete this testimonial?')\" class='btn btn-sm btn-danger'>Delete</a>
                                </td>
                              </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No testimonials found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'adminfoot.php'; ?>
