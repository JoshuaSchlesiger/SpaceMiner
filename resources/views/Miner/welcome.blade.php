@extends('layouts/base')


@section('content')
    <header>
        <div class="index-bg-text ">
            <h1>Willkommen zum SpaceMiner</h1>
            <p>Hier beginnt der Spaß, trust me :D</p>
        </div>

        <img class="index-bg-image" src="{{url('/images/u-mining.png')}}" alt="Miningbild" title="Miningbild" />
    </header>

    <div class="row">
        <div class="col mt-5 ms-5 me-5">
            <div class="index-vertical-center card">
                <h5 class="card-header">Was bin ich?</h5>
                <div class="card-body">
                    <h5 class="card-title">Der SpacerMiner für allerlei</h5>
                    <p class="card-text">
                        Hast du auch genug davon, im Unklaren darüber zu sein, wie viel ein Stein im All oder auf einem
                        Planeten für dich wert ist
                        oder ob er zu viel Masse für dein Schiff hat? <br>
                        Möchtest du, deine Crew oder Organisation eine große Mining-Tour starten,
                        aber am Ende muss jemand stundenlang damit beschäftigt sein, zu verfolgen, wer, was, wo und wie
                        viel abgebaut wurde,
                        und alles an die Spieler überweisen?<br><br>
                        Nun hilft dir diese Website. Der SpaceMiner erstellt für dich Berechnungen für alles Mögliche an
                        und speichert diese auch. <br><br>
                        Registerie dich jetzt um den vollen Umfang vom SpaceMiner zu nutzen.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class=" d-flex justify-content-center ">
                <img src="{{url('/images/t-stone.png')}}" class="index-ustone" alt="Geiler Quantaniumstein ^^" title="Quantaniumstein">
            </div>
        </div>
    </div>
@endsection
