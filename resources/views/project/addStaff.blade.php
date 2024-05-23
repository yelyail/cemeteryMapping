<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>         
        <title>
            GoneButNotForgotten Mapping Co.
        </title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/dashInput.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}"> 
    </head>
    <body>
        <input type="checkbox" id="nav-toggle">
        <div class="sidebar">
            <div class="sidebar-brand text-center">
                <h2><img src="{{ URL('assets/images/loh.png') }}" width="70" length="50"></h2>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="active"><i class="bi bi-house"></i><span>Home</span></a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="active"><i class="bi bi-geo-alt"></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{ route('cemInfo') }}" class="active"><i class="bi bi-card-text"></i><span>Cemetery Information</span></a>
                    </li>
                    <li>
                        <a href="{{ route('histoRec') }}" class="active"><i class="bi bi-file-earmark-text"></i><span>Historical Records</span></a>
                    </li>
                    <li>
                        <a href="{{ route('maintainRec') }}" class="active"><i class="bi bi-file-earmark-medical"></i><span style="font-weight: 700;">Maintenance Status</span></a>
                    </li>
                    <li>
                        <a href="{{ route('transaction') }}" class="active"><i class="bi bi-receipt"></i><span>Transaction</span></a>
                    </li>
                    <li><a href="{{ route('logout') }}" class="active"><i class="bi bi-box-arrow-right"></i><span>Log out</span></a></li>
                </ul>
            </div>
        </div>
        <div class="main-content mt-1" >
            <header>
                <h2>
                    <label for="nav-toggle"><i class="bi-layout-sidebar-inset"></i></label>
                </h2>
                <div class="user-wrapper">
                    <div>
                        <h5 class="Titletxt">Employee</h5>
                    </div>
                </div>
            </header><br><br><br>
            <div class="card-body">           
                <form action="{{ route('storeStaff') }}" class="form" method="POST">
                    @csrf 
                        <div class="paramaisa">
                            <p class="LabelName">Fullname</p>  
                                <input type="text"class="input-field" name="fullName" required> 
                                <p class="LabelName">Job Position</p>  
                                <input type="text" class="input-field" name="role" required> 
                                <p class="LabelName">Contact Number</p>   
                                <input type="text" name="contactNum" class="input-field" required>
                                <p class="LabelName">Email</p>  
                                <input type="text"  class="input-field" name="email" required>
                                <div class="button-container">
                                    <button type="submit" class="btn btn-danger" 
                                        style="border-radius: 10rem; width: 50%; border: none; letter-spacing: 0.2rem;">REGISTER
                                    </button>
                                </div>
                            <h5 class="Back"><a href="{{ route('staff') }}">BACK</a></h5>
                        </div>
                </form>
            </div>
        </div><br><br><br>                
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
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.youtube.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-youtube"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://twitter.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.google.com" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
        <?php use Illuminate\Support\Facades\Session;?>
        @if(session('alertShow'))
            <script>
                swal.fire({
                    icon: "{{ session('icon') }}",
                    title: "{{ session('title') }}",
                    text: "{{ session('text') }}",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        <?php Session::forget('alertShow');?>
                        <?php Session::forget('icon');?>
                        <?php Session::forget('title');?>
                        <?php Session::forget('text');?>
                        window.location.href = "{{ route('staff') }}";
                    }
                });
            </script>
        @endif
    </body>
</html>
