@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <style>
        td {
        white-space: nowrap !important; 
        word-wrap: break-word;  
        }
        table {
        table-layout:auto;
        }
    </style>

    <!-- Modal -->
    {{-- Modal Rencana --}}
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form id="formRencanaMingguan" method="POST">
                @csrf
                <div class="modal-content">
                <div class="modal-header" style="background-color: #679186">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Rencana Mingguan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 justify-content-center">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td width="15%">
                                            <h6 for="input_minggu_ke">Minggu Ke- <span style="color: red">*</span></h6>
                                        </td>
                                        <td width="45%">
                                            <select name="input_minggu_ke" id="input_minggu_ke" class="form-control">
                                                @for ($y = date('W'); $y <= date('W'); $y++)
                                                <option value="{{$y}}">{{$y}}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td width="20%">
                                            <select name="input_tahun_ke" id="input_tahun_ke" class="form-control">
                                                @for ($y = 2024; $y <= date('Y'); $y++)
                                                <option value="{{$y}}">{{$y}}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Nama Atasan</h6></td>
                                        <td colspan="2"><input type="text" readonly value="Hendro Purwono" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td><h6>Organisasi Atasan</h6></td>
                                        <td colspan="2"><input type="text" readonly value="Bagian Fasilitasi Perdagangan" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">
                                            <div class="form-group form-check">
                                                <input type="checkbox" name="input_terdapat_cuti" class="form-check-input cuti" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Ada Rencana Cuti pada Minggu Ini</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped" style="width:100%">
                                    <tbody>
                                        <tr style="background-color: #f2f2f2">
                                            <td width="15%"><h6>Rencana <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td width="100%">
                                                <textarea name="input_rencana[]" cols="5" rows="10" class="form-control summernote"></textarea>
                                            </td>
                                        </tr>
                                        <tr style="background-color: #f2f2f2">
                                            <td><h6>Output <span style="color: red;">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="input_output_rencana[]" cols="5" rows="10" class="form-control summernote"></textarea>
                                            </td>
                                        </tr>
                                        <tr><td></td></tr>
                                    </tbody>
                                </table>                        
                            </div>
                            <div class="form-group form-check">
                                <input checked type="checkbox" name="input_rencana_sebagai_draft" class="form-check-input cuti" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Simpan sebagai draft</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12 my-3">

                {{-- <div class="card">
                    <div class="card-body">
                        <h6 class="">Filter Rencana Pegawai</h6>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="minggu_ke" id="minggu_ke" class="form-control select2">
                                                    @for ($w = 1; $w <= 52; $w++)
                                                    <option {{$w == date('W') ? 'selected' : ''}} value="{{$w}}">Minggu ke-{{$w}}</option>
                                                    @endfor
                                                </select>
                                            </td>
                                            <td>
                                                <select name="tahun_ke" id="tahun_ke" class="form-control select2">
                                                    @for ($y = 2024; $y <= date('Y'); $y++)
                                                    <option value="{{$y}}">{{$y}}</option>
                                                    @endfor
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="card my-2">
                    <div class="card-header" style="background-color: #264e70">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class="text-white">Daftar Rencana Pegawai</h6>
                            <div class="">
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
                                        <td>{{$x+1}}</td>
                                        <td class="text-center"><b>{{$dm->weekNum}}</b> <br> ({{$week_start .' - '. $week_end}}) </td>
                                        <td>{{Auth::user()->firstname}}</td>
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
                                        <td>{{  @json_decode($dm->json_data)->komentar[0]}}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />        
<script>
    $('.fade-card').hide().fadeIn(400); 

    $(document).ready(function(){
        $('#rencanaMingguan').DataTable();
    });

    // submit
    $('#formRencanaMingguan').on('submit',function(e){
        e.preventDefault();
        var serialized = $(this).serializeArray();

        $.ajax({
            url: "{{url('reporting/saveRencanaMingguan/'.Auth::user()->id)}}",
            method: "POST",
            data: serialized,
            success: function(data){
                swalFire(data.status, data.msg);
                $('#exampleModalLong').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                if (data.status == "success"){
                    location.reload();
                }
            },
        })
    });

    // other
    $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function () {
            $('.summernote').summernote({
                theme: 'monokai',
                // width: 150,
                height: 200,
            });
    });    

    $('.modalTambah').click(function(){

    })
</script>
@endpush
