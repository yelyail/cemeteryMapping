<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title> GoneButNotForgotten Mapping Co.</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}"> 
</head>
<body>
    <a class="navbar-brand" href="#">
        <img src="{{ URL('assets/images/loh.png') }}" alt="Logo" width="85" class="pic1">
    </a>        
    <div class="card-body-forgot">
        <div class="row justify-content-center">
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
                            <x-text-input id="email" class="input-field" type="email" name="email" required autofocus autocomplete="username" placeholder="juandelacruz@gmail.com" />
                        </div>
                        <div class="input-body ">
                            <i class="fas fa-key"></i>
                            <select class="select-field" name="passRecQues" required>
                                <option value="" disabled selected hidden>Password Recovery</option> 
                                <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                                <option value="Memorable place you have ever visited.">Memorable place you have ever visited.</option>
                                <option value="Name of first person you love?">Name of first person you love?</option>
                            </select>  
                        </div>
                        <div class="input-body">
                            <i class="fas fa-key"></i>
                            <input type="text" name="passRecAns" placeholder="Answer" class="input-field" required autofocus >
                        </div>
                        <div class="input-body">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Password" class="input-field" required>
                        </div>
                        <button type="submit" class="btn btn-danger" name="submit"
                            style="letter-spacing: 0.6rem; border-radius: 10rem; width: 50%; margin-top: 2rem; border: none;">
                            CONFIRM
                        </button>
                    <h5 class="hreflink">Back to <a href="{{ route('signin') }}">SIGN IN?</a></h5>
                </form>
        </div>        
    </div>        
</body>
@if(session('alertShow'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
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
                    window.location.href = "{{ route('signin') }}";
                }
            });
        });
    </script>
@endif
</html>
