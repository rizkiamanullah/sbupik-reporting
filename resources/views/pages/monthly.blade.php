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
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <form action="{{url('/reporting/weekly/save')}}" id="modalForm" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body" style="height: 80vh;">
                    <div class="container p-2">
                        @csrf
                        <input type="hidden" name="user_id" class="uid" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="weekNum" class="weekNum" value="{{ Auth::user()->id }}">
                        <div>
                            <h2 class="insert-title">Rencana</h2><br>
                            <textarea name="rencana_input" id="summernote" cols="30" rows="30" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex flex-row justify-content-between my-2">
                        <div></div>
                        <button type="submit" style="background-color:tomato; border-radius:20px;" data-dismiss="modal" aria-label="Close" class="btn-outline-dark float-right close btn-block p-3 text-white">OK</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    
    <div class="container-fluid fade-card my-3" style="height:auto;">
        <div class="row" >
            <div class="col-lg-12 my-3" style="height:auto;">
                <div class="card" style="background-color: #fff;">
                    <div class="card-body">
                        <div class="">
                            @php
                                $m = date('Y-m');
                                if (@$_GET['m']){
                                    $m = $_GET['m'];
                                }
                                $startWeekNow = date('W', strtotime($m));
                            @endphp
                            <h6>Pilih Bulan</h6>
                            <select name="mon" id="mon" class="form-control select2 text-bold">
                                @for ($mon=0; $mon < 12; $mon++)
                                    <option {{@$_GET['m'] == date('Y-m', strtotime('-'.$mon.' month')) ? "selected" : ""}} value="{{date('Y-m', strtotime('-'.$mon.' month'))}}">
                                        {{date('F Y', strtotime('-'.$mon.' month'))}}
                                    </option>
                                @endfor
                            </select>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="height: 60vh; border-radius:15px; border-color:grey; border-width:0.5px;" >
                        
                        <div class="py-2  mb-3">
                            <div class="card" style="background-color: #ffffff; height: auto">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped text-dark" style="background-color: #c9ead9">
                                        <tr>
                                            <td><h6>Rencana Minggu Ini</h6></td>
                                        </tr>
                                        <tr>
                                            <td><p class="text-break">{!!@$weekPlan->json_data ? (@json_decode(@$weekPlan->json_data, true)['rencana']) : "-"!!}</p></td>
                                        </tr>
                                        <tr></tr>
                                    </table>
                                    <br>
                                    <h5>{{date('F Y', strtotime($m))}}</h5>
                                    @php
                                        $dayCounter = 1;
                                        $saidNum = ['One','Two','Three','Four','Five'];
                                    @endphp
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    @for ($week = 0; $week < 5; $week++)
                                        @php
                                            @$dataToday = DB::table('tb_weekly_progress')
                                            ->where('id_user', Auth::user()->id)
                                            ->where('weekNum',$startWeekNow)
                                            ->first();
                                        @endphp
                                        <div class="week{{$week}} my-2">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="flush-heading{{$saidNum[$week]}}" style="background-color: #f2f2f2">
                                                    <button class="accordion-button btn-outline-light rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$saidNum[$week]}}" aria-expanded="false" aria-controls="flush-collapse{{$saidNum[$week]}}">
                                                        <h6>Minggu {{$week+1}} &nbsp; {!!(!@$dataToday &&$startWeekNow == date('W') + 1) ? '<small class="bg-warning blink rounded px-2 py-1 text-white">Baru</small>' : ''!!} </h6>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse{{$saidNum[$week]}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$saidNum[$week]}}" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <div class="upper" style="overflow-x: auto; border-radius:15px;">
                                                            <div class="" style="width:auto">
                                                                @if (!@$dataToday)
                                                                    @if ($startWeekNow == date('W') + 1)
                                                                        {{-- @if (date('N') != 5)
                                                                            <div class="col-sm-12 pb-2">
                                                                                <p>Silahkan mengisi di Hari Jumat, {{date('d F Y', strtotime('next friday'))}}</p>
                                                                            </div>
                                                                        @else
                                                                        @endif --}}
                                                                        <div class="col-sm-12 pb-2">
                                                                            <div href="#" style="border-radius: 25px; background-color:tomato" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-week="{{$startWeekNow}}" data-weekmon="{{$week+1}}" class="p-4 text-white btn-outline-dark buat-lap"><i class="fas fa-plus"></i>&nbsp;Buat Laporan!</div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-sm-12 pb-2">
                                                                            <p>Rencana tidak terisi</p>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="col-sm-12 pb-2">
                                                                        <div style="border-radius: 3px;" class="p-2 text-dark bg-white">
                                                                            <table class="table rounded text-dark" style="width: 100%; background-color:#fdffb6">
                                                                                <tr>
                                                                                    <td><h6 for="">{{date('d F Y', strtotime(date('Y')."W".$startWeekNow))}} - {{date('d F Y', strtotime(date('Y')."W".$startWeekNow." + 6 days"))}}<i class="p-2 fa fa-check-circle"></h6></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><p class="text-break">
                                                                                        {!!(@json_decode(@$dataToday->json_data, true)['rencana'])!!}</td>
                                                                                    </p>
                                                                                </tr>
                                                                                <tr></i></tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $startWeekNow++;
                                        @endphp
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
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script>
        $(document).delegate('#mon','change',function(){
            window.location = "{{url('monthly?m=')}}"+$(this).val();
        });
        $(document).delegate('.buat-lap','click',function(){
            $('input[name="weekNum"]').val($(this).data('week'));
            $('.insert-title').text("Rencana Minggu "+$(this).data('weekmon'));
        });
        (function blink(){
            $('.blink').fadeOut(500).fadeIn(500, blink);
        })();
    </script>
    <script>
        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function () 
        {
            $('#summernote').summernote({
                height: 250
            });
        });

        $('.tap-close').click(function(){
            $(this).hide();
        })
        
        $('.fade-card').hide().fadeIn(400);        
    </script>
@endpush
