<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>         
        <title>
            GoneButNotForgotten Mapping Co.
        </title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/DashTable.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}"> 
        <script src="{{ asset('assets/javascript/search.js') }}"></script>
        <script src="{{ asset('assets/javascript/sidebar.js') }}"></script>
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
            </header>
            <div class="card-body">
            <div class="search-and-button-container">
                <div class="search-wrapper">
                    <i class="bi-search" style="margin: 0% 1% 0% 1%"></i>
                    <input type="search" id="searchInput" onkeyup="searchPlotHistorical()" placeholder="Search" class="search1">
                </div>
                     <button type="button" class="btn btn-success" id="plus-button" style="border-radius: 7px; width: auto;height: 2.3rem; margin-left: 1%; border: none;">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
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
                                        <td>{{ $histos->plotInvent->plotNum }}</td>
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
                    denyButtonText: "No"
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
                                    document.getElementById('decease_id').value = deceaseId;
                                    document.getElementById('reason').value = reason.value;
                                    document.getElementById('transferForm').submit();
                                    console.log($deceaseID);
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
