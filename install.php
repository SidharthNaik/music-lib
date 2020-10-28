<?php

/**
  * Open a connection via PDO to create a
  * new database and table with structure.
  *
  */

require "config.php";

try {
  $connection = new PDO($database . ":host=" . $host . ';port=' . $port, $user, $password, $options);
  $sql = file_get_contents("data/init.sql");
  $connection->exec($sql);

  echo "Database and table songs created successfully.";

  $sql = file_get_contents("data/initUsers.sql");
  $connection->exec($sql);
  echo "Database and table users created successfully.";
  
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}