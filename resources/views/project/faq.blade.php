<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
         <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
         <title>
            GoneButNotForgotten Mapping Co.
        </title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/design.css') }}"> 
    </head>
    <body>
    <header>
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ URL('assets/images/loh.png') }}" alt="Logo" width="75" style="margin-left: 40px; justify-content:center">
      </a>
      <div class="NavbarSet">
        <div class="Nav-item">
            <a class="Nav-text" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="Nav-item">
            <a class="Nav-text" aria-current="page" href="{{ route('home') }}#aboutUS">About Us</a>
        </div>
        <div class="Nav-item">
            <a class="Nav-text" aria-current="page" href="{{ route('home') }}#services">Services</a>
        </div>
        <div class="Nav-item">
            <a class="Nav-text" aria-current="page" href="{{ route('faq') }}">FAQ</a>
        </div>
        <div class="Nav-item">
            <a class="Nav-text" aria-current="page" href="{{ route('contacts') }}">Contact</a>
        </div>
    </div>
    </header>
        <div class="col-full" style="padding-top: 8rem;">
            <h1 style="font-size:3.5rem; font-weight: bold;margin: 0; padding-bottom: 2rem;z-index: 900;">Frequently Asked Questions</h1>
            <div class="wrap">
                <div class="faq">
                    <button class="what">
                        1. What is G.B.N.F. Mapping Co.
                        <i class="bi bi-chevron-down"></i>                
                    </button>
                    <div class="ask">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore 
                            magna aliqua. Sit amet commodo nulla facilisi nullam. 
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        2. How can individuals access the mapped cemetery data?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="ask">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore 
                            magna aliqua. Sit amet commodo nulla facilisi nullam. 
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        3. What types of data can be included in cemetery mapping?
                        <i class="bi bi-chevron-down"></i>                
                    </button>
                    <div class="ask">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore 
                            magna aliqua. Sit amet commodo nulla facilisi nullam. 
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        4. Do you provide maintenance and support services for cemetery grounds?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="ask">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore 
                            magna aliqua. Sit amet commodo nulla facilisi nullam. 
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        5. How do you determine the pricing for your cemetery mapping services?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="ask">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore 
                            magna aliqua. Sit amet commodo nulla facilisi nullam. 
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        6. How can we contact you?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="ask">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore 
                            magna aliqua. Sit amet commodo nulla facilisi nullam. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="dashboard-footer bg-dark text-white pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <hr class="mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-7 col-lg-8">
                                <p>&copy; 2024 G.B.N.F. Mapping Co. All rights reserved.</p>
                            </div>
                            <div class="col-md-5 col-lg-4">
                                <div class="text-center text-md-right">
                                    <ul class="list-unstyled list-inline">
                                        <li class="list-inline-item"><a href="https://www.facebook.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-facebook"></i></a></li>
                                        <li class="list-inline-item"><a href="https://www.youtube.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-youtube"></i></a></li>
                                        <li class="list-inline-item"><a href="https://twitter.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-twitter"></i></a></li>
                                        <li class="list-inline-item"><a href="https://www.google.com" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script>
            var acc = document.getElementsByClassName("what");
            var i;
            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var ask = this.parentElement.querySelector(".ask");
                    if (ask.style.display === "block") {
                        ask.style.display = "none";
                    } else {
                        ask.style.display = "block";
                    }
                });
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
            <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>