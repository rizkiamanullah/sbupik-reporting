@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <style>
        td {
        white-space: normal !important; 
        word-wrap: break-word;  
        }
        table {
        table-layout: fixed;
        }
    </style>

    @php
        @$weekPlan = DB::table('tb_weekly_progress')
        ->where('id_user', Auth::user()->id)
        ->where('weekNum',date('W'))
        ->first();
    @endphp
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <form action="{{url('/reporting/save')}}" id="modalForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_task" value="{{@$weekPlan->id}}">
            <div class="modal-content">
                <div class="modal-body" style="height: 80vh;">
                    <div class="container p-2">
                        @csrf
                        <input type="hidden" name="user_id" class="uid" value="{{ Auth::user()->id }}">
                        <div class="page-1 p-4 d-none">
                            <h4><b>Hari ini,</b></h4>
                            <h6><b>rencana</b> saya hari ini adalah...</h6>
                            <label class="text-danger notif-danger"></label>
                            <textarea name="rencana" placeholder="Tuliskan target hari ini" class="form-control plan" id="" cols="30" rows="10"></textarea>
                            <div class="d-flex flex-row justify-content-between my-2">
                                <div></div>
                                <div style="background-color:tomato; border-radius:20px;" class="btn-outline-dark float-right pg2 btn-block p-3 text-white">OK</div>
                            </div>
                        </div>
                        <div class="page-2 p-4">
                            <div style="height:auto; overflow-y:auto;">
                                <div>
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <td><h6>Rencana</h6></td>
                                        </tr>
                                        <tr>
                                            <td>{{@json_decode($dataToday->progress, true)['rencana'] ?: "-"}}</td>
                                        </tr>
                                        <tr></tr>
                                    </table>
                                </div>
                                <h4><b>Hari ini,</b></h4>
                                <h6><b>realisasi</b> saya hari ini adalah...</h6>
                                <textarea name="realisasi" placeholder="Tuliskan realisasi hari ini" class="form-control real" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="d-flex flex-row justify-content-between my-2">
                                <div></div>
                                <div style="background-color:tomato; border-radius:20px;" class="pg3 btn-outline-dark float-right btn-block p-3 text-white">OK</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- Modal -->
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="card" style="background-color: #fff">
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-12 py-2">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td><h6>Rencana Minggu Ini</h6></td>
                                        </tr>
                                        <tr>
                                            <td><p class="text-break">{{@$weekPlan->json_data ? @strip_tags(@json_decode(@$weekPlan->json_data, true)['rencana']) : "-"}}</p></td>
                                        </tr>
                                        <tr></tr>
                                    </table>
                                </div>
                                @if (!@$dataToday)
                                <div class="col-sm-6 pb-2">
                                    <div href="#" style="border-radius: 25px; background-color:tomato" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="p-4 text-white btn-outline-dark buat-lap"><i class="fas fa-plus"></i>&nbsp;Buat Laporan Target</div>
                                </div>
                                @else
                                @if (!@$dataToday->done_for_today)
                                    <div class="col-sm-6 pb-2">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <td><h6>Rencana</h6></td>
                                            </tr>
                                            <tr>
                                                <td>{{@json_decode($dataToday->progress, true)['rencana'] ?: "-"}}</td>
                                            </tr>
                                            <tr></tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-6 pb-2">
                                        <div href="#" style="border-radius: 25px; background-color:yellowgreen" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="p-4 text-white btn-outline-dark buat-lap-2"><i class="fas fa-plus"></i>&nbsp;Buat Laporan Realisasi</div>
                                    </div>
                                    @else
                                    <div class="col-sm-6 pb-2">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <td><h6>Rencana</h6></td>
                                            </tr>
                                            <tr>
                                                <td>{{@json_decode($dataToday->progress, true)['rencana'] ?: "-"}}</td>
                                            </tr>
                                            <tr></tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-6 pb-2">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <td><h6>Realisasi</h6></td>
                                            </tr>
                                            <tr>
                                                <td>{{@json_decode($dataToday->progress, true)['realisasi'] ?: "-"}}</td>
                                            </tr>
                                            <tr></tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 pb-2">
                                        <div href="#" style="border-radius: 25px; background-color:grey" class="p-4 text-white btn-outline-dark tap-close">Terima kasih. Anda sudah melapor hari ini 🙏🙏🙏</div>
                                    </div>
                                    @endif
                                @endif
                            </div>
                            <div class="row my-1">
                                <br>
                                <hr>
                                <br>
                                <h4>Rekap Kegiatan Harian di Bulan {{date('F Y')}}</h4>
                                <div class="col-sm-12" style="height: 60vh; border-radius:15px; border-color:grey; border-width:0.5px;" >
                                
                                    <div class="py-2  mb-3">
                                        @php
                                            $m = date('Y-m');
                                            if (@$_GET['m']){
                                                $m = $_GET['m'];
                                            }
                                            $startWeekNow = date('W', strtotime($m));
                                        @endphp
                                        <div class="card" style="background-color: #eeeff3; height: auto">
                                            <div class="card-body">
                                                @php
                                                    $m = date('Y-m-d', strtotime(date('Y-m-1')));
                                                    if (@$_GET['m']){
                                                        $m = date('Y-m-1', strtotime(@$_GET['m']));
                                                    }
                                                    $startWeekMon = date('W', strtotime($m));
                                                @endphp
                                                <div class="accordion accordion-flush border" id="accordionFlushExample">
                                                @for ($week = $startWeekMon; $week < $startWeekMon+5; $week++)
                                                    <div class="week{{$week}}" style="background-color: #f2f2f2">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{$week}}">
                                                                <button class="accordion-button bg-white my-2 rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$week}}" aria-expanded="false" aria-controls="flush-collapse{{$week}}">
                                                                    <h6>Minggu {{$week+1}}</h6>
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{$week}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$week}}" data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body bg-white rounded">
                                                                    <table class="table table-striped table-bordered">
                                                                        <thead>
                                                                            <th>Tanggal</th>
                                                                            <th>Rencana</th>
                                                                            <th>Realisasi</th>
                                                                        </thead>
                                                                        <tbody>
                                                                        @if (count($dataDaily) > 0)
                                                                            @foreach ($dataDaily as $daily)
                                                                                @if (date('W', strtotime($daily->date)) == @$week->weekNum)
                                                                                <tr>
                                                                                    <td class="p-2">{{date('d/m/Y', strtotime($daily->date))}}</td>
                                                                                    <td class="p-2">{!! (@json_decode(@$daily->progress, true)['rencana']) !!}</td>
                                                                                    <td class="p-2">{!! (@json_decode(@$daily->progress, true)['realisasi']) !!}</td>
                                                                                </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                        <tr>
                                                                            <td colspan="4" align="center">Belum ada rencana/ realisasi</td>
                                                                        </tr>
                                                                        @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                                </div>
                                            </div>
                                        </div>
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
                        $('.modal').modal('hide');

                        swal.fire({
                            title: "{{ __('Success!') }}",
                            text: "Catatan Tersimpan!",
                            type: "success"
                        });

                        window.location.reload();   
                    }, error: function(data){
                        swal.fire({
                            title: "{{ __('Failed') }}",
                            text: "Catatan Gagal Tersimpan!",
                            type: "failed"
                        });
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
