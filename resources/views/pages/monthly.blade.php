@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <form action="{{url('/reporting/save')}}" id="modalForm" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body" style="height: 80vh;">
                    <div class="container p-2">
                        @csrf
                        <input type="hidden" name="user_id" class="uid" value="{{ Auth::user()->id }}">
                        <div class="page-1 p-4 d-none">
                            <h4><b>Hari ini,</b></h4>
                            <h6><b>garis besar rencana</b> saya minggu depan adalah...</h6>
                            <label class="text-danger notif-danger"></label>

                            <div class="card" style="color: #eeeff3">
                                <div class="card-body">
                                </div>
                            </div>

                            <div class="">
                                <label for="">Isikan rencana disini:</label>
                                <textarea name="input_rencana_mingguan" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="d-flex flex-row justify-content-between my-3">
                                <div></div>
                                <div style="background-color:limegreen; border-radius:20px;" class="btn-outline-dark float-right btn-block p-3 text-white"><i class="fas fa-plus"></i>&nbsp;Tambah</div>
                            </div>
                        </div>
                        <div class="page-2 p-4">
                            <h4><b>Hari ini,</b></h4>
                            <h6><b>realisasi</b> saya hari ini adalah...</h6>
                            <textarea name="realisasi" placeholder="Tuliskan realisasi hari ini" class="form-control real" id="" cols="30" rows="10"></textarea>
                            <div class="d-flex flex-row justify-content-between my-2">
                                <div></div>
                                <div style="background-color:tomato; border-radius:20px;" class="pg3 btn-outline-dark float-right btn-block p-3 text-white">OK</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex flex-row justify-content-between my-2">
                        <div></div>
                        <div style="background-color:tomato; border-radius:20px;" class="btn-outline-dark float-right pg2 btn-block p-3 text-white">OK</div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="card" style="background-color: #fff">
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-12" style="height: 60vh; border-radius:15px; border-color:grey; border-width:0.5px; overflow-y: auto" >
                                    
                                    <div class="py-2  mb-3">
                                        @php
                                            $staticstart = date('Y-m-d',strtotime('last saturday of previous month'));
                                            $staticend = date('Y-m-d',strtotime('first friday of next month'));
                                            // dd($staticstart);
                                        @endphp
                                        <div class="card" style="background-color: #eeeff3; height: auto">
                                            <div class="card-body">
                                                @php
                                                    $dayCounter = 1;
                                                    $saidNum = ['One','Two','Three','Four','Five'];
                                                @endphp
                                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                                @for ($week = 0; $week < 5; $week++)
                                                    <div class="week{{$week}}">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="flush-heading{{$saidNum[$week]}}">
                                                                <button class="accordion-button bg-white my-2 rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$saidNum[$week]}}" aria-expanded="false" aria-controls="flush-collapse{{$saidNum[$week]}}">
                                                                    <h6>Minggu {{$week+1}}</h6>
                                                                </button>
                                                                </h2>
                                                                <div id="flush-collapse{{$saidNum[$week]}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$saidNum[$week]}}" data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    <div class="upper" style="overflow-x: auto; border-radius:15px;">
                                                                        <div class="" style="width:auto">
                                                                            <div class="">
                                                                                <div class="">
                                                                                    <div class="">
                                                                                        @if (!@$dataToday)
                                                                                            <div class="col-sm-12 pb-2">
                                                                                                <div href="#" style="border-radius: 25px; background-color:tomato" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="p-4 text-white btn-outline-dark buat-lap"><i class="fas fa-plus"></i>&nbsp;Laporan Minggu {{$week+1}}</div>
                                                                                            </div>
                                                                                        @else
                                                                                            @if (!@$dataToday->done_for_today)
                                                                                            <div class="col-sm-12 pb-2">
                                                                                                <div href="#" style="border-radius: 25px; background-color:yellowgreen" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="p-4 text-white btn-outline-dark buat-lap-2"><i class="fas fa-plus"></i>&nbsp;Laporan Realisasi Minggu {{$week+1}}</div>
                                                                                            </div>
                                                                                            @else
                                                                                            <div class="col-sm-12 pb-2">
                                                                                                <div href="#" style="border-radius: 25px; background-color:grey" class="p-4 text-white btn-outline-dark tap-close">Terima kasih. Anda sudah melapor hari ini 🙏🙏🙏</div>
                                                                                            </div>
                                                                                            @endif
                                                                                        @endif

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="lower d-none">
                                                                        <div class="card" style="width: 100%">
                                                                            <div class="card-header">
                                                                                <h4>Rabu, 27 Maret 2024</h4>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <h6 for=""><b>Rencana</b></h6>
                                                                                <div class="d-flex flex-row">
                                                                                    <div class="p-2">
                                                                                        <p style="word-wrap: auto">{{@json_decode($dataToday->progress, true)['rencana'] ?: "-"}}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <h6 for=""><b>Realisasi</b></h6>
                                                                                <div class="d-flex flex-row">
                                                                                    <div class="p-2">
                                                                                        <p style="word-wrap: auto">{{@json_decode($dataToday->progress, true)['realisasi'] ?: "-"}}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endfor
                                                    </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                </div>
                            </div>
                        </div>
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
        $(document).delegate('.buat-lap','click',function(){
            $('.modal-body').find('.page-1').removeClass('d-none').hide().fadeIn(500);
            $('.modal-body').find('.page-2').addClass('d-none');
        });
        $(document).delegate('.buat-lap-2','click',function(){
            $('.modal-body').find('.page-2').removeClass('d-none').hide().fadeIn(500);
            $('.modal-body').find('.page-1').addClass('d-none');
        });

        $(document).delegate('.pg2, .pg3','click',function(){
            var plan = $('.plan').val();
            var real = $('.real').val();
            if (plan || real){
                // saving
                $.ajax({
                    url: "{{url('/reporting/save')}}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: $('#modalForm').serialize(),
                    success: function(data){
                        $('.modal-body').html('<img src="https://media.tenor.com/ogsClPgCYcAAAAAi/mochi-mochi-mochi.gif" width="250" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" />').hide().fadeIn(90);
                        $('.modal-body').find('.page-1').addClass('d-none');
                        setTimeout(function() {
                            $('.modal').modal('hide');
                        }, 2000);
                        setTimeout(function() {
                            window.location.reload();   
                        }, 2500);
                    }
                });
            } else {
                $('.notif-danger').text("Isian tidak boleh kosong");
            }
        });

        $('.tap-close').click(function(){
            $(this).hide();
        })
        
        $('.fade-card').hide().fadeIn(400);        
    </script>
@endpush
