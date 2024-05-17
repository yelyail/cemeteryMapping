<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <!--ONLINE RESOURCES HERE-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" /> <!--FOR ICONS FROM AWESOME FONT-->
    <title> GoneButNotForgotten Mapping Co.</title>
    <!--For the sweet alert cdn-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Java Script here-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
    <!--CSS HERE-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}"> 
</head>
<body>
    <a class="navbar-brand" href="#">
        <img src="{{ URL('assets/images/loh.png') }}" alt="Logo" width="85" class="pic1">
    </a>        
    <div class="card-body-forgot">
        <div class="row justify-content-center">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                </div>
                <form action="{{ route('forgPass.reset') }}" method="POST" class="form-control">
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
                         <h1 class="titletxt">Recovery phase</h1><br>
                             <p class="inputs" style="text-align:center">Your answer should be similar to what you input upon registration.</p>
                    <div class="inputs">
                        <div class="input-body">
                                <i class="fas fa-envelope"></i>
                                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="juandelacruz@gmail.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="input-body ">
                            <i class="fas fa-key"></i>
                            <select class="select-field" name="PasswordRecovery" required>
                                <option value="" disabled selected hidden>Password Recovery</option> 
                                <option value="PasswordPet">What is the name of your first pet?</option>
                                <option value="PasswordPlace">Memorable place you have ever visited.</option>
                                <option value="PasswordLove">Name of first person you love?</option>
                            </select>  
                        </div>
                        <div class="input-body">
                            <i class="fas fa-key"></i>
                            <input type="text" name="PasswordRecoveryAns" placeholder="Answer" class="input-field" required autofocus >
                        </div>
                        <div class="input-body">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Password" class="input-field" required>
                        </div>
                        <button type="submit" class="btn btn-danger" name="submit"
                            style="letter-spacing: 0.6rem; border-radius: 10rem; width: 50%; margin-top: 2rem; border: none;">
                            SENT
                        </button>
                    <h5 class="hreflink">Back to <a href="{{ route('signin') }}">SIGN IN?</a></h5>
                </form>
        </div>        
    </div>        
</body>
</html>
