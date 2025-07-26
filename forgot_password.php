<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust if you're not using Composer
include 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $res = $conn->query("SELECT * FROM admin WHERE email = '$email'");
    if ($res->num_rows == 1) {
        $link = "http://localhost/sreekrishna_traders/reset_password.php?email=" . urlencode($email);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'workmubi951@gmail.com';
            $mail->Password = 'ywztqihgjohcrpxu'; // Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('workmubi951@gmail.com', 'Admin');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password';
            $mail->Body = "Click the button below to set a new password:<br><br>
                <a href='$link' style='padding:10px 20px; background:#007bff; color:white; text-decoration:none;'>Reset Password</a>";

            $mail->send();
            $message = "<p style='color:green; text-align:center;'>Reset link sent to your email.</p>";
        } catch (Exception $e) {
            $message = "<p style='color:red; text-align:center;'>Mailer Error: {$mail->ErrorInfo}</p>";
        }
    } else {
        $message = "<p style='color:red; text-align:center;'>Email not found.</p>";
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

.login-box input[type="email"] {
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
        <h3>Forgot Password</h3>

        <form method="post">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="submit" value="Send Reset Link">
        </form>

        <?= $message ?>
    </div>
</div>
