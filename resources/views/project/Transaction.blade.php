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
                    <li><a href="{{ route('cemInfo') }}" class="active"><i class="bi bi-card-text"></i><span>Cemetery Information</span></a> </li>
                    <li> <a href="{{ route('histoRec') }}" class="active"><i class="bi bi-file-earmark-text"></i><span>Historical Records</span></a></li>
                    <li><a href="{{ route('maintainRec') }}" class="active"><i class="bi bi-file-earmark-medical"></i><span>Maintenance Status</span></a></li>
                    <li><a href="{{ route('transaction') }}" class="active"><i class="bi bi-receipt"></i><span style="font-weight: 900;">Transaction</span></a></li>
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
                        <h5 class="Titletxt">Transaction Information</h5>
                    </div>
                </div>
            </header>
            <div class="card-body">
                    <div class="choices2">
                        <table class="tbl">
                            <tbody style="border-collapse: collapse;">
                                <tr >
                                    <td ><a href="{{ route('transaction') }}" class="re"><b>Transaction Details</b></a></td>
                                    <td><a href="{{ route('infoTransact') }}" class="re">Refund Details</a></td>
                                    <td><a href="{{ route('transactCancel') }}" class="re">Cancel Details</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            <div class="search-and-button-container">
                <div class="search-wrapper">
                    <i class="bi-search" style="margin: 0% 1% 0% 1%"></i>
                    <input type="search" id="searchInput" onkeyup="searchPlot()" placeholder="Search" class="search1">
                </div>
                     <button type="button" class="btn btn-success" id="plus-button" style="border-radius: 7px; width: auto;height: 2.3rem; margin-left: 1%; border: none;">
                        <i class="bi bi-printer"></i>
                    </button>
            </div>
                    <div class="TableBody">
                        <div class="table-responsive">
                        <table class="TableContent">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Fullname</td>
                                    <td>Decease Name</td>
                                    <td>Location</td>
                                    <td>Date of Purchase</td>
                                    <td>Date to Transfer</td>
                                    <td>Reason of Transfer</td>
                                    <td>Remarks</td>
                                    <td>Print</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($decease as $deceases)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords(strtolower($deceases->plotInvent->buyer->fullName ?? 'N/A')) }}</td>
                                        <td>
                                            {{ ucwords(strtolower($deceases->firstName ?? 'N/A')) }}
                                            {{ $deceases->middleName ? ucwords(strtolower(substr($deceases->middleName, 0, 1))) . '.' : '' }}
                                            {{ ucwords(strtolower($deceases->lastName ?? 'N/A')) }}
                                        </td>
                                        <td>{{ ucwords(strtolower($deceases->plotInvent->cemName ?? 'N/A')) }}, Plot Number: {{ $deceases->plotInvent->plotNum ?? 'N/A' }}</td>
                                        <td>{{ $deceases->plotInvent->purchaseDate ?? 'N/A' }}</td>
                                        <td>{{ $deceases->updated_at ?? 'N/A' }}</td>
                                        <td>{{ ucwords(strtolower($deceases->reason ?? 'N/A')) }}</td>
                                        <td>{{ ucwords(strtolower($deceases->remarks ?? 'N/A')) }}</td>
                                        <td><form action="{{ route('generatePDF', $deceases->deceaseID) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success"><i class="bi bi-printer"></i></button>
                                            </form>
                                        </td>                                    
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
    </body>
</html>