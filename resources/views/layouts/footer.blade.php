@section('footer')
    <footer class="text-center text-lg-start text-muted mt-5">
        <section class="d-flex justify-content-center justify-content-lg-between ps-4 pt-4 pe-4 pb-3 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <span>@lang('footer.view.socialMedia')</span>
            </div>
            <div class="d-flex">
                <a href="https://www.twitch.tv/dochsergeanttv" target="_blank" class="me-4 link-secondary">
                    <i class="bi bi-twitch h4"></i>
                </a>
                <a href="https://twitter.com/DochSergeant" target="_blank" class="me-4 link-secondary">
                    <i class="bi bi-twitter-x h4"></i>
                </a>
                <a href="https://www.instagram.com/dochsergeanttv/" target="_blank" class="me-4 link-secondary">
                    <i class="bi bi-instagram h4"></i>
                </a>
                <a href="https://robertsspaceindustries.com/citizens/DochSergeant" target="_blank"
                    class="me-4 link-secondary">
                    <i class="bi bi-rocket-takeoff h4"></i>
                </a>
                <a href="https://www.youtube.com/@dochsergeant6873" target="_blank" class="me-4 link-secondary">
                    <i class="bi bi-youtube h4"></i>
                </a>
                <a href="https://github.com/DochSergeantTV" target="_blank" class="me-4 link-secondary">
                    <i class="bi bi-github h4"></i>
                </a>
            </div>
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            DochSergeantTV
                        </h6>
                        <p>
                            @lang('footer.view.text')
                        </p>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                        <h6 class="text-uppercase fw-bold mb-4">
                            Navigation
                        </h6>

                        @if (auth()->check())
                            <p>
                                <a href="{{ route('dashboard') }}" class="hyperlink text-reset">Dashboard</a>
                            </p>
                            <p>
                                <a href="{{ route('task') }}" class="hyperlink text-reset">@lang('footer.view.tasks')</a>
                            </p>
                            <p>
                                <a href="{{ route('logout') }}" class="hyperlink text-reset">@lang('footer.view.logout')</a>
                            </p>
                        @endif

                        @if (auth()->guest())
                            <p>
                                <a href="{{ route('calculator') }}" class="hyperlink text-reset">@lang('footer.view.calculator')</a>
                            </p>
                            <p>
                                <a href="{{ route('login') }}" class="hyperlink text-reset">@lang('footer.view.login')</a>
                            </p>
                            <p>
                                <a href="{{ route('register') }}" class="hyperlink text-reset">@lang('footer.view.register')</a>
                            </p>
                            <p>
                                <a href="{{ route('aboutme') }}" class="hyperlink text-reset">@lang('footer.view.aboutMe')</a>
                            </p>
                        @endif
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                        <h6 class="text-uppercase fw-bold mb-4">
                            @lang('footer.view.usefulLinks')
                        </h6>
                        <p>
                            <a href="https://www.erkul.games/" target="_blank" class="hyperlink text-reset">DPS
                                Calculator</a>
                        </p>
                        <p>
                            <a href="https://finder.cstone.space/" target="_blank"
                                class="hyperlink text-reset">CornerStone</a>
                        </p>
                        <p>
                            <a href="https://dydrmr.github.io/VerseTime/" target="_blank"
                                class="hyperlink text-reset">VerseTime</a>
                        </p>
                        <p>
                            <a href="https://xenosystems.space/star-citizen-resources" target="_blank"
                                class="hyperlink text-reset">Xenosystems</a>
                        </p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">@lang('footer.view.contact')</h6>
                        <p>
                            <a href="https://discord.gg/uWQX5Zy8sT" target="_blank" class="hyperlink">
                                <i class="bi bi-discord link-secondary h4 me-1"></i><span
                                    class="">MilschSchnitte</span>
                            </a>
                        </p>
                        <p>
                            <a href="mailto:help@SpaceMiner.de" target="_blank" class="hyperlink">
                                <i class="bi bi-envelope-at link-secondary h4 me-1"></i> <span
                                    class="">help@SpaceMiner.de</span>
                            </a>
                        </p>
                        <p>
                            <a href="https://twitter.com/DochSergeant" target="_blank" class="hyperlink">
                                <i class="bi bi-twitter-x h4 link-secondary"></i> <span
                                    class="">twitter@DochSergeant</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.125);">
            © {{ now()->year }} Copyright:
            <span class="text-reset fw-bold">DochSergeantTV</span><br>
            <a class="hyperlink text-reset" href="{{ route('privacypolicy') }}">@lang('footer.view.dataProtection') </a>
        </div>

    </footer>
@endsection
