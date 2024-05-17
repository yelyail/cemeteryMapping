<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <!-- ONLINE RESOURCES HERE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" /> <!-- FOR ICONS FROM AWESOME FONT -->
    <title>GoneButNotForgotten Mapping Co.</title>
    <!-- For the sweet alert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JavaScript here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
    <!-- CSS HERE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">  
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
                                <option value="Staff">Staff</option>
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
    <!---->
    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
        event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);
            
            // Get the password and password confirmation fields
            var password = form.elements["password"].value;
            var confirmPassword = form.elements["password_confirmation"].value;
            //for the contactNum
            var contactNum = form.elements["contactNumber"].value;
            var email = form.elements["contactEmail"].value;

            // Check if the contactNum contains exactly 11 digits
            if (contactNum.length !== 11 || !/^\d{11}$/.test(contactNum)) {
                // Display a SweetAlert popup for invalid contactNum
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Contact Number',
                    text: 'The contact number must be exactly 11 digits.',
                });
                return; // Prevent form submission
            }
            // Check if the passwords match
            else if (password !== confirmPassword) {
                // Display a SweetAlert popup for password mismatch
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'The passwords do not match. Please try again.'
                });
            } else if (password.length < 8) {
                // Display a SweetAlert popup for password length less than 8 characters
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
                        // Display an error SweetAlert popup
                        Swal.fire({
                            icon: 'error',
                            title: 'Email Already Taken',
                            text: 'The email address is already in use. Please try logging in or use a different email address.'
                        });
                    } else {
                        // Display a generic error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: 'An error occurred while processing your registration.'
                        });
                    }
                    throw new Error('Non-ok response from server');
                }
                else{
                    // Reset the form
                    form.reset();

                    // Display the success SweetAlert popup
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: 'Welcome to G.B.N.F. Mapping Co.!'
                    });
                }
            })
            .catch(error => {
                console.error("Error:", error);

                // Display an error SweetAlert popup
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
