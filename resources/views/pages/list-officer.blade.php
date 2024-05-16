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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h6>List Pegawai</h6>
                        <hr>
                        <div class="table-responsive">
                            <table id="maintable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPP</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($dataUser as $key => $user)
                                        <tr>
                                            <td width="10%">{{$key+1}}</td>
                                            <td>{{@$user->firstname}}</td>
                                            <td>{{@$user->npp}}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm bg-success text-white"><i class="fas fa-cursor"></i>&nbsp;Lihat</a>
                                            </td>
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
    $.noConflict();
    $(document).ready(function(){
        $('#mainTable').dataTable();
    });
    </script>
@endpush
