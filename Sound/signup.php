<?php
    session_start();
if (isset($_SESSION["page"])) {
    unset($_SESSION["page"]);
}
$_SESSION["page"] = 'signup';
include("./components/header.php");
?>

<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Sign Up</h2>
                    <p>Welcome to the official Anime blog.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Signup Section Begin -->
<section class="signup spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Sign Up</h3>
                    <form method="post">
                        <div class="input__item">
                            <input type="text" placeholder="Full Name" name="full_name">
                            <span class="icon_profile"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" placeholder="Username" name="username">
                            <span class="icon_profile"></span>
                        </div>
                        <div class="input__item">
                            <input type="email" placeholder="Email address" name="email">
                            <span class="icon_mail"></span>
                        </div>
                        <div class="input__item">
                            <input type="password" placeholder="Password" name="password">
                            <span class="icon_lock"></span>
                        </div>
                        <div class="input__item">
                            <input type="password" placeholder="Confirm Password" name="confirm_password">
                            <span class="icon_lock"></span>
                        </div>
                        <button type="submit" name="submit" class="site-btn">Sign Up</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__register">
                    <h3>Already have an account?</h3>
                    <a href="./login.php" class="primary-btn">Login Now</a>
                </div>
            </div>
        </div>  
    </div>
</section>
<!-- Signup Section End -->

<?php
include("./components/footer.php");
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $current_date = date("Y-m-d");

    $sql_check_user = "SELECT * FROM users WHERE username='$username' OR email='$email';";
    $result_check_user = mysqli_query($conn, $sql_check_user);

    $sql_check_ban = "SELECT * FROM banned_users WHERE email='$email';";
    $result_check_ban = mysqli_query($conn, $sql_check_ban);

    if ($result_check_user and mysqli_num_rows($result_check_user) > 0) {
        echo "<script>alert('Username or Email already exists!');</script>";
    } else if ($result_check_ban and mysqli_num_rows($result_check_ban) > 0) {
        echo "<script>alert('Email is banned!');</script>";
    } else {
        if ($full_name and $username and $email and $password == $confirm_password) {
            $password = md5($password);
            $sql_register_user = "INSERT INTO users(full_name, username, email, password, user_role, date_registered) values('$full_name', '$username', '$email', '$password', 'user', '$current_date')";
            $result_register_user = mysqli_query($conn, $sql_register_user);
        }
    }
}
?>