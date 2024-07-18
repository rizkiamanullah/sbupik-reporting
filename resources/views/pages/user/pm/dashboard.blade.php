@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="overflow-x: auto;">
                        <h6>PM/ Higher Dashboard</h6>
                        <div class="d-flex flex-column" style="width:100%;">
                            <div class="d-flex flex-row align-self-center px-5">
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('list-officer')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/correct.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pelaporan Mingguan Pegawai</p>
                                    </div>
                                </a>
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('projects')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/correct.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Manajemen Proyek</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 my-2">
                <div class="card">
                    <div class="card-body">Segera Hadir</div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        (function blink(){
            $('.blink').fadeOut(500).fadeIn(500, blink);
        })();
    </script>
@endpush
