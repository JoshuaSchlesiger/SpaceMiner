<?php 
require "structure/header.php";
?>




<body>
    
<nav class="nv navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid ps-4">
        <a class="navbar-brand mb-auto nv-brand" href="index.php">SpaceMiner</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link active" href="uebermich.php">Über Mich</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registrieren.php">Registrieren</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link" href="login.php">Login</a>
                </li>

                <form class="d-flex" role="search">
                    <button class="btn btn-outline-success mt-2 mb-2" type="submit"
                        style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">DE</button>
                </form>
            </ul>
        </div>
    </div>
</nav>

    <div class="row">
        <div class=" col mt-5 ms-5 me-5">
            <div class="vertical-center card">
                <h5 class="card-header">Wer bin ich?</h5>
                <div class="card-body">
                    <h5 class="card-title">Ich bin Joshua aka DochSergeantTV</h5>
                    <p class="card-text">
                        Ein so typischer Softwareentwickler, der nicht viel vom Leben bisher weiß. Aktuell habe ich einfach Lust und Langeweile während meiner
                        Ausblidung diese doch ziemlich coole Website für Star Citizen zu bauen.<br><br>
                        Ich helfe gerne anderen Mitspieler oder Spiele mit ein paar großen oder kleinen Gruppen eine Runde Mining im All.

                        Wenn du mal jemanden wie da rechts im Bild mit einer pinken Katzenrüstung rumlaufen siehts, da bin das bestimmt ich oder ein anderer doch auch so verblödeter Depp.
                        Es kann auch sein, das du mal wen gegen eine Station fliegen siehts mit seiner Prosi. Das bin dann auch ich gewesen. <br><br>
                        
                        Joa was kann man noch so sagen ^^ Ich mag Steine. Ne Spaß besucht mich doch gerne mal auf Twitch oder GitHub. <br><br><br>

                        PS: Ich hab keinen Plan was ich mit euren Daten machen soll, muhahahaha. Also alles sAvE HiEr :D 
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-5 col-xl-5 col-sm-3">
            <div class="d-flex justify-content-center skin">
                <img src="images/Skin.png" class="" alt="me ^^">
            </div>
        </div>
    </div>


    <?php
    require "structure/footer.php";
    ?>

   
</body>
</html>