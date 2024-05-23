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
    <body>
      <section>
        <div class="row">
            <div class="col-1 col-sm-12 mb-4">
              <img src="{{ URL('assets/images/background.jpg') }}" alt="no photo" class="img-fluid background" class="BGPHOTOHOME"style="height: 100vh;" >
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
          <h1 class="SubTitleTextMain">ABOUT US</h1>
        </div>
        <div class="col-full">
          <p class="lead" style="text-align: center;">
          Welcome to "Gone But Not Forgotten," a pioneering cemetery mapping website dedicated to providing comprehensive and 
          user-friendly solutions for cemetery management. Our mission is to assist cemetery administrators in efficiently 
          managing and updating gravesite information, ensuring that every resting place is accurately recorded and easily 
          accessible.
          </p>
        </div>
      </section>
      <section data-aos="fade-up" data-aos-duration="2000" id="team" class="ourteam">
      <div class="row g-3">
          <div class="col-full">
            <h1 class="SubTitleText">Our Goal</h1>
        </div>
        <div class="col-full">
          <p class="lead" style="text-align: center;">
          At "Gone But Not Forgotten," our goals are to honor and preserve the memories of loved ones by digitizing and 
          mapping cemeteries, ensuring that each gravesite is accurately documented and easily accessible. We strive to 
          create a reliable and detailed platform that facilitates efficient management of gravesites and helps visitors 
          locate and pay tribute to their loved ones.
          </p>
        </div>
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
                  <h4 class="card-title">Ariel July Traje</h4>
                  <h5 class="card-title">Back End Developer</h5>
                  <p class="card-text">Ariel develops the secure and scalable server-side logic for the platform, specializing in PHP and Laravel, ensuring reliable database management and API integration for efficient cemetery mapping and management.</p>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="{{ URL('assets/images/name1.png') }}"class="card-img-top" alt="...">
                <div class="card-body">
                  <h4 class="card-title">Ralph Joseph Quiñones</h4>
                  <h5 class="card-title">Front End Developer</h5>
                  <p class="card-text">Ralph is responsible for designing and implementing the user interface of "Gone But Not Forgotten," ensuring it is user-friendly and visually appealing using HTML, CSS, JavaScript, and modern frameworks.</p>
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
                    <h4 class="card-title">Digital Mapping</h4>
                    <p class="card-text">Accurate GPS coordinates and detailed mapping of each gravesite for easy navigation.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/histo.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h4 class="card-title">Historical Preservation</h4>
                      <p class="card-text">Preservation and digitization of historical cemetery records to ensure they are never lost.</p>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/graves.jpg') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h4 class="card-title">Plot Identification</h4>
                    <p class="card-text">Detailed information on each plot, including occupant details, reservation status, and availability.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/interactive.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h4 class="card-title">Interactive Mapping Platforms</h4>
                      <p class="card-text">User-friendly platforms allowing administrators and visitors to interact with cemetery maps.</p>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/clean.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h4 class="card-title">Maintenance Services</h4>
                      <p class="card-text">Regular cleaning and upkeep of graves to ensure a respectful resting place.</p>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="{{ URL('assets/images/drm.jpg') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h4 class="card-title">Digital Record Management</h4>
                    <p class="card-text">Efficient management and storage of digital records for easy access and updating.</p>
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
        <script>
    document.addEventListener('DOMContentLoaded', function() {
      var burgerMenu = document.getElementById('burger-menu');
      var dropdownMenu = document.getElementById('dropdown-menu');
      
      burgerMenu.addEventListener('click', function() {
        dropdownMenu.classList.toggle('show');
      });
    });
  </script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script src="js/bootstrap.js"></script>
</body>
</html>