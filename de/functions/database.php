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
    echo "Daten erfolgreich gesendet.";
  } 
  catch(PDOException $e) {
    echo "Fehler beim Senden der Daten: " . $e->getMessage();
  }
}


function passwordHash($password){
  $pass = password_hash($password, PASSWORD_DEFAULT);
  return $pass;
}

?>