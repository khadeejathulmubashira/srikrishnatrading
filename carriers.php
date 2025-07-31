<?php include 'header.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Join Our Team</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Careers Section Start -->
<!-- Careers Section Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h6 class="section-title text-start text-primary text-uppercase">Join Our Team</h6>
                <h1 class="mb-4">Careers at <span class="text-primary text-uppercase">Krishna Trading Company</span></h1>
                <p class="mb-4">
                    At Krishna Trading Company, we believe in building not only strong spaces but also strong teams. If you're passionate about sales, customer service, logistics, or design, we invite you to be part of our growing journey.
                </p>
                <p class="mb-4">
                    We value dedication, integrity, and a willingness to learn. Explore exciting career opportunities with us and help transform homes and commercial spaces with style and functionality.
                </p>
                <div class="text-center mb-4">
                    <img src="img\forcarrier .jpg" alt="Team at work" class="img-fluid rounded shadow" style="max-width: 90%; height: auto;">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row g-4">
                    <?php
                    include 'db.php';
                    $query = "SELECT * FROM careers ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0):
                        $delay = 0.1;
                        while ($row = mysqli_fetch_assoc($result)):
                    ?>
                        <div class="col-12 wow fadeIn" data-wow-delay="<?= $delay ?>s">
                            <div class="border rounded p-4">
                                <h5>📌 <?= htmlspecialchars($row['title']) ?></h5>
                                <p>Location: <?= htmlspecialchars($row['location']) ?> | Type: <?= htmlspecialchars($row['job_type']) ?></p>
                                <p class="mb-2"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                                <a href="apply.php?position=<?= urlencode($row['title']) ?>" class="btn btn-outline-primary btn-sm">Apply Now</a>
                            </div>
                        </div>
                    <?php
                            $delay += 0.1;
                        endwhile;
                    else:
                    ?>
                        <div class="col-12">
                            <div class="alert alert-info">No job openings available at the moment.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Careers Section End -->


<!-- Careers Section End -->

<?php include 'footer.php'; ?>
