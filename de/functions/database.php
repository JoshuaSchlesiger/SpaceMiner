<?php
$servername = "localhost";
$username = "root";
$password = "7XjnJBdMiik9uxB4QVaBM6H9PqvzrCL9ijSpHPe3ghMpQ8hRsM77v9ZBrW4knVYYoWUfL4xqPknJ4UfAtA3aro7RWFk734fAN97n2egjrfYWqFf9jW2V6o7ZGN2FsBH4";

try {
  $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>