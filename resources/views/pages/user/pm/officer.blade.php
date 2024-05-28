@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('header')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@endsection
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

    <div class="container-fluid fade-card my-3" style="height:auto;">
        <div class="row">
            <div class="col-sm-12 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6>Aktivitas Harian Pegawai</h6>
                        <div class="container">
                            <hr>
                            <table class="table">
                                <tr>
                                    <td>Nama</td>
                                    <td>{{$dataOfficer->firstname}}</td>
                                </tr>
                                <tr>
                                    <td>NPP</td>
                                    <td>{{@$dataOfficer->npp ?: "Non Organik"}}</td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Pilih Bulan</h6>
                        <select name="mon" id="mon" class="form-control select2 text-bold">
                            @for ($mon=0; $mon < 12; $mon++)
                                <option {{@$_GET['m'] == date('Y-m', strtotime('-'.$mon.' month')) ? "selected" : ""}} value="{{date('Y-m', strtotime('-'.$mon.' month'))}}">
                                    {{date('F Y', strtotime('-'.$mon.' month'))}}
                                </option>
                            @endfor
                        </select>
                        @php
                            $m = date('Y-m-d', strtotime(date('Y-m-1')));
                            if (@$_GET['m']){
                                $m = date('Y-m-1', strtotime(@$_GET['m']));
                            }
                            $startWeekMon = date('W', strtotime($m));
                        @endphp
                        <hr>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @for ($ky = $startWeekMon; $ky < $startWeekMon+5; $ky++)
                            @php
                                $week = @$dataWeekly[$ky];
                            @endphp
                            <div class="accordion-item border rounded">
                                <h2 class="accordion-header" id="flush-heading{{$ky}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$ky}}" aria-expanded="false" aria-controls="flush-collapse{{$ky}}">
                                        <h6>Rencana Minggu ke-{{(int)$ky}}</h6>
                                    </button>
                                </h2>
                                <div id="flush-collapse{{$ky}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$ky}}" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="table-responsive" style="overflow-x: auto">
                                            <table class="table table-striped table-bordered" style="width: 100%">
                                                <thead>
                                                    <th>Rencana</th>
                                                </thead>
                                                <tbody>
                                                    @if (count($dataWeekly) > 0)
                                                    <tr>
                                                        <td class="p-3">{!! $week ? @json_decode(@$week->json_data, true)['rencana'] : "-" !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="table-responsive" style="overflow-x: auto">
                                                                <table class="table table-striped table-bordered" style="width: 100%">
                                                                    <thead>
                                                                        <th width="20%">Tanggal</th>
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
                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td colspan="3" align="center">Belum ada rencana</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            <br>
                            {{-- <div class="accordion-item border rounded">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        <h6>Rencana Harian</h6>
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Accordion Item #3
                                </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                </div>
                            </div> --}}
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
    $(document).ready(function(){
        $('#maintable').dataTable({
            processing: true,
            // serverSide: true,
        });
    });
    </script>
    <script>
        $(document).delegate('#mon','change',function(){
            window.location = '{{url("officer/11?m=")}}'+$(this).val();
        });
        $(document).delegate('.buat-lap','click',function(){
            $('input[name="weekNum"]').val($(this).data('week'));
        });

    </script>

@endpush
