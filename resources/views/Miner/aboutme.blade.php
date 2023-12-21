@extends('layouts/base')


@section('content')
    <div class="row">
        <div class="col-xxl-7 col-xl-5 col-sm-10 mt-5 ms-5">
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
        <div class="mt-5 col-xxl-4 col-xl-5 col-sm-10">
            <div class="d-flex justify-content-center skin">
                <img src="{{url('/images/skin.png')}}" class="" alt="me ^^">
            </div>
        </div>
    </div>
    @endsection
