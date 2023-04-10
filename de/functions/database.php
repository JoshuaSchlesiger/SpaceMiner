<?php

function connect()
{
  $servername = "localhost";
  $username = "spaceminer";
  $password = "7XjnJBdMiik9uxB4QVaBM6H9PqvzrCL9ijSpHPe3ghMpQ8hRsM77v9ZBrW4knVYYoWUfL4xqPknJ4UfAtA3aro7RWFk734fAN97n2egjrfYWqFf9jW2V6o7ZGN2FsBH4";
  $dbname = "spaceminer";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOException $e) {
    die("Connection to database failed. Please be patient");
  }
}

function register($conn, $username, $password)
{

  try {
    $password = passwordHash($password);

    // SQL-Abfrage zum Einfügen von Daten
    $stmt = $conn->prepare("INSERT INTO website_user (name, password) 
                            VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    // Abfrage ausführen
    $stmt->execute();
  } catch (PDOException $e) {
  }
}

function login($conn, $username, $password)
{

  $stmt = $conn->prepare('SELECT * FROM website_user WHERE name = :eins');
  $stmt->bindParam(':eins', $username);
  $stmt->execute();
  $value = $stmt->fetch();
  if (empty($value)) {
    return "Nutzername nicht vergeben";
  } else {
    if (!password_verify($password, $value[2])) {
      return "Password falsch";
    }
  }
}


function getAllNameRefineryStations($conn)
{
  $stmt = $conn->prepare('SELECT name FROM refinery_station');
  $stmt->execute();
  $value = $stmt->fetchAll();
  return $value;
}

function getOreTypes($conn)
{
  $stmt = $conn->prepare('SELECT * FROM type');
  $stmt->execute();
  $type = $stmt->fetchAll();
  return $type;
}


function passwordHash($password)
{
  $pass = password_hash($password, PASSWORD_DEFAULT);
  return $pass;
}


function createJob()
{

  try {
    $conn = connect();

    $highestNumber = getHighestNumberOfJobs($conn);

    if ($highestNumber == null) {
      $highestNumber = 1;
    } else {
      $highestNumber++;
    }

    $stmt = $conn->prepare("INSERT INTO job (number, website_user_id) 
                            VALUES (:number, :website_user_id)");
    $stmt->bindParam(':number', $highestNumber);
    $userId = getUserID();
    $stmt->bindParam(':website_user_id', $userId);

    $stmt->execute();

    //Job ID bekommen zum geweiligen Auftrag zum erstellen der Crews
    $jobID = getIDofJob($conn, $highestNumber, $userId);
    createCrew($conn, $jobID);

    $crews = $_SESSION["crews2"];

    $numCrews = count($crews);

    for ($i = 0; $i < $numCrews; $i++) {
      $crewID = getIDofCrew($conn, $crews[$i]->CrewName, $jobID);
      createMiner($conn, $i ,$crewID);
      createScout($conn, $i ,$crewID);
    }

    
  } catch (PDOException $e) {
  }
}

function getHighestNumberOfJobs($conn)
{

  $userID = getUserID();

  $stmt = $conn->prepare('SELECT MAX(number) AS number FROM job WHERE website_user_id = :id');
  $stmt->bindParam(':id', $userID);
  $stmt->execute();
  $highestNumber = $stmt->fetch();

  return $highestNumber["number"];
}

function getUserID()
{
  $conn = connect();

  $stmt = $conn->prepare('SELECT id FROM website_user WHERE name = :username');
  $stmt->bindParam(':username', $_SESSION["username"]);
  $stmt->execute();
  $userID = $stmt->fetch();

  return $userID["id"];
}

function getIDofJob($conn, $number, $userId)
{
  $stmt = $conn->prepare('SELECT id FROM job WHERE number = :number AND website_user_id = :website_user_id');
  $stmt->bindParam(':website_user_id', $userId);
  $stmt->bindParam(':number', $number);
  $stmt->execute();

  $jobID = $stmt->fetch();
  return $jobID["id"];
}

function createCrew($conn, $jobID)
{
  $crews = $_SESSION["crews2"];

  foreach ($crews as $crew) {
    $crewName = $crew->CrewName;
    
    
    $stmt = $conn->prepare("INSERT INTO crew (name, job_id) 
    VALUES (:name, :job_id)");
    $stmt->bindParam(':name', $crewName);
    $stmt->bindParam(':job_id', $jobID);
    $stmt->execute();
  }
}

function getIDofCrew($conn, $crewName, $jobID)
{

  $stmt = $conn->prepare('SELECT id FROM crew WHERE name = :crewName AND job_id = :job_id');
  $stmt->bindParam(':crewName', $crewName);
  $stmt->bindParam(':job_id', $jobID);
  $stmt->execute();

  $jobID = $stmt->fetch();
  return $jobID["id"];
}

function createMiner($conn, $crewNumber, $crewID)
{

  $crews = $_SESSION["crews2"];

  for($i = 0; $i < count($crews[$crewNumber]->MinerNames); $i++) {

    $stmt = $conn->prepare("INSERT INTO player (name, type, crew_id) 
                            VALUES (:name, 0, :crew_id)");

    $stmt->bindParam(':name', $crews[$crewNumber]->MinerNames[$i]);
    $stmt->bindParam(':crew_id', $crewID);
    $stmt->execute();
  }
}

function createScout($conn, $crewNumber, $crewID)
{

  $crews = $_SESSION["crews2"];

  for($i = 0; $i < count($crews[$crewNumber]->ScoutNames); $i++) {

    $stmt = $conn->prepare("INSERT INTO player (name, type, crew_id) 
                            VALUES (:name, 1, :crew_id)");

    $stmt->bindParam(':name', $crews[$crewNumber]->ScoutNames[$i]);
    $stmt->bindParam(':crew_id', $crewID);
    $stmt->execute();
  }
}

function getJobs($conn){

  $userID = getUserID();

  $stmt = $conn->prepare('SELECT j.id AS jid, number, c.id AS cid, c.seller, c.name AS cname, c.paid_in_status, p.id AS pid, p.name AS pname, p.type, p.paid_out_status 
                          FROM job j
                          JOIN crew c ON j.id = c.job_id
                          JOIN player p ON c.id = p.crew_id
                          WHERE j.website_user_id = :id');

  $stmt->bindParam(':id', $userID);+
  $stmt->execute();

  $jobs = $stmt->fetchAll();
  return $jobs;

}

function getLatestJobs($conn){

  $jobID = getIDofLatestJobs($conn);

  $stmt = $conn->prepare('SELECT j.id AS jid, number, c.id AS cid, c.seller, c.name AS cname, c.paid_in_status, p.id AS pid, p.name AS pname, p.type, p.paid_out_status 
                          FROM job j
                          JOIN crew c ON j.id = c.job_id
                          JOIN player p ON c.id = p.crew_id
                          WHERE j.id = :id');

  $stmt->bindParam(':id', $jobID);+
  $stmt->execute();

  $jobs = $stmt->fetchAll();
  return $jobs;

}

function getIDofLatestJobs($conn){

  $userID = getUserID();
  $stmt = $conn->prepare('SELECT id
                          FROM job j
                          WHERE j.website_user_id = :id 
                          AND number = (SELECT MAX(number) FROM job)');

  $stmt->bindParam(':id', $userID);+
  $stmt->execute();

  $jobs = $stmt->fetch();
  return $jobs["id"];

}