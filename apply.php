
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);

    $resumeFile = $_FILES['resume'];
    $resumeName = basename($resumeFile['name']);
    $resumeTmp  = $resumeFile['tmp_name'];
    $resumeExt  = strtolower(pathinfo($resumeName, PATHINFO_EXTENSION));

    $allowedExt = ['pdf', 'doc', 'docx'];

    if (in_array($resumeExt, $allowedExt)) {
        $newFileName = uniqid('resume_', true) . '.' . $resumeExt;
        $uploadDir = 'uploads/resumes/';
        $uploadPath = $uploadDir . $newFileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($resumeTmp, $uploadPath)) {
            $stmt = $conn->prepare("INSERT INTO application (name, email, phone, position, resume) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $phone, $position, $newFileName);

            if ($stmt->execute()) {
                header("Location: apply.php?success=1");
                exit();
            } else {
                $error = "Database error: " . $stmt->error;
            }
        } else {
            $error = "Failed to upload resume.";
        }
    } else {
        $error = "Invalid file type. Only PDF, DOC, and DOCX allowed.";
    }
}
?>

<?php include 'header.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url('img/carousel-1.jpg');">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Apply Now</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Apply</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Application Form Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-start text-primary text-uppercase">Application</h6>
                <h1 class="mb-4">Apply to <span class="text-primary text-uppercase">Srikrishna Traders</span></h1>

                <!-- Success Message -->
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="alert alert-success text-center">Application submitted successfully!</div>
                <?php elseif (isset($error)): ?>
                    <div class="alert alert-danger text-center"><?= $error ?></div>
                <?php endif; ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" name="name" class="form-control border-0 bg-light px-4" required style="height: 55px;">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control border-0 bg-light px-4" required style="height: 55px;">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-control border-0 bg-light px-4" required style="height: 55px;">
                        </div>
                        <div class="col-md-6">
                            <label for="position" class="form-label">Position Applying For *</label>
                            <select class="form-select border-0 bg-light px-4" name="position" required style="height: 55px;">
                                <option value="">Select a Position</option>
                                <option value="Sales Executive" <?= (isset($_GET['position']) && $_GET['position'] == 'Sales Executive') ? 'selected' : '' ?>>Sales Executive</option>
                                <option value="Delivery Coordinator" <?= (isset($_GET['position']) && $_GET['position'] == 'Delivery Coordinator') ? 'selected' : '' ?>>Delivery Coordinator</option>
                                <option value="Store Manager" <?= (isset($_GET['position']) && $_GET['position'] == 'Store Manager') ? 'selected' : '' ?>>Store Manager</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="resume" class="form-label">Upload Your CV (PDF/DOC) *</label>
                            <input type="file" name="resume" class="form-control border-0 bg-light px-4 py-3" required accept=".pdf,.doc,.docx">
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary py-3 px-5 mt-3">Submit Application</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Application Form End -->

<?php include 'footer.php'; ?>
