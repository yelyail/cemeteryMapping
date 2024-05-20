<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>         
        <title>
            GoneButNotForgotten Mapping Co.
        </title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/DashTable.css') }}"> 
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
                    <li><a href="{{ route('home') }}" class="active"><i class="bi bi-house"></i><span>Home</span></a></li>
                    <li><a href="{{ route('dashboard') }}" class="active"><i class="bi bi-geo-alt"></i><span>Dashboard</span></a></li>
                    <li><a href="{{ route('cemInfo') }}" class="active"><i class="bi bi-card-text"></i><span>Cemetery Information</span></a></li>
                    <li><a href="" class="active"><i class="bi bi-file-earmark-text"></i><span style="font-weight: 800;">Historical Records</span></a></li>
                    <li><a href="{{ route('maintainRec') }}" class="active"><i class="bi bi-file-earmark-medical"></i><span>Maintenance Status</span></a></li>
                    <li><a href="{{ route('transaction') }}" class="active"><i class="bi bi-receipt"></i><span>Transaction</span></a></li>
                    <li><a href="{{ route('logout') }}" class="active"><i class="bi bi-box-arrow-right"></i><span>Log out</span></a></li>
                </ul>
            </div>
        </div>   
        <div class="main-content">
            <!------------------------------------------------------ Header ------------------------------------------------------>
            <header>
                <h2>
                    <label for="nav-toggle">
                        <i class="bi-layout-sidebar-inset"></i>
                    </label>
                </h2>
                <div class="user-wrapper">
                    <div>
                        <h5 class="Titletxt">Historical Records</h5>
                    </div>
                </div>
                <label class="container">
                    <input type="checkbox" checked="checked">
                    <svg class="bell-regular" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path>
                    </svg>
                    <svg class="bell-solid" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path>
                    </svg>
                </label>
            </header>
            <!------------------------------------------------------ MAIN ------------------------------------------------------>
            <div class="card-body">
            <!----------------Unite/Search and Button---------------->
            <div class="search-and-button-container">
                <!--------Search-------->
                <div class="search-wrapper">
                    <i class="bi-search" style="margin: 0% 1% 0% 1%"></i>
                    <input type="search" placeholder="Search">
                </div>
                    <!--------Button-------->
                     <button type="button" class="btn btn-success" id="plus-button" style="border-radius: 7px; width: auto;height: 2.3rem; margin-left: 1%; border: none;">
                        <i class="bi bi-plus"></i>
                    </button>
            </div>
            <!----------------Table---------------->
                    <div class="TableBody">
                        <div class="table-responsive">
                        <table class="TableContent">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Plot Number</td>
                                    <td>First Name</td>
                                    <td>Middle Name</td>
                                    <td>Last Name</td>
                                    <td>Gender</td>
                                    <td>Born Date</td>
                                    <td>Died Date</td>
                                    <td>Burial Date</td>
                                    <td>Transfer</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($histo as $histos)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $histos->plotNum }}</td>
                                        <td>{{ ucwords(strtolower($histos->firstName)) }}</td>
                                        <td>{{ ucwords(strtolower($histos->middleName)) }}</td>
                                        <td>{{ ucwords(strtolower($histos->lastName)) }}</td>
                                        <td>{{ $histos->gender }}</td>
                                        <td>{{ $histos->bornDate }}</td>
                                        <td>{{ $histos->diedDate }}</td>
                                        <td>{{ $histos->burialDate }}</td>
                                        <td><button type='button' class='btn btn-success' onclick="showTransferAlert('{{ $histos->deceaseID }}')">Transfer</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div> 
        </div>
        <br><br><br>
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
        <!--------------------------------------JAVA SCRIPT----------------------------------------------------------->
        <script>
            const toggleButtons = document.querySelectorAll(".toggle-button");
            toggleButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const cardBody = this.parentNode.nextElementSibling;
                    cardBody.classList.toggle("hidden");
                });
            });
        </script>

        <form id="transferForm" action="{{ route('storeTransferReason') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="decease_id" id="decease_id">
            <input type="hidden" name="reason" id="reason">
        </form>
        <script>
            document.getElementById('plus-button').addEventListener('click', function() {
                window.location.href = "{{ route('addDecease') }}";
            });

            function showTransferAlert(deceaseId) {
                Swal.fire({
                    title: "Do you want to transfer the deceased?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Reasons for Transferring the deceased.',
                            input: 'select',
                            inputOptions: {
                                'Unable to pay the payment for 5 years.': 'Unable to pay the payment for 5 years.',
                                'Desire for a different burial site.': 'Desire for a different burial site.',
                                'Personal connections.': 'Personal connections.',
                                'Others': 'Others'
                            },
                            inputPlaceholder: 'Select reason',
                            confirmButtonText: 'Confirm',
                            showCancelButton: true,
                            cancelButtonText: 'Cancel'
                        }).then((reason) => {
                            if (reason.isConfirmed) {
                                Swal.fire({
                                    title: "Transferring Remains has been confirmed",
                                    text: "Reason: " + reason.value,
                                    icon: "success"
                                }).then(() => {
                                    console.log('Decease ID:', deceaseId);
                                    console.log('Reason:', reason.value);
                                    document.getElementById('decease_id').value = deceaseId;
                                    document.getElementById('reason').value = reason.value;
                                    document.getElementById('transferForm').submit();
                                });
                            } else {
                                Swal.fire("Transferring Remains has been canceled", "", "info");
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Transferring Remains has been canceled", "", "info");
                    }
                });
            }
        </script>
    </body>
</html>
