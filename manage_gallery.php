<?php
include 'db.php';

$success = $error = '';
$edit_mode = false;
$edit_data = ['id'=>'', 'title'=>'', 'description'=>'', 'video_path'=>''];

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM gallery WHERE id = $id");
    $success = "Video deleted!";
}

// Edit Fetch
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM gallery WHERE id = $id");
    if ($res->num_rows > 0) {
        $edit_data = $res->fetch_assoc();
    }
}

// Add / Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $edit_id = $_POST['edit_id'];

    // File upload
    $video = $_POST['old_video'];
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $file = time() . '_' . basename($_FILES['video']['name']);
        $target_path = "video" . $file;
        move_uploaded_file($_FILES['video']['tmp_name'], $target_path);
        $video = $target_path;
    }

    if ($edit_id) {
        $stmt = $conn->prepare("UPDATE gallery SET title=?, description=?, video_path=? WHERE id=?");
        $stmt->bind_param("sssi", $title, $description, $video, $edit_id);
        $stmt->execute();
        $success = "Video updated!";
        $edit_mode = false;
    } else {
        $stmt = $conn->prepare("INSERT INTO gallery (title, description, video_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $video);
        $stmt->execute();
        $success = "Video uploaded!";
    }
}
?>

<?php include 'adminhead.php'; ?>
<div class="container py-4">
    <h4><?= $edit_mode ? "Edit Video" : "Upload New Video" ?></h4>

    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label>Title</label>
                <input type="text" name="title" value="<?= $edit_data['title'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Video File</label>
                <input type="file" name="video" class="form-control">
                <?php if ($edit_data['video_path']): ?>
                    <video src="<?= $edit_data['video_path'] ?>" height="50" controls class="mt-1"></video>
                <?php endif; ?>
                <input type="hidden" name="old_video" value="<?= $edit_data['video_path'] ?>">
            </div>
            <div class="col-md-12">
                <label>Description</label>
                <textarea name="description" class="form-control" required><?= $edit_data['description'] ?></textarea>
            </div>
            <input type="hidden" name="edit_id" value="<?= $edit_data['id'] ?>">
            <div class="col-12">
                <button class="btn btn-<?= $edit_mode ? 'warning' : 'primary' ?>"><?= $edit_mode ? 'Update' : 'Upload' ?></button>
                <?php if ($edit_mode): ?><a href="manage_videos.php" class="btn btn-secondary ms-2">Cancel</a><?php endif; ?>
            </div>
        </div>
    </form>

    <!-- View Videos Table -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Video</th>
                    <th>Uploaded At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
                $i = 1;
                while ($row = $res->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td style="white-space: normal; max-width: 300px;"><?= nl2br(htmlspecialchars($row['description'])) ?></td>
                        <td>
                            <video src="<?= $row['video_path'] ?>" height="80" controls></video>
                        </td>
                        <td><?= $row['uploaded_at'] ?></td>
                        <td>
                            <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php if ($res->num_rows == 0): ?>
                    <tr><td colspan="6">No videos uploaded yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'adminfoot.php'; ?>
