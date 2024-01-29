<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.7.0/remixicon.css') }}">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <title>Price Tracker</title>
</head>
<body>
<!--==================== HEADER ====================-->
<header class="header" id="header">
    <nav class="nav container">
        <a href="#" class="nav__logo">Price Tracker</a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="#home" class="nav__link active-link">Home</a>
                </li>

                <li class="nav__item">
                    <a href="#about" class="nav__link">About Us</a>
                </li>

                @auth
                    <li class="nav__item">
                        <a href="#favorite" class="nav__link">Favorites</a>
                    </li>

                    <li class="nav__item">
                        <a href="{{ route('logout') }}" class="nav__link">Exit</a>
                    </li>
                @endauth

                @guest
                    <li class="nav__item">
                        <a href="#visit" class="nav__link">Login</a>
                    </li>

                    <li class="nav__item">
                        <a href="#new" class="nav__link">Register</a>
                    </li>
                @endguest
            </ul>

            <!--Close button-->
            <div class="nav__close" id="nav-close">
                <i class="ri-close-line"></i>
            </div>
        </div>

        <!-- Toggle button -->
        <div class="nav__toggle" id="nav-toggle">
            <i class="ri-menu-line"></i>
        </div>
    </nav>
</header>

<!--==================== MAIN ====================-->
<main class="main">
    <!--==================== HOME ====================-->
    <section class="home section" id="home">
        <img src="{{ asset('assets/img/home-bg.jpg') }}" alt="image" class="home__bg">
        <div class="home__shadow"></div>

        <div class="home__container container grid">
            <div class="home__data">
                <h1 class="home-title">
                    Save more <br> with us
                </h1>
            </div>

            <div class="home__image">
                <img src="{{ asset('assets/img/home-bread.png') }}" alt="image" class="home__img">
            </div>

            <footer class="home__footer">
                <div class="home__location">
                    <i class="ri-map-pin-line"></i>
                    <span>Sukhomlynsky street <br> Ivano-Frankivsk Ukraine</span>
                </div>

                <div class="home__social">
                    <a href="https://www.facebook.com/" target="_blank">
                        <i class="ri-facebook-circle-line"></i>
                    </a>

                    <a href="https://www.instagram.com/" target="_blank">
                        <i class="ri-instagram-line"></i>
                    </a>

                    <a href="https://www.youtube.com/" target="_blank">
                        <i class="ri-youtube-line"></i>
                    </a>
                </div>
            </footer>
        </div>
    </section>


    @auth
    <!--==================== FAVORITES ====================-->
    <section class="favorite section" id="favorite">
        <h2 class="section__title">Customer Favorites</h2>

        <div class="favorite__container container grid">

        </div>
    </section>
    @endauth

    <!--==================== ABOUT ====================-->
    <section class="about section" id="about">
        <div class="about__container container grid">
            <div class="about__data">
                <h2 class="section__title">About Us</h2>

                <p class="about__description">
                    We have created a convenient service that allows you to monitor the change in the price of an ad on OLX.
                </p>
            </div>

            <img src="{{ asset('assets/img/about-bread.png') }}" alt="image" class="about__img">
        </div>
    </section>

    @guest
    <!--==================== VISIT ====================-->
    <section class="visit section" id="visit">
        <div class="visit__container">
            <div class="visit__shadow"></div>

            <div class="visit__content container grid">
                <div class="visit__data">
                    <h2 class="section__title">Sign In</h2>

                    @if($errors->any())
                        <div class="error">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <br>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <label>Email<br><br>
                            <input
                                class="visit__description"
                                type="text"
                                name="email"
                                placeholder="admin@example.com"
                                value="admin@example.com"
                                required>
                        </label>
                        <br>
                        <label>Password<br><br>
                            <input
                                class="visit__description"
                                type="password"
                                name="password"
                                placeholder="test28"
                                value="test28"
                                required>
                        </label>
                        <br>

                        <button class="button">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="visit section">
        <div class="visit__container">
            <div class="visit__shadow"></div>

            <div class="visit__content container grid">
                <div class="visit__data">
                    <h2 class="section__title">OR</h2>
                </div>
            </div>
        </div>
    </section>

<!--==================== NEWS ====================-->
    <section class="new section" id="new">
        <div class="visit__container">
            <div class="visit__shadow"></div>

            <div class="visit__content container grid">
                <div class="visit__data">
                    <h2 class="section__title">Sign Up</h2>

                    @if($errors->any())
                        <div class="error">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <br>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <label>Name<br><br>
                            <input
                                class="visit__description"
                                type="text"
                                name="name"
                                placeholder="Petro Stashkiv"
                                value="{{ @old('name') }}"
                                required>
                        </label>
                        <br>
                        <label>Email<br><br>
                            <input
                                class="visit__description"
                                type="text"
                                name="email"
                                placeholder="s.petro@example.com"
                                value="{{ @old('email') }}"
                                required>
                        </label>
                        <br>
                        <label>Password<br><br>
                            <input
                                class="visit__description"
                                type="password"
                                name="password"
                                placeholder="Qwerty123$"
                                value="{{ @old('password') }}"
                                required>
                        </label>
                        <br>

                        <button class="button">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endguest
</main>

<!--==================== FOOTER ====================-->
<footer class="footer">
    <span class="footer__copy">
            &#169; All Rights Reserved By Ivan Sabat
         </span>
</footer>

<!--========== SCROLL UP ==========-->
<a href="#" class="scrollup" id="scroll-up">
    <i class="ri-arrow-up-line"></i>
</a>

<!--=============== SCROLLREVEAL ===============-->
<script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>

<!--=============== MAIN JS ===============-->
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
