<?php
require "structure/header.php";
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
                        <a class="nav-link" href="registrieren.php">Registrieren</a>
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

    <header>

        <div class="index-bg-image">
            <video width="100%" height="auto" autoplay muted loop id="myVideo">
                <source src="images/miningVid.mp4" type="video/mp4">
            </video>
        </div>
        <div class="index-bg-text">
            <h1>Willkommen zum SpaceMiner</h1>
            <p>Hier beginnt der Spaß, trust me :D</p>
        </div>


    </header>

    <div class="row">

        <div class="col mt-5 ms-5 me-5">
            <div class="index-vertical-center card">
                <h5 class="card-header">Was bin ich?</h5>
                <div class="card-body">
                    <h5 class="card-title">Der SpacerMiner für allerlei</h5>
                    <p class="card-text">
                        Hast du auch genug davon, im Unklaren darüber zu sein, wie viel ein Stein im All oder auf einem Planeten für dich wert ist
                        oder ob er zu viel Masse für dein Schiff hat? <br>
                        Möchtest du, deine Crew oder Organisation eine große Mining-Tour starten,
                        aber am Ende muss jemand stundenlang damit beschäftigt sein, zu verfolgen, wer, was, wo und wie viel abgebaut wurde,
                        und alles an die Spieler überweisen?<br><br>
                        Nun hilft dir diese Website. Der SpaceMiner erstellt für dich Berechnungen für alles Mögliche an und speichert diese auch. <br><br>
                        Registerie dich jetzt um den vollen Umfang vom SpaceMiner zu nutzen.<br><br><br>
                        PS. Es gibt kein Password-reset wenn es soweit kommt, dass du dir das nicht mal dein Passwort merken kannst.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class=" d-flex justify-content-center ">
                <img src="images/t-stone.png" class="index-ustone" alt="Geiler Quantaniumstein ^^">
            </div>
        </div>
    </div>


    <?php
    require "structure/footer.php";
    ?>


</body>

</html>