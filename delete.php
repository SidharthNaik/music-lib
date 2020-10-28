<?php

/**
 * Delete a user
 */

require "config.php";
require "common.php";

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($database . ":host=" . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $password, $options);

    $id = $_GET["id"];

    $sql = "DELETE FROM songs WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "Song successfully deleted";
  } catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($database . ":host=" . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $password, $options);

  $sql = "SELECT * FROM songs";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch (PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>

<h2>Delete Songs</h2>

<?php if ($success) echo $success; ?>

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
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["id"]); ?></td>
        <td><?php echo escape($row["songName"]); ?></td>
        <td><?php echo escape($row["artistName"]); ?></td>
        <td><?php echo escape($row["genre"]); ?></td>
        <td><?php echo escape($row["musicLink"]); ?></td>
        <td><?php echo escape($row["date"]); ?> </td>
        <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>