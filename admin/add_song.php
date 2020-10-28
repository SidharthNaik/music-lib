<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($database . ":host=" . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $password, $options);

    $new_song = array(
      "songName" => $_POST['songName'],
      "artistName"  => $_POST['artistName'],
      "genre"     => $_POST['genre'],
      "musicLink"  => $_POST['musicLink']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "songs",
      implode(", ", array_keys($new_song)),
      ":" . implode(", :", array_keys($new_song))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_song);
  } catch (PDOException $error) {
    echo "<br>" . $error->getMessage();
  }
}
?>

<?php require "../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php $message = "Song successfully added";
echo "<script type='text/javascript'>alert('$message');</script>"; ?>
<?php } ?>
<div>
  <div class="container">
    <div class="justify-content-center white-bg p-4 border border-primary rounded">
      <h2>Add a Song</h2>
      <form method="post">
        <div class="form-group">
          <label for="songName">Song Name:</label>
          <input type="text" class="form-control" name="songName" id="songName" placeholder="Enter the Song Title">
        </div>
        <div class="form-group">
          <label for="artistName">Artist Name:</label>
          <input type="text" class="form-control" name="artistName" id="artistName" placeholder="Enter the Artist of the Song">
        </div>
        <div class="form-group">
          <label for="genre">Genre:</label>
          <input type="text" class="form-control" name="genre" id="genre" placeholder="Enter Genre of the song">
        </div>
        <div class="form-group">
          <label for="musicLink">Music Link:</label>
          <input type="text" class="form-control" name="musicLink" id="musicLink" placeholder="Enter the link to the song">
        </div>
        <button type="submit" name="submit" value="" class="btn btn-primary">Save</button>
      </form>
      <div class="container pt-4">
        <div class="d-flex justify-content-center" style="color:black"><a href="home.php"><u>Back to home</u></a></div>
      </div>
      
    </div>
  </div>
</div>

<?php require "../templates/footer.php"; ?>