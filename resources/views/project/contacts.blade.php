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
        <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="Nav-item"> <a class="Nav-text" aria-current="page" href="{{ route('home') }}#aboutUS">About Us</a></div>
        <div class="Nav-item"><a class="Nav-text" aria-current="page" href="{{ route('home') }}#services">Services</a> </div>
        <div class="Nav-item"> <a class="Nav-text" aria-current="page" href="{{ route('faq') }}">FAQ</a> </div>
        <div class="Nav-item"> <a class="Nav-text" aria-current="page" href="{{ route('contacts') }}">Contact</a></div>
    </div>
        <h2 class="NavTOGGLE">
            <label for="nav-toggle">
                <select id="pageSelector" style="margin:auto">
                    <option value="{{ route('dashboard') }}">Dashboard</opt>
                    <option value="{{ route('home') }}#aboutUS">About Us</option>
                    <option value="{{ route('home') }}#services">Services</option>
                    <option value="{{ route('faq') }}">FAQ</option>
                    <option value="{{ route('contacts') }}">Contact</option>
                </select>
            </label>
        </h2>
    </header>
        <div class="row justify-content-center mt-2" >
            <div class="col-lg-8">
                <div class="contact-form" >
                    <h2 class="text-center mb-4">Let's Get in Touch</h2>
                    <form>
                        <div class="form-group">
                            <label for="name" class="labeltxt">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Juan Dela Cruz">
                        </div>
                        <div class="form-group">
                            <label for="email"  class="labeltxt">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="juandelacruz@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="message"  class="labeltxt">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Write a message"></textarea>
                        </div><br>
                        <button type="submit" class="btn btn-primary" style="margin-bottom: 30px;">Submit</button>
                    </form>
                    <div class="contact-info">
                        <div class="row mt-2">
                            <div class="col-md-6 d-flex">
                                <i class="bi bi-geo-alt"></i>
                                <p class="mt-3 ml-2"><b>&nbsp;&nbsp;&nbsp;Address:</b> 8000 Matina, Davao City, Philippines</p>
                            </div>
                            <div class="col-md-6 d-flex">
                                <i class="bi bi-telephone-forward"></i>
                                <p class="mt-3 ml-2"><b>&nbsp;&nbsp;&nbsp;Phone number:</b> +63 9223 546 999</p>
                            </div>
                        </div>
                            <div class="row mt-2">
                                <div class="col-md-6 d-flex">
                                    <i class="bi bi-envelope"></i>
                                    <p class="mt-3 ml-2"><b>&nbsp;&nbsp;&nbsp;Email:</b> gbnfMappingCo@gmail.com</p>
                                </div>
                                    <div class="col-md-6 d-flex">
                                    <i class="bi bi-clock"></i>
                                    <p class="mt-3 ml-2"><b>&nbsp;&nbsp;&nbsp;Opening Hours:</b> Monday-Friday: 8:00 am - 5:00 pm</p>
                                </div>
                             </div>
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
                                        <li class="list-inline-item"> <a href="https://twitter.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-twitter"></i></a></li>
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
            var pageSelector = document.getElementById('pageSelector');
            pageSelector.addEventListener('change', function() {
            var selectedValue = pageSelector.value;
            window.location.href = selectedValue;
              });
        });
        </script>
</body>
</html>