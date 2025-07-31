<?php
include 'db.php';
include 'header.php';
?>

<style>
    body {
        background: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .gallery-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #222;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }

    .gallery-title::after {
        content: "";
        width: 70px;
        height: 3px;
        background: #f39c12; /* same orange */
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
    }

    .video-card {
        border: 1px solid #eee;
        border-left: 5px solid #f39c12;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        background: #fff;
    }

    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .video-card video {
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: #000;
    }

    .video-card .card-body {
        padding: 20px;
    }

    .video-card .card-title {
        font-weight: 600;
        color: #222;
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .video-card .card-text {
        font-size: 0.95rem;
        color: #444;
    }

    .section-subtitle {
        font-weight: 500;
        text-transform: uppercase;
        color: #f39c12;
        font-size: 0.85rem;
        letter-spacing: 1px;
        text-align: center;
        margin-bottom: 5px;
    }
</style>

<div class="container py-5">
    <!--<div class="section-subtitle">Our Gallery</div>-->
    <div class="container">
    <h6 class="section-title text-center text-primary text-uppercase">Our Gallery</h6>
    <h1 class="mb-5"><span class="text-primary text-uppercase">Explore</span> Our Gallery</h1>

    <div class="row g-4">
        <?php
        $res = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
        if ($res->num_rows > 0):
            while ($row = $res->fetch_assoc()):
        ?>
            <div class="col-md-6 col-lg-4">
                <div class="card video-card h-100">
                    <video src="<?= htmlspecialchars($row['video_path']) ?>" controls></video>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-muted">No videos available at the moment.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
