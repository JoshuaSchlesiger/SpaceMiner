<?php
session_start();


require "structure/header.php";
require "functions/database.php";
require "functions/register_query.php";

connect();

//$pass = password_hash($password, PASSWORD_DEFAULT);
//echo $pass;

$username_status = username();
$password_status = password();

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
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auftraege.php">Aufträge</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="berechnungen.php">Berechnungen</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="uebermich.php">Über Mich</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="registrieren.php">Registrieren</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

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
                <div class="text-center mb-4 pb-3">
                    <img src="/static_files/images/logos/rockMoon.png" alt="Logo" height="48">
                </div>

                <form action="" method="post">
                    <div>
                        <span class="LoReinputLogo"><i class="fas fa-user"></i></span>
                        <input type="text" class="LOREinput form-control rounded-pill " name="username" placeholder="Username" value="<?php if(isset($_POST["username"])){echo $_POST["username"];}?>">
                    </div>
                    <div class="text-danger fst-italic ms-2"><?php echo $username_status?></div>
                    <div class="mt-3">
                        <span class="LoReinputLogo"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control rounded-pill LOREinput" name="password" placeholder="Passwort">
                    </div>
                    <div class="mt-2">
                        <span class="LoReinputLogo"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control rounded-pill LOREinput" name="password2" placeholder="Passwort wiederholen">
                    </div>
                    <div class="text-danger fst-italic ms-2"><?php echo $password_status?></div>
                    <div class="form-check mt-2 ms-2">
                        <input class="form-check-input" type="checkbox" name="checkbox" value="" id="flexCheckChecked" checked />
                        <label class="form-check-label" for="flexCheckChecked"><a href="datenschutz.php" class="hyperlink" target="_blank">Datenschutzerklärung</a></label>
                    </div>

                    <div class="mt-3">
                    <button class="btn LoRebtn-accent rounded-pill w-100" type="submit">Registrieren</button>
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