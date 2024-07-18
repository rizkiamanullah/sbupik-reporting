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

    {{-- {{Session::get()}} --}}
    <div class="container-fluid fade-card my-3" style="height:auto;">
        <div class="row">
            <div class="col-sm-12">

                <div class="card my-2">
                    <div class="card-header" style="background-color: #264e70">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class="text-white">Daftar Rencana Pegawai</h6>
                            <div class="{{Auth::user()->roles_id == 1 ? "" : "d-none"}}">
                                <button style="background-color: #679186" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong" class="modalTambah btn btn-md text-white"><i class="fas fa-plus"></i>&nbsp; Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive w-100">
                            <table class="table table-striped table-bordered" id="rencanaMingguan" style="width: 150%;">
                                <thead>
                                    <tr style="background-color: #fff">
                                        <th class="text-center" rowspan="2">No</th>
                                        <th class="text-center" rowspan="2">Minggu</th>
                                        <th class="text-center" rowspan="2">Pegawai</th>
                                        <th class="text-center" colspan="2">Rencana</th>
                                        <th class="text-center" rowspan="2">Realisasi <br> Output</th>
                                        <th class="text-center" colspan="2">Tanggal Buat</th>
                                        <th class="text-center" colspan="2">Status</th>
                                        <th class="text-center" rowspan="2">Komentar</th>
                                        <th class="text-center" rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Kegiatan</th>
                                        <th>Output</th>
                                        <th>Rencana</th>
                                        <th>Realisasi</th>
                                        <th>Rencana</th>
                                        <th>Realisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataMingguan as $x => $dm)
                                    @php
                                        $week_start = date('d/m/Y', strtotime($dm->year.'-W'.$dm->weekNum.' last sunday'));
                                        $week_end = date('d/m/Y', strtotime($dm->year.'-W'.$dm->weekNum.' next saturday'));
                                    @endphp
                                    <tr>
                                        <td width="8%">{{$x+1}}</td>
                                        <td class="text-center"><b>{{$dm->weekNum}}</b> <br> ({{$week_start .' - '. $week_end}}) </td>
                                        <td>{{DB::table('users')->where('id',$dm->id_user)->first()->firstname}}</td>
                                        @if (@json_decode($dm->json_data)->input_terdapat_cuti)
                                        <td><b>Terdapat Rencana Cuti</b></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        @else
                                        <td>{!! json_decode($dm->json_data)->input_rencana[0] !!}</td>
                                        <td>{!! json_decode($dm->json_data)->input_output_rencana[0] !!}</td>
                                        <td>{!! @json_decode($dm->json_data)->input_realisasi[0] !!}</td>
                                        <td>{{  date('d/m/Y H:i:s', strtotime($dm->date))}}</td>
                                        <td>{{  @json_decode($dm->json_data)->input_realisasi_time[0] ? date('d/m/Y H:i:s', strtotime(@json_decode($dm->json_data)->input_realisasi_time[0])) : ""}}</td>
                                        <td>{{  @json_decode($dm->json_data)->input_rencana_sebagai_draft[0] ? "" : ""}}</td>
                                        <td>{{  @json_decode($dm->json_data)->input_realisasi_sebagai_draft[0] ? "" : ""}}</td>
                                        <td>{!! @json_decode($dm->json_data)->komentar[0] !!}</td>
                                        <td class="text-center">
                                            <a href="{{url('/reporting/output/'.$dm->id.'/'.$dm->id_user)}}" class="btn btn-sm" style="background-color: #ffb4ac"><i class="fas fa-edit text-dark"></i>&nbsp;Detail</a>
                                            <br>
                                            <a href="{{url('/reporting/logbook/'.$dm->id.'/'.$dm->id_user)}}" class="btn btn-sm" style="background-color: #daeaf6"><i class="fas fa-book text-dark"></i>&nbsp;Log Book</a>
                                        </td>
                                        @endif
                                        {{-- <td>Approved -{{date('d/m/Y H:i:s')}} <br>-<b>Hendro Purwono</b></td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $('.fade-card').hide().fadeIn(400); 

        $(document).ready(function(){
            $('#rencanaMingguan').DataTable();
        });
    </script>
@endpush
