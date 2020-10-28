<?php

/**
  * Function to query information based on
  * a parameter: in this case, artistName.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "config.php";
    require "common.php";

    $connection = new PDO($database . ":host=" . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $password, $options);

    $sql = "SELECT *
    FROM songs
    WHERE artistName = :artistName";

    $artistName = $_POST['artistName'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':artistName', $artistName, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>#</th>
  <th>Song Name</th>
  <th>Artist Name</th>
  <th>Genre</th>
  <th>Music Link</th>
  <th>Date</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["id"]); ?></td>
<td><?php echo escape($row["songName"]); ?></td>
<td><?php echo escape($row["artistName"]); ?></td>
<td><?php echo escape($row["genre"]); ?></td>
<td><?php echo escape($row["musicLink"]); ?></td>
<td><?php echo escape($row["date"]); ?> </td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['artistName']); ?>.
  <?php }
} ?>

<h2>Find user based on Artist</h2>

<form method="post">
  <label for="artistName">Artist</label>
  <input type="text" id="artistName" name="artistName">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>