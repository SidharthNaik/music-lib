<?php

/**
 * Delete a user
 */

require "../config.php";
require "../common.php";

// if (isset($_GET["id"])) {
//   try {
//     $connection = new PDO($database . ":host=" . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $password, $options);

//     $id = $_GET["id"];

//     $sql = "DELETE FROM songs WHERE id = :id";

//     $statement = $connection->prepare($sql);
//     $statement->bindValue(':id', $id);
//     $statement->execute();

//     $success = "Song successfully deleted";
//   } catch (PDOException $error) {
//     echo $sql . "<br>" . $error->getMessage();
//   }
// }
if (isset($_POST['submit'])) {
    try {

        $connection = new PDO($database . ":host=" . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $password, $options);

        $sql = "SELECT *
      FROM songs
      WHERE artistName = :artistName
      OR songName = :artistName";

        $artistName = $_POST['artistName'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':artistName', $artistName, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    try {
        $connection = new PDO($database . ":host=" . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $password, $options);

        $sql = "SELECT * FROM songs";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php include "../templates/header.php"; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link disabled" href="add_song.php">Enjoy Music <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li> -->
        </ul>
        <form method="post" action="home.php" class="form-inline mr-auto pl-4">
            <input class="form-control mr-sm-2" type="text" id="artistName" name="artistName" placeholder="Search" aria-label="Search">
            <button type="submit" name="submit" value="Submit" class="btn btn-outline-success my-2 my-sm-0">Search</button>
        </form>
        <button class="btn btn-outline-success my-2 my-lg-0" type="button"><a href="../login.php">Logout</a></button>
    </div>
</nav>
<div>
    <div class="container">
        <div class="justify-content-center white-bg p-4 mt-4 border border-primary rounded">
            <div class="container">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Artist</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) : ?>
                            <tr>
                                <td> <?php echo escape($row["songName"]); ?> </td>
                                <td> <?php echo escape($row["artistName"]); ?> </td>
                                <td> <?php echo escape($row["genre"]); ?> </td>
                                <td><a href=<?php echo escape($row["musicLink"])?> target="_blank">Play Song </a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../templates/footer.php"; ?>