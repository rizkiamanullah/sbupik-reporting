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
                                {{-- <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/reporting')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/correct.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pelaporan Harian</p>
                                    </div>
                                </a> --}}
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('list-officer')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/correct.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pelaporan Mingguan Pegawai</p>
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
        $('.fixed-plugin').addClass('d-none');
        $(document).delegate('.add','click',function(){
            let html = `
                <tr>
                    <td>
                        <select name="anggota[]" id="" class="form-control text-dark select2">
                            @foreach ($users as $u)
                                <option value="{{$u->id}}">{{$u->username}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            `;
            $('#dbody').append(html);
        });

        $('.fade-card').hide().fadeIn(400);
        // sticky notes functionability
        function fetchStickyNotes(){
            $.ajax({
                type: "GET",
                url: "{{url('/getStickyNotes')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(d){
                    let field = ``;
                    if (d){
                        d = JSON.parse(d);
                        d.map(function(val,idx){
                            field += `
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div data-id="${val.id}" class="btn btn-md bg-danger del text-white p-2"><i class="fas fa-trash"></i></div>
                                    <div class="d-flex flex-column mx-2">
                                        <h6 class="mb-2 text-dark text-sm">${val.created_at}</h6>
                                        <p>${val.message}</p>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            `;
                        })
                        $('.list-note').html(field);
                    } else {
                        $('.list-note').html(`
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column mx-2">
                                    <small><i>Belum ada catatan</i></small>
                                </div>
                            </div>
                        </li> 
                        `);
                    }
                },
            }).done(function(){});
        }
        $(document).delegate('.btn-save-note','click',function(){
            let input = $(this).parent().find('.note-input').val();
            $.ajax({
                type: "POST",
                url: "{{url('/saveStickyNotes')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'input': input,
                },
                success: function(d){
                    $('.note-input').val("");
                    fetchStickyNotes();
                },
            }).done(function(){});
        })
        
        $(document).delegate('.del','click',function(){
            let id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{url('/deleteStickyNotes')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function(d){
                    fetchStickyNotes();
                },
            }).done(function(){});
        })
        
    </script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
