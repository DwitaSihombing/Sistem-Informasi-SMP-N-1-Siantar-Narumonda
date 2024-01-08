<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes":{"layout": "boxed"}}'>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>SMP Negeri 1 Siantar Narumonda</title>
    <meta name="description" content="Sistem Informasi Sekolah">

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <meta name="application-name" content="SMP Negeri 1 Siantar Narumonda">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('font/CS-Interface/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="{{ asset('js/base/loader.js') }}"></script>
</head>

<body>
    <div id="root">
        <div id="nav" class="nav-container d-flex">
            <div class="nav-content d-flex">
                <div class="position-relative">
                    <a href="{{ asset('') }}">
                        <div class="d-flex">
                            <img src="{{ asset('img/logo.png') }}" style="height: 45px" alt="">
                            <h5 class="pt-1 ps-2 text-white">SMP Negeri 1<br> Siantar Narumonda</h5>
                        </div>
                    </a>
                </div>


                <ul class="list-unstyled list-inline text-center menu-icons">

                    <li class="list-inline-item">
                        <a href="{{ asset('login') }}">
                            Masuk
                        </a>

                    </li>
                </ul>

                <div class="menu-container flex-grow-1">
                    <ul id="menu" class="menu">

                        <li>
                            <a href="{{ route('index') }}">
                                <span class="label">Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tentang') }}">
                                <span class="label">Tentang</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('prestasi') }}">
                                <span class="label">Prestasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fasilitas') }}">
                                <span class="label">Fasilitas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ekstrakulikuler') }}">
                                <span class="label">Ekstrakulikuler</span>
                            </a>
                        </li>

                    </ul>
                </div>

                <div class="mobile-buttons-container">
                    <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
                        <i data-acorn-icon="menu-dropdown"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
                    <a href="#" id="mobileMenuButton" class="menu-button">
                        <i data-acorn-icon="menu"></i>
                    </a>
                </div>

            </div>
            <div class="nav-shadow"></div>
        </div>
        <main>
            @yield('content')
        </main>
        <footer>
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <p class="mb-0 text-muted text-medium">SMP Negeri 1 Siantar Narumonda &copy;2022</p>
                        </div>
                        <div class="col-sm-6 d-none d-sm-block">
                            <ul class="breadcrumb pt-0 pe-0 mb-0 float-end">

                                <li class="breadcrumb-item mb-0 text-medium">
                                    <a href="#"
                                        class="btn-link">Ketentuan Layanan</a>
                                </li>

                                <li class="breadcrumb-item mb-0 text-medium">
                                    <a href="#"
                                        class="btn-link">Kebijakan Privasi</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ps-5 pe-5 pb-0 border-0">
                    <input id="searchPagesInput"
                        class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" type="text"
                        autocomplete="off">
                </div>
                <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
                    <span class="text-alternate d-inline-block m-0 me-3">
                        <i data-acorn-icon="arrow-bottom" data-acorn-size="15"
                            class="text-alternate align-middle me-1"></i>
                        <span class="align-middle text-medium">Navigate</span>
                    </span>
                    <span class="text-alternate d-inline-block m-0 me-3">
                        <i data-acorn-icon="arrow-bottom-left" data-acorn-size="15"
                            class="text-alternate align-middle me-1"></i>
                        <span class="align-middle text-medium">Select</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/OverlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('js/vendor/autoComplete.min.js') }}"></script>
    <script src="{{ asset('js/vendor/clamp.min.js') }}"></script>
    <script src="{{ asset('icon/acorn-icons.js') }}"></script>
    <script src="{{ asset('icon/acorn-icons-interface.js') }}"></script>
    <script src="{{ asset('js/base/helpers.js') }}"></script>
    <script src="{{ asset('js/base/globals.js') }}"></script>
    <script src="{{ asset('js/base/nav.js') }}"></script>
    <script src="{{ asset('js/base/search.js') }}"></script>
    <script src="{{ asset('js/base/settings.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>


</html>
