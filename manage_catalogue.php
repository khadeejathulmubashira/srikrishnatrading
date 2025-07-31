<?php
include 'db.php';

$success = $error = '';
$edit_mode = false;
$edit_data = [
    'id' => '', 'brand_name' => '', 'logo_path' => '',
    'title' => '', 'description' => '', 'pdf_path' => '', 'image_path' => ''
];

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM catalogues WHERE id = $id");
    $success = "Catalogue deleted successfully.";
}

// Handle Edit Load
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM catalogues WHERE id = $id");
    if ($res->num_rows > 0) {
        $edit_data = $res->fetch_assoc();
    }
}

// File Upload Helper
function uploadFile($input, $old = '') {
    $target = "uploads/";
    if (isset($_FILES[$input]) && $_FILES[$input]['error'] == 0) {
        $filename = time() . '_' . basename($_FILES[$input]['name']);
        move_uploaded_file($_FILES[$input]['tmp_name'], $target . $filename);
        return $target . $filename;
    }
    return $old;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $edit_id = $_POST['edit_id'];

    $logo = uploadFile('logo', $_POST['old_logo']);
    $pdf = uploadFile('pdf', $_POST['old_pdf']);
    $image = uploadFile('image', $_POST['old_image']);

    if ($edit_id) {
        $stmt = $conn->prepare("UPDATE catalogues SET brand_name=?, logo_path=?, title=?, description=?, pdf_path=?, image_path=? WHERE id=?");
        $stmt->bind_param("ssssssi", $brand_name, $logo, $title, $description, $pdf, $image, $edit_id);
        $stmt->execute();
        $success = "Catalogue updated!";
        $edit_mode = false;
    } else {
        $stmt = $conn->prepare("INSERT INTO catalogues (brand_name, logo_path, title, description, pdf_path, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $brand_name, $logo, $title, $description, $pdf, $image);
        $stmt->execute();
        $success = "Catalogue added!";
    }
}
?>

<?php include 'adminhead.php'; ?>
<div class="container py-4">
    <h4><?= $edit_mode ? "Edit Catalogue" : "Add New Catalogue" ?></h4>
    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

    <!-- Form -->
    <form method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label>Brand Name</label>
                <input type="text" name="brand_name" value="<?= $edit_data['brand_name'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Title</label>
                <input type="text" name="title" value="<?= $edit_data['title'] ?>" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label>Description</label>
                <textarea name="description" class="form-control" required><?= $edit_data['description'] ?></textarea>
            </div>

            <div class="col-md-4">
                <label>Logo (Image)</label>
                <input type="file" name="logo" class="form-control">
                <?php if ($edit_data['logo_path']): ?>
                    <img src="<?= $edit_data['logo_path'] ?>" height="50" class="mt-1">
                <?php endif; ?>
                <input type="hidden" name="old_logo" value="<?= $edit_data['logo_path'] ?>">
            </div>

            <div class="col-md-4">
                <label>PDF File</label>
                <input type="file" name="pdf" class="form-control">
                <?php if ($edit_data['pdf_path']): ?>
                    <a href="<?= $edit_data['pdf_path'] ?>" target="_blank" class="btn btn-link mt-1">View PDF</a>
                <?php endif; ?>
                <input type="hidden" name="old_pdf" value="<?= $edit_data['pdf_path'] ?>">
            </div>

            <div class="col-md-4">
                <label>Preview Image</label>
                <input type="file" name="image" class="form-control">
                <?php if ($edit_data['image_path']): ?>
                    <img src="<?= $edit_data['image_path'] ?>" height="50" class="mt-1">
                <?php endif; ?>
                <input type="hidden" name="old_image" value="<?= $edit_data['image_path'] ?>">
            </div>

            <input type="hidden" name="edit_id" value="<?= $edit_data['id'] ?>">
            <div class="col-12">
                <button class="btn btn-<?= $edit_mode ? 'warning' : 'primary' ?>"><?= $edit_mode ? 'Update' : 'Add' ?></button>
                <?php if ($edit_mode): ?>
                    <a href="manage_catalogue.php" class="btn btn-secondary ms-2">Cancel</a>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Logo</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>PDF</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM catalogues ORDER BY id DESC");
                $i = 1;
                while ($row = $res->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $row['brand_name'] ?></td>
                        <td><img src="<?= $row['logo_path'] ?>" height="40"></td>
                        <td><?= $row['title'] ?></td>
                        <td style="white-space: normal; max-width: 250px;"><?= $row['description'] ?></td>
                        <td><a href="<?= $row['pdf_path'] ?>" target="_blank">📄 PDF</a></td>
                        <td><img src="<?= $row['image_path'] ?>" height="50"></td>
                        <td>
                            <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php if ($res->num_rows == 0): ?>
                    <tr><td colspan="8">No catalogues found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'adminfoot.php'; ?>
