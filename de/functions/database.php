<?php

function connect(){
$servername = "localhost";
$username = "spaceminer";
$password = "7XjnJBdMiik9uxB4QVaBM6H9PqvzrCL9ijSpHPe3ghMpQ8hRsM77v9ZBrW4knVYYoWUfL4xqPknJ4UfAtA3aro7RWFk734fAN97n2egjrfYWqFf9jW2V6o7ZGN2FsBH4";
$dbname = "spaceminer";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch(PDOException $e) {
    die("Connection to database failed. Please be patient");
  }
}

function register($conn, $username, $password){

  try {
    $password = passwordHash($password);

    // SQL-Abfrage zum Einfügen von Daten
    $stmt = $conn->prepare("INSERT INTO website_user (name, password) 
                            VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    // Abfrage ausführen
    $stmt->execute();
  } 
  catch(PDOException $e) {
  }
}

function login($conn, $username, $password){

  $stmt = $conn->prepare('SELECT * FROM website_user WHERE name = :eins');
  $stmt->bindParam(':eins', $username);
  $stmt->execute();
  $value = $stmt->fetch();
  if(empty($value)){
      return "Nutzername nicht vergeben";
  }
  else{
    if(!password_verify($password, $value[2])){
      return "Password falsch";
    }
  }
}


function getAllNameRefineryStations($conn){
  $stmt = $conn->prepare('SELECT name FROM refinery_station');
  $stmt->execute();
  $value = $stmt->fetchAll();
  return $value;
}

function getOreTypes($conn){
  $stmt = $conn->prepare('SELECT * FROM type');
  $stmt->execute();
  $type = $stmt->fetchAll();
  return $type;
}


function passwordHash($password){
  $pass = password_hash($password, PASSWORD_DEFAULT);
  return $pass;
}


function createJob(){

  try {
    $conn = connect();

    $userIDandNumber = getHighestNumberOfJobs();
    $userIDandNumber[0][0] += 1;

    // SQL-Abfrage zum Einfügen von Daten
    $stmt = $conn->prepare("INSERT INTO job (number, website_user_id) 
                            VALUES (:number, :website_user_id)");
    $stmt->bindParam(':number', $userIDandNumber[0][0]);
    $stmt->bindParam(':website_user_id', $userIDandNumber[0][1]);

    // Abfrage ausführen
    $stmt->execute();
  } 

  catch(PDOException $e) {

  }

}

function getHighestNumberOfJobs(){
  $conn = connect();

  $stmt = $conn->prepare('SELECT MAX(j.number) AS max_number, j.website_user_id  FROM website_user w JOIN job j ON w.id = j.website_user_id WHERE w.name = :username');
  $stmt->bindParam(':username', $_SESSION["username"]);
  $stmt->execute();
  $userIDandNumber = $stmt->fetchAll();


  return $userIDandNumber;
}



?>