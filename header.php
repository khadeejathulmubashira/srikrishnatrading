<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Krishna Trading Company</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- AOS (if not already included) -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


    
    
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
    <a href="index.php" class="navbar-brand bg-colorr w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
        <img src="img\realsklogo.jpeg" alt="SK Traders Logo" style="max-height: 100px;">
    </a>
</div>

                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">
                                   <a href="mailto:krishnakasaragod@gmail.com" class="text-dark text-decoration-none">
                                        krishnakasaragod@gmail.com
                                   </a>
                                </p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">
                    <a href="tel:+919684562413" class="text-dark text-decoration-none">
                        +91 7994177302
                    </a>
                </p>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                                <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                                <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                                <a class="" href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar bg-colorr navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="index.php" class="navbar-brand bg-colorr d-block d-lg-none">
                        <img src="img\realsklogo.jpeg" alt="Srikrishna Traders Logo" style="height: 100px;">
                        </a>

                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse bg-colorr justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php" class="nav-item nav-link ">Home</a>
                                <a href="about.php" class="nav-item nav-link">About</a>

                                <style>
/* Custom dropdown styles */
.nav-item.dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0;
}

.dropdown-menu {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 0.5rem 0;
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    width: 300px;
}

.dropdown-item {
    padding: 10px 15px;
    font-weight: 500;
    color: #333;
    position: relative;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #007BFF;
}

.dropdown-item img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 10px;
}

/* Submenu style */
.subsector-menu {
    position: absolute;
    left: 100%;
    top: 0;
    min-width: 220px;
    display: none;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    z-index: 999;
    border: 1px solid #ddd;
}

.dropdown-item:hover .subsector-menu {
    display: block;
}

.subsector-menu a {
    padding: 8px 15px;
    display: block;
    color: #333;
    white-space: nowrap;
}

.subsector-menu a:hover {
    background-color: #007BFF;
    color: #fff;
}
</style>

<div class="nav-item dropdown">
  <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sectors</a>
  <div class="dropdown-menu rounded-0">
    <?php
    include 'db.php';

    // Fetch sectors
    $sector_res = $conn->query("SELECT * FROM sectors ORDER BY id ASC");
    while ($sector = $sector_res->fetch_assoc()) {
        echo '<a class="dropdown-item d-flex align-items-center" href="products.php?sector_id=' . $sector['id'] . '">';
        echo '<img src="' . htmlspecialchars($sector['sector_image']) . '" alt="' . htmlspecialchars($sector['sector_name']) . '" class="me-2" style="width:40px; height:40px; object-fit:cover; border-radius:5px;">';
        echo htmlspecialchars($sector['sector_name']);
        echo '</a>';
    }
    ?>
  </div>
</div>



                            
                                <a href="carriers.php" class="nav-item nav-link">Carriers</a>
                                <a href="video.php" class="nav-item nav-link">Gallery</a>
                                <!--<a href="" class="nav-item nav-link">Achievements & Awards</a>-->
                                <!--<div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="booking.html" class="dropdown-item">Booking</a>
                                        <a href="team.html" class="dropdown-item">Our Team</a>
                                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                    </div>
                                </div>-->
                                <a href="contact.php" class="nav-item nav-link">Contact</a>
                            <!--</div>
                            <a href="https://htmlcodex.com/hotel-html-template-pro" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Premium Version<i class="fa fa-arrow-right ms-3"></i></a>
                        </div>-->
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->