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

    $new_user = array(
      "username" => $_POST['username'],
      "email"  => $_POST['email'],
      "password"     => $_POST['password']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch (PDOException $error) {
    echo "<br>" . $error->getMessage();
  }
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php $message = "User successfully added";
echo "<script type='text/javascript'>alert('$message');</script>"; ?>
<?php } ?>

<div>
  <div class="container">
    <div class="justify-content-center white-bg p-4 border border-primary rounded">
      <h2>Register New User</h2>
      <form method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Enter the Username">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control" name="password" id="password" placeholder="Enter the Password">
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="text" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Re-enter the Password">
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" name="submit" value="" class="btn btn-primary">Create</button>
        </div>
      </form>
      <div class="container pt-4">
        <div class="d-flex justify-content-center links" style="color:black">Have an account?<a href="login.php" style="color:blue;">Login</a></div>
      </div>
    </div>
  </div>
</div>



<!-- <a href="index.php">Back to home</a> -->

<?php require "templates/footer.php"; ?>