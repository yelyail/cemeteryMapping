<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoneButNotForgotten Mapping Co.</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/css/loginLog.css') }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php use Illuminate\Support\Facades\Session;?>
    @if(session('alertShow'))
        <script>
            swal.fire({
                icon:"{{ session('icon') }}",
                title:"{{ session('title') }}",
                text:"{{ session('text') }}",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                allowOutsideClick:false,
                allowEscapeKey:false,
                allowEnterKey:false,
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location.href = "{{ route('signin') }}";
                }
            });
        </script>
    @endif
</head>
<body>
    <a class="navbar-brand" href="#">
        <img src="{{ URL('assets/images/loh.png') }}" alt="Logo" width="85" class="pic1">
    </a>   
    <div class="card-body-login">
        <div class="row justify-content-center">
                <x-guest-layout>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-3" :status="session('status')" />
                    <!-- Form Start -->
                    <form action="{{ route('storeLogIn') }}" method="POST"  class="form-control">
                        @csrf
                        <div class="Container-date">
                                    <div class="row">
                                        <div class="rowdate1">
                                            <div class="choices">
                                                <a href="{{ route('register') }}" class="choiceSIGNIN">SIGN UP</a>
                                                &nbsp; &nbsp;
                                                <p class="choiceSIGNUP" style="font-weight: 800;">SIGN IN</p> 
                                            </div>
                                        </div>
                                        <div class="rowdate2">
                                            <a class="Logo" href="#">
                                                <img src="{{ URL('assets/images/loh.png') }}" alt="Logo" width="85" class="pic">
                                            </a> 
                                        </div>
                                    </div>
                         </div>
                        <h1 class="titletxt">Gone But Not Forgotten</h1><br>
                        <div class="inputs">
                            <div class="input-body">
                                <i class="fas fa-envelope"></i>
                                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="juandelacruz@gmail.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="input-body">
                                <i class="fas fa-lock"></i>
                                <x-text-input id="password" class="input-field" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
                            </div>
                            <button type="submit" class="btn btn-danger">SIGN IN</button>
                        </div>
                        <h5 class="hreflink"><a href="{{ route('forgPass') }}">Forgot your Password?</a></h5>
                        <br>
                    </form>
                </x-guest-layout>
        </div>        
    </div>
</body>
</html>
