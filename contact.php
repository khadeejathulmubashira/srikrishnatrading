<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
// Set Indian timezone
date_default_timezone_set('Asia/Kolkata');

// Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $submitted_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO contact (name, email, subject, message, submitted_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $subject, $message, $submitted_at);

    if ($stmt->execute()) {
        $success = "Message sent successfully!";
    } else {
        $error = "Failed to send message. Try again.";
    }
}
?>

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Contact Us</h6>
            <h1 class="mb-5"><span class="text-primary text-uppercase">Contact</span> For Any Query</h1>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <h6 class="section-title text-start text-primary text-uppercase">Booking</h6>
                        <p><i class="fa fa-envelope-open text-primary me-2"></i>book@example.com</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="section-title text-start text-primary text-uppercase">General</h6>
                        <p><i class="fa fa-envelope-open text-primary me-2"></i>info@example.com</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="section-title text-start text-primary text-uppercase">Technical</h6>
                        <p><i class="fa fa-envelope-open text-primary me-2"></i>tech@example.com</p>
                    </div>
                </div>
            </div>

            <!-- Google Map -->
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3895.1655795451807!2d74.99096147358043!3d12.505181824935521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba4825cd5598cd1%3A0x3a5cd76b410af900!2sSri%20Krishna%20Hardwares!5e0!3m2!1sen!2sin!4v1753269369811!5m2!1sen!2sin"
                    frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                </iframe>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success text-center"><?= $success ?></div>
                    <?php elseif (isset($error)): ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" id="message" placeholder="Leave a message here" style="height: 150px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php include 'footer.php'; ?>
