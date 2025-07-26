<?php
include 'db.php';

$message = '';
$email = isset($_GET['email']) ? $_GET['email'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $message = "<p style='color:red; text-align:center;'>Passwords do not match.</p>";
    } else {
        $hashed = md5($new_password); // Replace md5 with bcrypt if you want stronger hashing
        $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed, $email);
        if ($stmt->execute()) {
            echo "<div style='color:green; text-align:center;'>Password changed successfully! Redirecting to login page...</div>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 3000); // 3 seconds delay
            </script>";
            exit();
        } else {
            $message = "<p style='color:red; text-align:center;'>Failed to update password.</p>";
        }
    }
}
?>

<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: #f2f2f2;
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-box {
    background-color: #fff;
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
    box-sizing: border-box;
}

.login-box h3 {
    margin-bottom: 25px;
    text-align: center;
    color: #333;
}

.login-box input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}

.login-box input[type="submit"] {
    width: 100%;
    background-color: #007bff;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}

.login-box input[type="submit"]:hover {
    background-color: #0056b3;
}
</style>

<div class="login-container">
    <div class="login-box">
        <h3>Set New Password</h3>

        <?php if ($email): ?>
        <form method="post">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
            <input type="password" name="new_password" required placeholder="New Password">
            <input type="password" name="confirm_password" required placeholder="Confirm Password">
            <input type="submit" value="Set Password">
        </form>
        <?php else: ?>
        <p style="color:red; text-align:center;">Invalid or missing email.</p>
        <?php endif; ?>

        <?= $message ?>
    </div>
</div>
