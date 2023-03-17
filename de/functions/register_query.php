<?php



function username(){
    if(isset($_POST["username"])){
        if($_POST["username"] == ""){
            return "Nutzername darf nicht leer sein";
        }
    }
}

function password(){
    if(isset($_POST["password"])){
        if($_POST["password"] == ""){
            return "Password darf nicht leer sein";
        }
    }
    if(isset($_POST["password2"])){
        if($_POST["password2"] == ""){
            return "Wiederholung darf nicht leer sein";
        }
    }
    if(isset($_POST["password"], $_POST["password2"])){
        if ($_POST["password"] != $_POST["password2"]){
            return "Password ungleich";
        }
    }
}

function checkbox(){
    if(isset($_POST["checkbox"])){
        if(strcmp($_POST["checkbox"], "1")){
            return "Datenschutz muss zugestimmt sein";
        }
    }
}
