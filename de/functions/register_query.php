<?php



function usernameCheck(){
    if(isset($_POST["username"])){
        if(!preg_match('/^[a-z0-9 .\-]+$/i', $_POST["username"]))
        {
            return "Nutzername darf keine Sonderzeichen haben";
        }
        if($_POST["username"] == ""){
            return "Nutzername darf nicht leer sein";
        }
        if(ctype_punct($_POST["username"])){
            return "Nutzername darf keine Sonderzeichen haben";
        }
        if(strlen($_POST["username"]) > 256){
            return "Nutzername zu lang";
        }
    }
}

function usernameUsed($conn, $name){
        $stmt = $conn->prepare('SELECT * FROM website_user WHERE name = :eins');
        $stmt->bindParam(':eins', $name);
        $stmt->execute();
        $value = $stmt->fetch();
        if(!empty($value)){
            return "Nutzername schon belegt";
        }
}

function password(){
    if(isset($_POST["password"])){
        if($_POST["password"] == ""){
            unset($_POST['password']);
            return "Password darf nicht leer sein";
        }
        if(strlen($_POST["password"]) <= 8){
            return "Password muss länger als 8 Zeichen sein";
        }
    }
    if(isset($_POST["password"], $_POST["password2"])){
        if ($_POST["password"] != $_POST["password2"]){
            unset($_POST['password']);
            return "Password ungleich";
        }
    }
}

function checkbox(){
    if(isset($_POST["checkbox"])){
        if(strcmp($_POST["checkbox"], "1")){
            unset($_POST['checkbox']);
            return "Datenschutz muss zugestimmt sein";
        }
    }
}
