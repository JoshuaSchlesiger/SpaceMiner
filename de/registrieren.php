<?php
session_start();


require "structure/header.php";
require "functions/database.php";
require "functions/register_query.php";



$password_status = "";
$checkbox_status = "";
$username_statusCheck = "";
$username_statusUsed = "";

if(!isset($_SESSION["start_time"])){
    $_SESSION["start_time"] = time();
}

$conn = connect();


if(isset($_POST["sentRegister"])){


        $username_statusCheck = usernameCheck();
        $username_statusUsed = usernameUsed($conn, $_POST["username"]);
        $password_status = password();
        $checkbox_status = checkbox();
    
        if($username_statusCheck == "" && $password_status == "" && $checkbox_status == "" && $username_statusUsed == ""){

            $_SESSION["end_time"] = time();
            $time_diff = $_SESSION["end_time"] - $_SESSION["start_time"];

            if($time_diff > 5){
                
                unset($_SESSION["start_time"]);
                unset($_SESSION["end_time"]);
    
                register($conn, $_POST["username"], $_POST["password"]);
                $_SESSION["loggedIn"] = "true";
                $_SESSION["username"] = $_POST["username"];
                unset($_POST["sentRegister"]);
                header("Location: dashboard.php");
                exit();
            }
            else{
                die("Bist du ein Bot?! Lass dir mal mehr Ziet bei Registrieren, versuche es erneut");
            }

        }
        else{
            $_SESSION["loggedIn"] = "false";
            unset($_POST["sentRegister"]);
        }
}

if(isset($_POST["logout"])){
    $_SESSION["loggedIn"] = "false";
    unset($_POST["sentRegister"]);
    session_destroy();
}

?>



<body>

    <nav class="nv navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container-fluid ps-4">
            <a class="navbar-brand mb-auto nv-brand" href="index.php">SpaceMiner</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-lg-0">
                <?php
                        if(isset($_SESSION["loggedIn"])){
                            if($_SESSION["loggedIn"] == "true"){
                                echo '
                                <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="auftraege.php">Aufträge</a>
                                </li>
                                ';
                            }
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="berechnungen.php">Berechnungen</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="uebermich.php">Über Mich</a>
                    </li>
                    <?php
                        if(isset($_SESSION["loggedIn"])){
                            if($_SESSION["loggedIn"] == "true"){
                                echo '<li class="nav-item">
                                <form action="" method="post">
                                    <button type="submit" class="btn btn-link hyperlink" name="logout">Logout</button>
                                </form>
                            </li>';
                            }
                            else{
                                echo '<li class="nav-item">
                                        <a class="nav-link " href="registrieren.php">Registrieren</a>
                                    </li>
                                    <li class="nav-item me-2">
                                        <a class="nav-link" href="login.php">Login</a>
                                    </li>';
                            }
                        }else{
                            echo '<li class="nav-item">
                            <a class="nav-link active" href="registrieren.php">Registrieren</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>';
                        }
                    ?>


                    <form class="d-flex" role="search">
                        <button class="btn btn-outline-success mt-2 mb-2 language" type="submit">DE</button>
                    </form>

                </ul>
            </div>
        </div>
    </nav>

    <div class="registerbgimage">
        <div class="vh-100 w-100 d-flex align-items-center">
            <div class="LoReformContainer LoRewindow">

                <form action="" method="post">
                    <div>
                        <span class="LoReinputLogo"><img src="/de/images/icons/user.png" alt="user" class="icon_footer"></span>
                        <input type="text" class="LOREinput form-control rounded-pill " name="username" placeholder="Username" value="<?php if(isset($_POST["username"])){echo htmlspecialchars($_POST["username"]);}?>">
                    </div>
                    <div class="text-danger fst-italic ms-2"><?php echo $username_statusCheck; echo $username_statusUsed ?></div>
                    <div class="mt-3">
                        <span class="LoReinputLogo"><img src="/de/images/icons/key.png" alt="key" class="icon_footer"></span>
                        <input type="password" class="form-control rounded-pill LOREinput" name="password" placeholder="Passwort">
                    </div>
                    <div class="mt-2">
                        <span class="LoReinputLogo"><img src="/de/images/icons/key.png" alt="key" class="icon_footer"></span>
                        <input type="password" class="form-control rounded-pill LOREinput" name="password2" placeholder="Passwort wiederholen">
                    </div>
                    <div class="text-danger fst-italic ms-2"><?php echo $password_status?></div>
                    <div class="form-check mt-2 ms-2">
                        <input class="form-check-input" type="hidden" name="checkbox" value="0" id="flexCheckChecked2" checked />
                        <input class="form-check-input" type="checkbox" name="checkbox" value="1" id="flexCheckChecked" checked />
                        <label class="form-check-label" for="flexCheckChecked">
                            <a href="datenschutz.php" class="hyperlink" target="_blank">Datenschutzerklärung</a>
                        </label>
                    </div>
                    <div class="text-danger fst-italic ms-2"><?php echo $checkbox_status?></div>

                    <div class="mt-3">
                        <button class="btn LoRebtn-accent rounded-pill w-100" type="submit" name="sentRegister">Registrieren</button>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <?php
    require "structure/footer.php";
    ?>


</body>

</html>