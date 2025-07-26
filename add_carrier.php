<?php
include 'db.php';

$success = $error = '';
$edit_mode = false;
$edit_id = $edit_title = $edit_location = $edit_type = $edit_description = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM careers WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $success = "Career deleted successfully!";
    } else {
        $error = "Error deleting career.";
    }
}

// Handle Edit Fetch
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM careers WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $edit_title = $result['title'];
    $edit_location = $result['location'];
    $edit_type = $result['job_type'];
    $edit_description = $result['description'];
}

// Handle Add or Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $job_type = $_POST['job_type'];
    $description = $_POST['description'];

    if (!empty($_POST['edit_id'])) {
        // Update
        $id = $_POST['edit_id'];
        $stmt = $conn->prepare("UPDATE careers SET title=?, location=?, job_type=?, description=? WHERE id=?");
        $stmt->bind_param("ssssi", $title, $location, $job_type, $description, $id);
        if ($stmt->execute()) {
            $success = "Career updated successfully!";
            $edit_mode = false;
        } else {
            $error = "Error updating career.";
        }
    } else {
        // Add
        $stmt = $conn->prepare("INSERT INTO careers (title, location, job_type, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $location, $job_type, $description);
        if ($stmt->execute()) {
            $success = "Career added successfully!";
        } else {
            $error = "Error adding career.";
        }
    }
}
?>

<?php include 'adminhead.php'; ?>

<div class="container py-4">
    <h4 class="mb-3"><?= $edit_mode ? "Edit Career Opportunity" : "Add Career Opportunity" ?></h4>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- Career Form -->
    <form method="POST" class="border p-4 bg-light rounded mb-4">
        <div class="mb-3">
            <label class="form-label">Job Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($edit_title) ?>" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($edit_location) ?>" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Job Type</label>
            <input type="text" name="job_type" class="form-control" value="<?= htmlspecialchars($edit_type) ?>" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Job Description</label>
            <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($edit_description) ?></textarea>
        </div>
        <input type="hidden" name="edit_id" value="<?= $edit_mode ? $edit_id : '' ?>">
        <button type="submit" class="btn btn-<?= $edit_mode ? 'warning' : 'primary' ?>">
            <?= $edit_mode ? 'Update Career' : 'Add Career' ?>
        </button>
        <?php if ($edit_mode): ?>
            <a href="manage_careers.php" class="btn btn-secondary ms-2">Cancel</a>
        <?php endif; ?>
    </form>

    <!-- Table: View All Careers -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Job Type</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM careers ORDER BY id DESC");
                $i = 1;
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['job_type']}</td>
                                <td style='white-space: normal; word-wrap: break-word; max-width: 300px;'>{$row['description']}</td>

                                <td>
                                    <a href='?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                    <a href='?delete={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this job?')\" class='btn btn-sm btn-danger'>Delete</a>
                                </td>
                              </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No careers available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'adminfoot.php'; ?>
