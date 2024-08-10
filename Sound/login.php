<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: ./index.php");
    die();
}

if (isset($_SESSION["page"])) {
    unset($_SESSION["page"]);
}
$_SESSION["page"] = 'login';
include("./components/header.php");
?>

<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Login</h2>
                    <p>Welcome to the official Anime blog.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Login Section Begin -->
<section class="login spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 login_page">
                <div class="login__form">
                    <h3>Login</h3>
                    <form action="#" method="POST">
                        <div class="input__item">
                            <input type="text" placeholder="Email address" name="email">
                            <span class="icon_mail"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" placeholder="Password" name="password">
                            <span class="icon_lock"></span>
                        </div>
                        <button type="submit" class="site-btn" name="submit">Login Now</button>
                    </form>
                    <a href="#" class="forget_pass">Forgot Your Password?</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__register">
                    <h3>Dont’t Have An Account?</h3>
                    <a href="./signup.php" class="primary-btn">Register Now</a>
                </div>
            </div>
        </div>
        <div class="login__social">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="login__social__links">
                        <span>or</span>
                        <ul>
                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With
                                    Facebook</a></li>
                            <li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Section End -->

<?php
include("./components/footer.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email and $password) {
        $password = md5($password);
        $sql_login = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result_login = mysqli_query($conn, $sql_login);
        $result_login_numbers = mysqli_num_rows($result_login);
        if ($result_login_numbers > 0) {
            $row = mysqli_fetch_assoc($result_login);
            $_SESSION["user_id"] = $row['id'];
            if ($row['user_role'] == 'admin') {
                $_SESSION["admin"] = $row['username'];
            }
            echo "<script>
    window.location.href = 'index.php';
    </script>";
        }
    }
}
?>