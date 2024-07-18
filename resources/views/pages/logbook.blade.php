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
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            @if (Auth::user()->role_id == 1)
            <form id="formRencanaHarian" enctype="multipart/form-data" action="{{url('reporting/saveRencanaHarian/'.Auth::user()->id)}}" method="POST">
                @csrf
            @endif
                <div class="modal-content">
                <div class="modal-header" style="background-color: #679186">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Rencana Harian</h5>
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
                                        <td width="10%">
                                            <h6>Tanggal</h6>
                                        </td>
                                        <td><input type="text" name="date" readonly class="form-control date_t" value="{{date('d/m/Y')}}"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Rencana Mingguan</h6>
                                        </td>
                                        <td>
                                            <table class="table-striped table-bordered table rounded">
                                                <tr>
                                                    <td>
                                                        {!! json_decode($exist->json_data)->input_rencana[0] !!}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="col-sm-12 hid_when_loading">
                            <input type="hidden" name="ids" id="ids" value="">
                            <input type="hidden" name="id_task" id="id_task" value="{{$exist->id}}">
                            <div class="table-responsive">
                                <table class="table table-striped" style="width:100%">
                                    <tbody>
                                        <tr style="background-color: #f2f2f2">
                                            <td width="15%"><h6>Rencana<span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td width="100%">
                                                <textarea name="input_rencana[]" cols="5" rows="10" class="form-control summernote rencana_summernote"></textarea>
                                            </td>
                                        </tr>
                                        <tr style="background-color: #f2f2f2">
                                            <td><h6>Realisasi<span style="color: red;">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="input_output_rencana[]" cols="5" rows="10" class="form-control summernote realisasi_summernote"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Upload</h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input name="upload_file[]" multiple accept=".pdf, .jpg, .png, .xlsx, .xls" type="file" style="height: auto;" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div class="btn btn-sm bg-primary text-white">Reset Upload</div></td>
                                        </tr>
                                        <tr>
                                            <td id="files_td">
                                            </td>
                                        </tr>
                                        <tr><td></td></tr>
                                    </tbody>
                                </table>                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary {{Auth::user()->role_id == 1 ? "" : "d-none"}}">Simpan</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end Modal Rencana --}}
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12 my-3">

                <div class="card my-4">
                    <div class="card-header" style="background-color: #b8e0d2">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class="text-dark">Log Book Harian</h6>
                            <div class="{{Auth::user()->roles_id == 1 ? "" : "d-none"}}">
                                <button style="background-color: #9cadce;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong" class="modalTambah btn btn-md text-white"><i class="fas fa-plus"></i>&nbsp; Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="logBookHarian" style="width: 100%">
                                <thead>
                                    <tr>
                                        <td rowspan="2"><b>No</b></td>
                                        <td rowspan="2"><b>Tanggal</b></td>
                                        <td colspan="2"><b>Rencana</b></td>
                                        <td rowspan="2"><b>Realisasi</b></td>
                                        <td rowspan="2"><b>Docs</b></td>
                                        <td rowspan="2"><b>Action</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Mingguan</b></td>
                                        <td><b>Harian</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        
                                    @endphp
                                    @if (@$dailys)
                                        @foreach ($dailys as $key => $daily)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td> {{ date('d/m/Y',strtotime($daily->date)) }} </td>
                                            <td> {!! json_decode($exist->json_data)->input_rencana[0] !!} </td>
                                            <td> {!! json_decode($daily->progress)->input_rencana[0] !!} </td>
                                            <td> {!! json_decode($daily->progress)->input_realisasi[0] !!} </td>
                                            <td>
                                                @php
                                                    $files = @json_decode($daily->progress)->arr_files;
                                                @endphp
                                                @if (@$files)
                                                    <table class="table table-striped table-bordered">
                                                        @foreach ($files as $file)
                                                        <tr>
                                                            <td><i class="fas fa-file"></i>&nbsp;<a href="{{url('/'.$file)}}">{{explode('/',$file)[2]}}</a></td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                @endif
                                            </td>
                                            <td><div class="btn btn-sm daily-modal" data-ids="{{$daily->id}}" data-bs-toggle="modal" data-bs-target="#exampleModalLong" style="background-color: #ffd6a5;"><i class="fas fa-edit text-black"></i></div></td>
                                        </tr>
                                        @endforeach
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />        
<script>
    $('.fade-card').hide().fadeIn(400); 
    
    $(document).ready(function(){
        $('#logBookHarian').DataTable();
    });

    $('.modalTambah').click(function(){
        $('.hid_when_loading').show();
        $('#ids').val('');
        $('.date_t').val('');
        $('.rencana_summernote').summernote('code','');
        $('.realisasi_summernote').summernote('code','');
        $('#files_td').html('');
    })
    
    $(document).delegate('.daily-modal', 'click', function(){
        $('.hid_when_loading').hide();
        $('#files_td').html('');
        
        let ids = $(this).data('ids');
        $('#ids').val(ids);
        $.ajax({
            url: `{{url('getter/rencanaHarian/${ids}')}}`,
            method: "GET",
            success: function(data){
                if (data){
                    let progress = JSON.parse(data.progress);
                    $('.date_t').val(data.date);
                    $('.rencana_summernote').summernote('code',progress.input_rencana[0]);
                    $('.realisasi_summernote').summernote('code',progress.input_realisasi[0]);
                    $('.hid_when_loading').show();
                    let files = progress.arr_files;
                    let html = `
                    <table class="table table-striped table-bordered">
                    `;

                    files.forEach((val, idx) => {
                        html += `
                            <tr>
                                <td><i class="fas fa-file"></i>&nbsp;<a href="{{url('/${val}')}}">{{explode('/','${val}')[0]}}</a></td>
                            </tr>
                        `;
                    });

                    html += `
                    </table>
                    `;
                    $('#files_td').html(html);
                }
            },
        })
    });

    // submit
    // $('#formRencanaHarian').on('submit',function(e){
    //     e.preventDefault();
    //     var serialized = $(this).serializeArray();

    //     $.ajax({
    //         url: "{{url('reporting/saveRencanaHarian/'.Auth::user()->id)}}",
    //         method: "POST",
    //         data: serialized,
    //         success: function(data){
    //             swalFire(data.status, data.msg);
    //             $('#exampleModalLong').modal('hide');
    //             $('body').removeClass('modal-open');
    //             $('.modal-backdrop').remove();
    //             if (data.status == "success"){
    //                 // location.reload();
    //             }
    //         },
    //     })
    // });

    // other
    $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function () {
            $('.summernote').summernote({
                theme: 'monokai',
                // width: 150,
                height: 200,
            });
    });    
</script>
@endpush
