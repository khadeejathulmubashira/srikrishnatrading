<?php
include 'db.php';
if (!isset($_GET['id'])) {
    echo "No PDF selected.";
    exit();
}

$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM catalogues WHERE id = $id LIMIT 1");
if ($res->num_rows == 0) {
    echo "PDF not found.";
    exit();
}

$row = $res->fetch_assoc();
$pdfPath = $row['pdf_path'];
$title = $row['title'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title) ?> - Catalogue Viewer</title>
  <link rel="stylesheet" href="assets/css/style.css"> <!-- or your CSS file -->
  <style>
    .pdf-frame {
      width: 100%;
      height: 90vh;
      border: none;
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container my-4">
  <h2 class="text-center mb-4"><?= htmlspecialchars($title) ?></h2>
  <iframe class="pdf-frame" src="<?= $pdfPath ?>" allowfullscreen></iframe>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
