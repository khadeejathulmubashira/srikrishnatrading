



<?php
session_start();
include 'db.php';



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

.login-box h2 {
    margin-bottom: 25px;
    text-align: center;
    color: #333;
}

.login-box input[type="text"],
.login-box input[type="password"],
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

.error-msg {
    color: red;
    text-align: center;
    margin-bottom: 15px;
}
</style>

<div class="login-container">
    <div class="login-box">
        <h2>Admin Login</h2>

        <?php
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['admin'] = $username;
                header("Location: admindashboard.php");
                exit();
            } else {
                echo "<div class='error-msg'>Invalid login credentials!</div>";
            }
        }
        ?>

        <form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="login" value="Login">
</form>
<div style="text-align:center; margin-top:10px;">
    <a href="forgot_password.php">Forgot Password?</a>
</div>

    </div>
</div>


