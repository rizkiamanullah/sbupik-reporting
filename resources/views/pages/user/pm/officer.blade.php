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
            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-bordered table-striped text-dark" style="background-color: #c9ead9">
                                <tr>
                                    <td><h6>Rencana Minggu Ini</h6></td>
                                </tr>
                                <tr>
                                    <td><p class="text-break">{!!@$weekPlan->json_data ? (@json_decode(@$weekPlan->json_data, true)['rencana']) : "-"!!}</p></td>
                                </tr>
                                <tr></tr>
                            </table>
                            <hr>
                            <table class="table table-bordered table-striped text-dark" style="background-color: #dcc1e0">
                                <tr>
                                    <td><h6>Rencana Minggu Depan</h6></td>
                                </tr>
                                <tr>
                                    <td><p class="text-break">{!!@$weekPlanNext->json_data ? (@json_decode(@$weekPlanNext->json_data, true)['rencana']) : "-"!!}</p></td>
                                </tr>
                                <tr></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $m = date('Y-m-d', strtotime(date('Y-m-1')));
                if (@$_GET['m']){
                    $m = date('Y-m-1', strtotime(@$_GET['m']));
                }
            @endphp
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6>Pilih Bulan</h6>
                                <select name="mon" id="mon" class="form-control text-bold h-auto">
                                    @for ($mon=0; $mon < 12; $mon++)
                                        <option {{@$_GET['m'] == date('Y-m', strtotime('-'.$mon.' month')) ? "selected" : ""}} value="{{date('Y-m', strtotime('-'.$mon.' month'))}}">
                                            {{date('F Y', strtotime('-'.$mon.' month'))}}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex flex-row">
                                    <div class="mx-2">
                                        <h6>&nbsp;</h6>
                                        <form action="{{url('rekap/'.$dataOfficer->id.'/'.date('Y/m',strtotime($m)))}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success"><i class="fas fa-file-pdf"></i>&nbsp; Download Bulan Ini</button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <h6>&nbsp;</h6>
                                        <form action="{{url('rekap/'.$dataOfficer->id.'/all')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info"><i class="fas fa-file-pdf"></i>&nbsp; Download All</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @php
                                $startWeek = date('W', strtotime($m));
                            @endphp
                            @for ($ky = 0; $ky < 5; $ky++)
                                <div class="accordion-item border rounded">
                                    <h2 class="accordion-header" id="flush-heading{{$ky}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$ky}}" aria-expanded="false" aria-controls="flush-collapse{{$ky}}">
                                            <h6>Rencana Minggu ke-{{(int)$ky+1}}</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{$ky}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$ky}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="table-responsive" style="overflow-x: auto">
                                                <table class="table table-striped table-bordered w-100" >
                                                    <thead style="background-color: #fdffb6">
                                                        <tr style="background-color:#f2f2f2;">
                                                            <td colspan="3"><h6>Rencana</h6></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"> {!!(@json_decode(@$dataWeekly[$startWeek]->json_data, true)['rencana']) ?: " -"!!} </td>
                                                        </tr>
                                                        <tr><td colspan="3" class="d-none">{!!@json_decode(@$dataWeekly[$startWeek]->json_data, true)['rencana'] ? '<div class="btn btn-success btn-block"><i class="fa fa-check"></i>&nbsp;Dimengerti</div>' : '' !!}</td></tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><h6> Tanggal</h6></td>
                                                            <td><h6> Rencana</h6></td>
                                                            <td><h6> Realisasi</h6></td>
                                                        </tr>
                                                        @if (@$dataDaily[$dataWeekly[$startWeek]->id])
                                                            @foreach (@$dataDaily[$dataWeekly[$startWeek]->id] as $daily)
                                                                <tr>
                                                                    <td> {{ (@json_decode(@$daily->progress, true)["datetime"] ? date('Y-m-d', strtotime($daily->date)) : " -") }} </td>
                                                                    <td> {!! (@json_decode(@$daily->progress, true)["rencana"] ?: " -") !!} </td>
                                                                    <td> {!! (@json_decode(@$daily->progress, true)["realisasi"] ?: " -") !!} </td>
                                                                </tr>
                                                            @endforeach
                                                        <tr><td colspan="3"></td></tr>
                                                        @else
                                                                <tr>
                                                                    <td> -</td>
                                                                    <td> -</td>
                                                                    <td> -</td>
                                                                </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $startWeek += 1;
                                @endphp
                            @endfor
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
        $('.select2').select2();
        $('#maintable').dataTable({
            processing: true,
            // serverSide: true,
        });
    });
    </script>
    <script>
        $(document).delegate('#mon','change',function(){
            window.location = '{{url()->current()}}?m='+$(this).val();
        });
        $(document).delegate('.buat-lap','click',function(){
            $('input[name="weekNum"]').val($(this).data('week'));
        });

    </script>

@endpush
