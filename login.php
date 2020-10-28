<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) {
    require "config.php";
    require "common.php";

    try {
        $connection = new PDO($database . ":host=" . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $password, $options);

        $user = $_POST['username'];
        $pass = $_POST['password'];
        echo '<script>console.log("username - ' . $user . '; password - ' . $pass . '")</script>';

        $sql = "SELECT * FROM `users` WHERE username='" . $user . "' AND password='" . $pass . "'";
        echo '<script>console.log("SQL - ' . $sql . '")</script>';
        $statement = $connection->prepare($sql);
        $statement->execute();
        $userdetails = $statement->fetch(PDO::FETCH_ASSOC);
        if (count($userdetails) > 1) {
            if($user == 'admin'){
                header("Location: admin/home.php");
            } else {
                header("Location: user/home.php");
            }
            
        } else {
            $message = "Invalid Username/password";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } catch (PDOException $error) {
        $message = "Invalid Username/password";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>


<?php include "templates/header.php"; ?>
<div>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="login.php">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="username" name="username" id="username">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="password" name="password" id="password">
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Remember Me
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" value="Submit" class="btn float-right login_btn">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?<a href="register.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>