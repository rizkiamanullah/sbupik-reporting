@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <form action="{{url('/project/saveProject')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Proyek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                        @csrf
                        <div class="col-sm-12">
                            <label for="">Nama Proyek</label>
                            <input name="nama_proyek" type="text" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="">Manajer Proyek</label>
                            <input type="text" name="nama_manager" value="{{Auth::user()->firstname}}" readonly class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="">Anggota</label>
                            <div class="table-responsive" style="height:160px; overflow-y:auto; border-size: 1px;">
                                <table class="table table-striped">
                                    <tbody id="dbody">
                                        <tr>
                                            <td>
                                                <select name="anggota[]" id="" class="form-control text-dark select2">
                                                    @foreach ($users as $u)
                                                        <option value="{{$u->id}}">{{$u->username}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="my-2 btn btn-sm bg-success add text-white"><i class="fas fa-plus"></i>&nbsp;Tambah Anggota</div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
        </div>
    </div>
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="d-flex flex-column" style="width:100%;">
                            <div class="d-flex flex-row align-self-center px-5">
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/reporting')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/correct.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pelaporan</p>
                                    </div>
                                </a>
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/pm-report')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/list.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pelaporan Pegawai</p>
                                    </div>
                                </a>
                                {{-- <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/kanban')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/task.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Kanban</p>
                                    </div>
                                </a>
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/my-profile')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/user.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Profil</p>
                                    </div>
                                </a>
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/news')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/newspaper.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Berita</p>
                                    </div>
                                </a> --}}
                                {{-- <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/settings')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/cog.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pengaturan</p>
                                    </div>
                                </a> --}}
                                {{-- <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/my-message')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/bubble-chat.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pesan</p>
                                    </div>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 my-2">
                <div class="card" style="background-color: #fff">
                    <div class="card-body">
                        Segera Hadir
                    </div>
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
    {{-- dynamic calendar --}}
    <script>
        const daysTag = document.querySelector(".calendar_days"),
        currentDate = document.querySelector(".current-date"),
        prevNextIcon = document.querySelectorAll(".icons span");

        // getting new date, current year and month
        let date = new Date(),
        currYear = date.getFullYear(),
        currMonth = date.getMonth();

        // storing full name of all months in array
        const months = ["January", "February", "March", "April", "May", "June", "July",
                    "August", "September", "October", "November", "December"];

        const renderCalendar = () => {
            let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
            lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
            lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
            lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
            let liTag = "";

            for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
                liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
            }

            for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
                // adding active class to li if the current day, month, and year matched
                let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                            && currYear === new Date().getFullYear() ? "active" : "";
                liTag += `<li class="${isToday}">${i}</li>`;
            }

            for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
                liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
            }
            currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
            daysTag.innerHTML = liTag;
        }
        renderCalendar();

        prevNextIcon.forEach(icon => { // getting prev and next icons
            icon.addEventListener("click", () => { // adding click event on both icons
                // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
                currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

                if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
                    // creating a new date of current year & month and pass it as date value
                    date = new Date(currYear, currMonth, new Date().getDate());
                    currYear = date.getFullYear(); // updating current year with new date year
                    currMonth = date.getMonth(); // updating current month with new date month
                } else {
                    date = new Date(); // pass the current date as date value
                }
                renderCalendar(); // calling renderCalendar function
            });
        });
    </script>
@endpush
