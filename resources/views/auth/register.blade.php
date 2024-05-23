<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>GoneButNotForgotten Mapping Co.</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>         
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    j<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">  
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}"> 
</head>
<body>  
    <a class="navbar-brand" href="#">
        <img src="{{ URL('assets/images/loh.png') }}" alt="Logo" width="85" class="pic1">
    </a>   
    <div class="card-body-register">
        <div class="row justify-content-center">
            <form id="registrationForm" action="{{ route('storeRegister') }}" class="form-control" method="POST">
            @csrf
                <div class="Container-date">
                    <div class="row">
                        <div class="rowdate1">
                            <div class="choices">
                                <p class="choiceSIGNUP" style="font-weight: 800;">SIGN UP</p>
                                &nbsp; &nbsp;
                                <a href="{{ route('signin') }}" class="choiceSIGNIN">SIGN IN</a>
                            </div>
                        </div>
                        <div class="rowdate2">
                            <a class="Logo" href="#">
                                <img src="{{ URL('assets/images/loh.png') }}" alt="Logo" width="85" class="pic">
                            </a> 
                        </div>
                    </div>
                </div>
                    <h2 class="titletxt">Create a new account</h2>
                <div class="inputs">
                    <div class="input-body">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Juan Dela Cruz" class="input-field" required autofocus >
                    </div>
                    <div class="input-body">
                        <i class="fas fa-users"></i>
                        <select class="select-field" name="role" required> 
                            <option value=""disabled selected hidden>Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Other">Other</option>
                        </select>  
                    </div>
                    <div class="input-body">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="contactNumber" placeholder="09123654371" class="input-field" required>
                    </div>
                    <div class="input-body">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="contactEmail" required autofocus autocomplete="username" placeholder="juandelacruz@gmail.com" class="Email" class="input-field"">
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
                    <div class="input-body">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="input-field" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-danger">
                        SIGN UP
                    </button>
                        <h5 class="hreflink">Already a member? <a href="{{ route('signin') }}" >SIGN IN?</a></h5>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
        event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);
            var password = form.elements["password"].value;
            var confirmPassword = form.elements["password_confirmation"].value;
            var contactNum = form.elements["contactNumber"].value;
            var email = form.elements["contactEmail"].value;
            if (contactNum.length !== 11 || !/^\d{11}$/.test(contactNum)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Contact Number',
                    text: 'The contact number must be exactly 11 digits.',
                });
                return; 
            }
            else if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'The passwords do not match. Please try again.'
                });
            } else if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Length',
                    text: 'The password must be at least 8 characters long.'
                });
            } else {
                fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 422 && response.json().errors.contactEmail) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Email Already Taken',
                            text: 'The email address is already in use. Please try logging in or use a different email address.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: 'An error occurred while processing your registration.'
                        });
                    }
                    throw new Error('Non-ok response from server');
                }
                else{
                    form.reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: 'Welcome to G.B.N.F. Mapping Co.!',
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
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: 'An error occurred while processing your registration.'
                });
            });
            }
        });
    </script>
</body>
</html>
