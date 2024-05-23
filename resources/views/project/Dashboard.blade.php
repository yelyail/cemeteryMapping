<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>
            GoneButNotForgotten Mapping Co.
        </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/Map.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}"> 
        <script src="{{ asset('assets/javascript/sidebar.js') }}"></script>
        <script src="{{ asset('assets/javascript/search.js') }}"></script>

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
                    <li><a href="{{ route('dashboard') }}" class="active"><i class="bi bi-geo-alt"></i><span style="font-weight: 800;">Dashboard</span></a></li>
                    <li><a href="{{ route('cemInfo') }}" class="active"><i class="bi bi-card-text"></i><span>Cemetery Information</span></a></li>
                    <li><a href="{{ route('histoRec') }}" class="active"><i class="bi bi-file-earmark-text"></i><span>Historical Records</span></a></li>
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
                    <h5><b>{{ ucfirst($userName) }}</b></h5>
                    <h6>{{ strtoupper($userRole) }}</h6>
                </div>
            </div>
        </header>
        <div class="card-body">
            <div class="Container-Legend">
                <label colspan="3" class="Legend">Legend</label>
                <div class="row">
                    <div class="rowtxt" style="background-color: green;">
                        <label>Available</label>
                    </div>
                    <div class="rowtxt" style="background-color: red;">
                        <label>Occupied</label>
                    </div>
                    <div class="rowtxt" style="background-color: grey;">
                        <label>Reserved</label>
                    </div>
                </div>
            </div>
            <div class="search-wrapper">
                <i class="bi-search" style="margin: 0% 1% 0% 1%"></i>
                <input type="search" id="searchInput" onkeyup="searchPlotDashboard()"  placeholder="Search" class="search1">
            </div>
            <div class="MapTable">
                <table>
                    @foreach($cemeteryData as $cemeteryName => $data)
                        <tr class="emptyRow">
                            <td colspan="20">{{ ucfirst($cemeteryName) }}</td>
                        </tr>
                        @php
                            $totalPlots = $data['totalPlots'] ?? 0;
                            $plotData = $data['plotData'] ?? collect();    
                        @endphp
                        @for ($i = 0; $i < ceil($totalPlots / 20); $i++)
                            <tr class="Map{{ $i + 1 }}">
                                @for ($j = 0; $j < 20; $j++)
                                    @php
                                        $plotCounter = $i * 20 + $j + 1;
                                        if ($plotCounter > $totalPlots) {
                                            break;
                                        }
                                        $status = 'available';
                                        $plot = $plotData->where('plotNum', $plotCounter)->first();
                                        if ($plot) {
                                            if ($plot->decease) {
                                                if ($plot->stat == 'transfer') {
                                                    if ($plot->decease->reason === 'Unable to pay the payment for 5 years.') {
                                                        $status = 'available';
                                                    } elseif (in_array($plot->decease->reason, ['Desire for a different burial site.', 'Personal connections.'])) {
                                                        $status = 'reserved';
                                                        $ownerName = ucwords(strtolower($plot->buyer->fullName ?? ''));
                                                    } else {
                                                        $status = 'occupied';
                                                        $deceaseInfo = $plot->decease;
                                                        $occupantInfo = ($deceaseInfo->firstName ?? '') . ' ' . ($deceaseInfo->middleName ? substr($deceaseInfo->middleName, 0, 1) . '.' : '') . ' ' . ucwords(strtolower($deceaseInfo->lastName ?? ''));
                                                        $sex = $deceaseInfo->gender ?? '';
                                                        $bornDate = $deceaseInfo->bornDate ?? '';
                                                        $diedDate = $deceaseInfo->diedDate ?? '';
                                                        $burialDate = $deceaseInfo->burialDate ?? '';
                                                    }
                                                } else {
                                                    $status = 'occupied';
                                                    $deceaseInfo = $plot->decease;
                                                    $occupantInfo = ($deceaseInfo->firstName ?? '') . ' ' . ($deceaseInfo->middleName ? substr($deceaseInfo->middleName, 0, 1) . '.' : '') . ' ' . ucwords(strtolower($deceaseInfo->lastName ?? ''));
                                                    $sex = $deceaseInfo->gender ?? '';
                                                    $bornDate = $deceaseInfo->bornDate ?? '';
                                                    $diedDate = $deceaseInfo->diedDate ?? '';
                                                    $burialDate = $deceaseInfo->burialDate ?? '';
                                                }
                                            } elseif ($plot->ownerID && $plot->stat !== 'cancel') {
                                                $status = 'reserved';
                                                $ownerName = ucwords(strtolower($plot->buyer->fullName ?? ''));
                                            } elseif ($plot->stat === 'cancel') {
                                                $status = 'available';
                                            }
                                        } 
                                    @endphp
                                    <td class="plot {{ $status }}" 
                                        data-occupant="{{ $occupantInfo ?? '' }}"
                                        data-owner="{{ $ownerName ?? '' }}"
                                        data-sex="{{ $sex ?? '' }}"
                                        data-born="{{ $bornDate ?? '' }}"
                                        data-died="{{ $diedDate ?? '' }}"
                                        data-burial="{{ $burialDate ?? '' }}">
                                        {{ $plotCounter }}</td>
                                    @endfor
                                @if ($plotCounter >= $totalPlots)
                                    @break
                                @endif
                            </tr>
                        @endfor
                    @endforeach
                </table>
            </div>
        </div>                
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
    <script>
        function handleHover(element) {
            const status = element.className.split(' ')[1];
            element.title = status.charAt(0).toUpperCase() + status.slice(1);
            if (status === 'occupied') {
                const occupantName = element.dataset.occupant;
                const sex = element.dataset.sex;
                const born = element.dataset.born;
                const died = element.dataset.died;
                const burial = element.dataset.burial;
                element.title = `Occupied by: ${occupantName
                    }\nSex: ${sex
                    }\nBorn Date: ${born
                    }\nDied Date: ${died
                    }\nBurial Date: ${burial}`;
            } else if (status === 'reserved') {
                const ownerName = element.dataset.owner;
                element.title = `Reserved by: ${ownerName}`;
            }else {
                element.title = 'Available'; 
            }
        }
        const plotCells = document.querySelectorAll('.plot');
            plotCells.forEach(cell => {
                cell.addEventListener('mouseover', function() {
                    handleHover(this);
                });
            });
    </script>
</body>
</html>