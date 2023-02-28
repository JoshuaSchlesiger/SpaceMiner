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
                    <a class="nav-link active" href="berechnungen.php">Berechnungen</a>
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
                    <button class="btn btn-outline-success mt-2 mb-2" type="submit"
                        style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">DE</button>
                </form>

            </ul>
        </div>
    </div>
</nav>


<?php
    require "structure/footer.php";
    ?>

   
</body>
</html>