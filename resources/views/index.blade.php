<!DOCTYPE html>
<html lang="en">

<head>
    <title>Symptoms Care</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="landing-page/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="landing-page/css/animate.css">

    <link rel="stylesheet" href="landing-page/css/owl.carousel.min.css">
    <link rel="stylesheet" href="landing-page/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="landing-page/css/magnific-popup.css">

    <link rel="stylesheet" href="landing-page/css/aos.css">

    <link rel="stylesheet" href="landing-page/css/ionicons.min.css">

    <link rel="stylesheet" href="landing-page/css/flaticon.css">
    <link rel="stylesheet" href="landing-page/css/icomoon.css">
    <link rel="stylesheet" href="landing-page/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/">Symptoms <span>Care</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item cta">
                        @if(Auth::id())
                        <a href="dashboard" class="nav-link"><span><i class="fa fa-user"></i> Dashboard</span></a>
                        
                        @else
                        <a href="{{ route('login') }}" class="nav-link"><span><i class="fa fa-user"></i> Login</span></a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url('landing-page/images/bg_2.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center" data-scrollax-parent="true">
                    <div class="col-md-6 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                        <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                            Medical Record Department
                        </h1>
                        <p class="mb-4">MRD is a computer system that helps healthcare providers manage patient medical records and automate clinical workflows. MRD systems allow providers to: Create customizable templates for taking notes during patient encounters.</p>
                        <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        @if(Route::has('login'))
                        @auth
                        <a href="dashboard"
                                    class="btn btn-primary px-4 py-3"><i class="fa fa-user"></i> Dashboard</a>
                           
                        @else
                        <a href="{{ route('login') }}"
                                class="btn btn-primary px-4 py-3"><i class="fa fa-user"></i> Login</a>
                        @endauth
                        @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image: url('landing-page/images/bg-1.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center" data-scrollax-parent="true">
                    <div class="col-md-6 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                        <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                            Medical Record Department
                        </h1>
                        <p class="mb-4">MRD is a computer system that helps healthcare providers manage patient medical records and automate clinical workflows. MRD systems allow providers to: Create customizable templates for taking notes during patient encounters.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Symptoms Care</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts.</p>
                    </div>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft ">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
                <div class="col-md-3 offset-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Office</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span>
                                    <span class="text">
                                        Sahajanand ChowkTongritoli, Ranchi, Jharkhand 834002
                                    </span>
                                </li>
                                <li><a href="#"><span class="icon icon-phone"></span>
                                    <span class="text">+91 8789572137</span></a></li>
                                <li>
                                    <a href="mailto:frameworkfuturistic@gmail.com">
                                    <span class="icon icon-envelope"></span>
                                    <span class="text"> frameworkfuturistic@gmail.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());

                        </script> All rights reserved | made with <i class="icon-heart"
                            aria-hidden="true"></i> by <a href="http://framework-futuristic.com/" target="_blank">Symptoms Care</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" /></svg></div>
    <script src="landing-page/js/jquery.min.js"></script>
    <script src="landing-page/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="landing-page/js/popper.min.js"></script>
    <script src="landing-page/js/bootstrap.min.js"></script>
    <script src="landing-page/js/jquery.easing.1.3.js"></script>
    <script src="landing-page/js/jquery.waypoints.min.js"></script>
    <script src="landing-page/js/jquery.stellar.min.js"></script>
    <script src="landing-page/js/owl.carousel.min.js"></script>
    <script src="landing-page/js/aos.js"></script>
    <script src="landing-page/js/scrollax.min.js"></script>
    <script src="landing-page/js/main.js"></script>

</body>

</html>
