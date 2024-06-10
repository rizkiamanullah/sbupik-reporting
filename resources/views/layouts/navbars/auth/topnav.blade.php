<!-- Navbar -->
<div>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none bg-white" style="border-radius: 0 0 15px 15px; "
            id=""
            data-scroll="true">
        <br><br>
        <div class="container-fluid py-1 px-3">
            @php
                $hari = [
                    'Mon' => "Senin",
                    'Tue' => "Selasa",
                    'Wed' => "Rabu",
                    'Thu' => "Kamis",
                    'Fri' => "Jumat",
                    'Sat' => "Sabtu",
                    'Sun' => "Minggu",
                ];
                $bulan = [
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'September',
                    '12' => 'Desember',
                ];

                // semoga ga bug
                function WoM($date){
                    $num = 1;
                    $fD = date('Y-m-1', strtotime($date));
                    for ($d = 1; $d < cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))+1; $d++){
                        if (date('N', strtotime(date('Y-m-'.$d))) == 6){
                            $num +=1;
                        }
                        if (date('Y-m-'.$d) == date('Y-m-d')){
                            break;
                        }
                    }
                    return $num;
                }

            @endphp
            <nav aria-label="breadcrumb">
                <h5 class="text-dark mb-0">{{ $hari[date('D')]. ", ".date('d')." ".$bulan[date('m')]." ".date('Y') }} | (Minggu ke-{{WoM(date('Ymd'))}}) </h5><h1 id="txt"></h1>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                    </div>
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                    </li>
                    <li class="nav-item d-xl-none p-4 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-dark p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-dark"></i>
                                <i class="sidenav-toggler-line bg-dark"></i>
                                <i class="sidenav-toggler-line bg-dark"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<script>
    function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s + " WIB";    
    setTimeout(startTime, 1000);
    }

    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
    }
    startTime();
</script>

<!-- End Navbar -->
