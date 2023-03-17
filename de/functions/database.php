<?php

$conn;

function connect(){
$servername = "localhost";
$username = "spaceminer";
$password = "7XjnJBdMiik9uxB4QVaBM6H9PqvzrCL9ijSpHPe3ghMpQ8hRsM77v9ZBrW4knVYYoWUfL4xqPknJ4UfAtA3aro7RWFk734fAN97n2egjrfYWqFf9jW2V6o7ZGN2FsBH4";
$dbname = "spaceminer";

  try {
    $conn = new PDO("mysql:host=$servername;$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die("Connection to database failed. Please be patient");
  }
}



function register($username_status, $password_status, $checkbox_status){
  if($username_status == "" && $password_status == ""  && $checkbox_status == ""){

      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql = "INSERT INTO MyGuests (firstname, lastname, email)
      VALUES ('John', 'Doe', 'john@example.com')";
      $conn->exec($sql);
  }
}

?>