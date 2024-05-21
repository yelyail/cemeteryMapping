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
    <body>
      <section>
        <div class="row">
            <div class="col-1 col-sm-12 mb-4">
              <img src="{{ URL('assets/images/background.jpg') }}" alt="no photo" class="img-fluid background" style="width: 100%;" >
                <div class="contain" style="padding: 10px;">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <h1 data-aos="fade-up" class="maintxt">Welcome to <span>Gone But Not Forgotten</span></h1>
                        <p data-aos="fade-up"class="subtxt" >
                          We provide a variety of services to satisfy the needs of our stakeholders, 
                          including data collection and validation, digitalization of cemetery records, 
                          interactive mapping platforms, and consultation and support.<br></p>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('contacts') }}"><button type="button" class="demo btn">CONTACT US</button></a>
                      </div>
                </div>     
            </div>
        </div>
      </section>
      <section data-aos="fade-up" data-aos-duration="2000" id="aboutUS" class="MainTitle">
        <div class="col-full">
          <h1 class="SubTitleText">ABOUT US</h1>
        </div>
        <div class="col-full">
          <p class="lead" style="text-align: center;">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sit amet commodo nulla facilisi nullam. 
            Ornare arcu odio ut sem nulla pharetra diam sit amet. Sed ullamcorper morbi tincidunt ornare massa eget egestas purus viverra.
          </p>
        </div>
      </section>
      <section data-aos="fade-up" data-aos-duration="2000" id="team" class="ourteam">
        <div class="row g-3">
          <div class="col-full">
            <h1 class="SubTitleText">Our Team</h1>
          </div>
          <div class="container d-flex justify-content-center">
            <div class="row g-3">
              <div class="card" style="width: 18rem;">
                <img src="{{ URL('assets/images/name.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Ariel July Traje</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="{{ URL('assets/images/name1.png') }}"class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Ralph Joseph Quiñones</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section data-aos="fade-up" data-aos-duration="2000" id="services" class="SubTitle">
        <div class="row g-3">
          <div class="col-full">
            <h1 class="SubTitleText">Services</h1>
          </div>
          <div class="container d-flex justify-content-center">
            <div class="row g-3">
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/map.png') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Digital Mapping</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/histo.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Historical Preservation</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/interactive.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Interactive Mapping Platforms</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/clean.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Interactive Mapping Platforms</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/graves.jpg') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Plot Identification</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/drm.jpg') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Digital Record Management</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script>
        AOS.init();
      </script>
      <script src="js/bootstrap.js"></script>
    </body>
</html>