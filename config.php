<?php

/**
  * Configuration for database connection
  *
  */
  $host       = '127.0.0.1'; //or localhost
  $database   = 'mysql';
  $port       = 3306;
  $user       = 'root';
  $password   = '';
  $dbname     = "test";
/*$host       = "localhost";
$username   = "";
$password   = "";
$dbname     = "test"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later*/
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
              ?>