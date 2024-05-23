<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>GoneButNotForgotten Mapping Co.</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
      <link rel="stylesheet" href="{{ asset('assets/css/design.css') }}"> 
    </head>
    <header>
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ URL('assets/images/loh.png') }}" alt="Logo" width="75" style="margin-left: 40px; justify-content:center">
    </a>
    <div class="NavbarSet">
      <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a></div>
      <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('home') }}#aboutUS">About Us</a></div>
      <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('home') }}#services">Services</a></div>
      <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('faq') }}">FAQ</a></div>
      <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('contacts') }}">Contact</a></div>
    </div>
    <div class="NavTOGGLE">
      <div class="burger-menu" id="burger-menu">
        <i class="bi bi-list"></i>
      </div>
      <div class="dropdown-menu" id="dropdown-menu">
        <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('home') }}#aboutUS">About Us</a></div>
        <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('home') }}#services">Services</a></div>
        <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('faq') }}">FAQ</a></div>
        <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('contacts') }}">Contact</a></div>
      </div>
    </div>
  </header>
        <div class="col-full" style="padding-top: 8rem;">
            <h1 style="font-size:3.5rem; font-weight: bold;margin: 0; padding-bottom: 2rem;z-index: 900;">Frequently Asked Questions</h1>
            <div class="wrap">
                <div class="faq">
                    <button class="what">
                        What is GBNF?
                        <i class="bi bi-chevron-down"></i>                
                    </button>
                    <div class="ask">
                        <p class="AnswerFAQ">
                        "Gone But Not Forgotten" is a cemetery mapping website designed to provide 
                        administrators with a comprehensive platform to manage and update information 
                        about gravesites. This project aims to locate cemeteries/plots, making it 
                        easier for cemetery administrators to maintain accurate records and facilitate 
                        visitor inquiries. 
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        How can individuals access the mapped cemetery data?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="ask">
                        <p class="AnswerFAQ">
                        Administrators can access the mapped cemetery data through a user-friendly 
                        dashboard designed for efficient management. The dashboard features a "Search" 
                        function, allowing administrators to quickly locate and manage plot information. 
                        When hovering over a specific plot, detailed information is displayed, including 
                        the occupant's details if the plot is occupied, the name of the owner if reserved, 
                        and for available plots, the name, date of death, and birthdate. This system 
                        ensures that administrators have comprehensive and up-to-date information at 
                        their fingertips, facilitating effective cemetery management.
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        What types of data can be included in cemetery mapping?
                        <i class="bi bi-chevron-down"></i>                
                    </button>
                    <div class="ask">
                        <p class="AnswerFAQ">
                        The cemetery mapping system includes various types of data to provide a thorough 
                        and detailed overview of the cemetery. This data encompasses GPS coordinates for 
                        exact plot locations, plot information including occupant details and reservation 
                        status, and gravesite details such as names, dates of birth and death, and epitaphs. 
                        Additionally, it includes historical data on previous occupants, maintenance 
                        records detailing cleaning schedules and other services performed, visual aids 
                        like photographs of gravesites and surrounding areas, and navigation aids such as
                         maps and directions within the cemetery to facilitate easier navigation.
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        Do you provide maintenance and support services for cemetery grounds?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="ask">
                        <p class="AnswerFAQ">
                        Yes, we provide comprehensive maintenance and support services for cemetery grounds. 
                        Our services include regular cleaning of graves, landscaping, and general upkeep 
                        of the cemetery environment to ensure it remains well-maintained and respectful for 
                        visitors. Administrators can schedule and manage these services directly through the 
                        dashboard, which helps in ensuring timely and efficient maintenance. This service 
                        ensures that the cemetery is kept in excellent condition, providing peace of mind 
                        to both administrators and visitors. 
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        How do you determine the pricing for your cemetery mapping services?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="ask">
                        <p class="AnswerFAQ">
                        Our pricing structure is designed to be affordable, especially since we are just 
                        starting in this business. We aim to offer competitive rates to attract and retain 
                        customers while providing high-quality services. The exact pricing is determined based 
                        on the specific needs and size of the cemetery, ensuring that we provide value and 
                        comprehensive services at a reasonable cost. Our goal is to offer an economical solution 
                        for cemeteries looking to digitize and manage their plots effectively.
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <button class="what">
                        How can we contact you?
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="ask">
                        <p class="AnswerFAQ">
                        For any inquiries or additional information, you can contact us through the "Contact Us" 
                        page on our homepage. This page includes a contact form for direct inquiries and requests, 
                        an email address for detailed questions or specific issues, a phone number for immediate 
                        assistance and support, and our office address for those who prefer to reach out in 
                        person or send mail. We are committed to providing excellent customer service and support, 
                        ensuring that all your needs and questions are addressed promptly.
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
      document.addEventListener('DOMContentLoaded', function() {
      var burgerMenu = document.getElementById('burger-menu');
      var dropdownMenu = document.getElementById('dropdown-menu');
      burgerMenu.addEventListener('click', function() {
      dropdownMenu.classList.toggle('show');
      });
    });
  </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            var pageSelector = document.getElementById('pageSelector');
            pageSelector.addEventListener('change', function() {
            var selectedValue = pageSelector.value;
            window.location.href = selectedValue;
              });
        });
        </script>
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
    </body>
</html>