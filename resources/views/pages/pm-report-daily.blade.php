@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('header')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Nama Pegawai</label>
                                <h5>{{$userData->firstname}}</h5>
                            </div>
                            <div class="col-sm-4">
                                <label for="">NPP</label>
                                <h5>{{@$userData->npp ?: "-"}}</h5>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Status Pegawai</label>
                                <h5>{{($userData->user_role_id == 1) ? "Kontrak Proyek" : (($userData->user_role_id == 2) ? "Manajer Proyek" : "Kabag")}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 my-3">
                <div class="card" style="background-color: #fff">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mainTable" class="table table-bordered table-striped">
                                <thead>
                                    <th><b>No</b></th>
                                    <th><b>Tanggal</b></th>
                                    <th><b>Rencana</b></th>
                                    <th><b>Realisasi</b></th>
                                    <th><b>Aksi</b></th>
                                </thead>
                                <tbody>
                                    @if (@$data && count(@$data) > 0)
                                    @foreach (@$data as $key => $d)
                                        @php
                                            $d_json = json_decode($d->progress, true);
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{date('D, d M Y', strtotime($d->date))}}</td>
                                            <td>{{@$d_json['rencana'] ?: "-"}}</td>
                                            <td>{{@$d_json['realisasi'] ?: "-"}}</td>
                                            <td>
                                            @if (@$d_json['realisasi'] && (!@$d_json['ok']))
                                                <div class="btn btn-sm bg-success text-white" data-id="{{$d->id}}"><i class="fas fa-thumbs-up"></i>&nbsp;OK</div>
                                                @elseif(@$d_json['ok'])
                                                OK
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" align="center"> Belum ada data </td>
                                    </tr>
                                    @endif
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
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#mainTable').dataTable();
        });

        $(document).delegate('.bg-success','click',function(){
            if (confirm('Sudah siap approve?')){
                $.ajax({
                    url: "{{url('pm-report/reportok')}}",
                    data: {
                        "id": $(this).data('id'),
                        "_token": "{{csrf_token()}}",
                    },
                    method: "post",
                    success: function(){
                        window.location.reload();
                    },
                })
            }
        })
    </script>
@endpush
