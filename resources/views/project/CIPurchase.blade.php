<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <li> <a href="{{ route('home') }}" class="active"><i class="bi bi-house"></i><span>Home</span></a></li>
                    <li><a href="{{ route('dashboard') }}" class="active"><i class="bi bi-geo-alt"></i><span>Dashboard</span></a></li>
                    <li><a href="{{ route('cemInfo') }}" class="active"><i class="bi bi-card-text"></i><span style="font-weight: 800;">Cemetery Information</span></a></li>
                    <li><a href="{{ route('histoRec') }}" class="active"><i class="bi bi-file-earmark-text"></i><span>Historical Records</span></a></li>
                    <li><a href="{{ route('maintainRec') }}" class="active"><i class="bi bi-file-earmark-medical"></i><span>Maintenance Status</span></a></li>
                    <li> <a href="{{ route('transaction') }}" class="active"><i class="bi bi-receipt"></i><span>Transaction</span></a></li>
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
                        <h5 class="Titletxt">Cemetery Information</h5>
                    </div>
                </div>
            </header>
            <div class="card-body">
                    <div class="choices">
                        <a href="{{ route('cemInfo') }}" class="OLINK">Cemetery Expansion</a>
                        &nbsp; &nbsp;
                        <p class="OTEXT">Plot Purchase</p>
                    </div> <br><br>
                    <div class="choices2">
                        <table class="tbl">
                            <tbody style="border-collapse: collapse;">
                                <tr >
                                    <td ><a href="#" class="re"><b>Purchase</b></a></td>
                                    <td><a href="{{ route('owner') }}" class="re">Buyer</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            <div class="search-and-button-container">
                <div class="search-wrapper">
                    <i class="bi-search" style="margin: 0% 1% 0% 1%"></i>
                    <input type="search" id="searchInput" onkeyup="searchPlotPurchase()" placeholder="Search" class="search1">
                </div>
                    <button type="button" class="btn btn-success" id="plus-button" style="border-radius: 7px; width: auto;height: 2.3rem; margin-left: 1%; border: none;">
                     <i class="bi bi-bag"></i>                    
                    </button>
            </div>
                <div class="TableBody">
                    <div class="table-responsive">
                       <table class="TableContent">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Cemetery Names</td>
                                <td>Owner Name</td>
                                <td>Plot Number</td>
                                <td>Size</td>
                                <td>Plot Price</td>
                                <td>Purchase Date</td>
                                <td>Cancel</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plots as $plot)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords(strtolower($plot->cemName)) }}</td>
                                    <td>{{ ucwords(strtolower($plot->fullName)) }}</td>
                                    <td>{{ $plot->plotNum }}</td>
                                    <td>{{ $plot->size }}</td>
                                    <td>₱ {{ number_format($plot->plotPrice, 2) }}</td>
                                    <td>{{ $plot->purchaseDate }}</td>
                                    <td><button type="button" class="btn btn-danger cancel-btn" data-plotinventid="{{ $plot->plotInventID }}">Cancel</button></td>
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
                                        <li class="list-inline-item"><a href="https://www.facebook.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-facebook"></i></a></li>
                                        <li class="list-inline-item"><a href="https://www.youtube.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-youtube"></i></a></li>
                                        <li class="list-inline-item"><a href="https://twitter.com/" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-twitter"></i></a> </li>
                                        <li class="list-inline-item"> <a href="https://www.google.com" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script>
            document.getElementById('plus-button').addEventListener('click', function() {
                window.location.href = "{{ route('buyPlot') }}";});
        </script>
        <script>
            $(document).ready(function(){
                $('.cancel-btn').click(function(){
                    var plotInventID = $(this).data('plotinventid');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You are about to cancel this transaction!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, cancel it!',
                        cancelButtonText: 'No, keep it'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: '{{ route("cancelTransact") }}',
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    'plotInventID': plotInventID,
                                    'post_status' : 0
                                },
                                success: function(data){
                                    Swal.fire(
                                        'Cancelled!',
                                        'Your transaction has been cancelled.',
                                        'success'
                                    ).then(() => {
                                        window.location.href = '{{ route("transactCancel") }}';
                                    });
                                },
                                error: function(data){
                                    Swal.fire(
                                        'Error!',
                                        'There was an error cancelling the transaction.',
                                        'error'
                                    );
                                }
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                        }
                    });
                });
            });
        </script>
    </body>
</html>