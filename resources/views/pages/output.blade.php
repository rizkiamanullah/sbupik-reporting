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
            <form id="formRencanaHarian" enctype="multipart/form-data" action="{{url('reporting/saveRencanaHarian/'.Auth::user()->id)}}" method="POST">
                @csrf
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
                                            <td width="%">
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
                                            <td id="files_td"></td>
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
                    <button type="submit" class="btn btn-primary {{Auth::user()->roles_id == 1 ? "" : "d-none"}}">Simpan</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end Modal Rencana --}}
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12 my-3">

                <div class="card my-2">
                    <div class="card-header" style="background-color: #ffb4ac">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class="text-dark">Realisasi Mingguan</h6>
                        </div>
                    </div>
                    <div class="card-body pr-1">

                        @if (Auth::user()->user_role_id > 1)
                        
                        <div class="p-1">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table" style="width: 100%;">

                                        @if (Auth::user()->user_role_id > 1)

                                            <tr>
                                                <td width="15%">
                                                    <h6>Pembuat</h6>
                                                </td>
                                                <td>
                                                    <input type="text" readonly value="{{$officer->firstname}}" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h6>Proyek</h6></td>
                                                <td>
                                                    <input type="text" readonly value="Verifikasi Pencairan Dana" class="form-control">
                                                </td>
                                            </tr>

                                        @else

                                        <tr>
                                            <td width="15%">
                                                <h6>Approver</h6>
                                            </td>
                                            <td>
                                                <input type="text" readonly value="Hendro Purwono" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Organisasi</h6></td>
                                            <td>
                                                <input type="text" readonly value="Bagian Fasilitasi Perdagangan" class="form-control">
                                            </td>
                                        </tr>

                                        @endif

                                    </table>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped" style="width: 100%;">
                                        <tr>
                                            <td><h6>Rencana Mingguan <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {!! json_decode($exist->json_data)->input_rencana[0] !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Output <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {!! json_decode($exist->json_data)->input_output_rencana[0] !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Realisasi <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {!!@json_decode($exist->json_data)->input_realisasi[0]!!}
                                            </td>
                                        </tr>
                                    </table>
                                    @php
                                        $files = @json_decode($exist->json_data)->arr_files;
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
                                </div>
                                <div class="my-3 d-flex flex-row justify-content-between">
                                    <form action="{{url('/reporting/saveRealisasiMingguan/komentar/'.$id_weekly.'/'.$exist->id_user)}}" method="POST">
                                        <div class="">
                                            <div>
                                                @csrf
                                                <table class="table">
                                                    <tr>
                                                        <td><h6>Komentar</h6></td>
                                                    </tr>
                                                    <tr>
                                                        <td><textarea name="komentar" id="komentar" cols="30" rows="10" class="form-control summernote">{!! @json_decode($exist->json_data)->komentar[0] !!}</textarea></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="form-group form-check">
                                                <input checked type="checkbox" name="input_realisasi_sebagai_draft" class="form-check-input cuti" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Sudah sesuai</label>
                                            </div>
                                            <button type="submit" class="float-right btn btn-md bg-primary text-white"><i class="fas fa-thumbs-up"></i>&nbsp; Approve</button>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @else
                            
                        <form action="{{url('/reporting/saveRealisasiMingguan/'.$id_weekly.'/'.$exist->id_user)}}" method="post" enctype="multipart/form-data" id="saveRealisasi">
                            @csrf
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td width="15%">
                                                <h6>Approver</h6>
                                            </td>
                                            <td>
                                                <input type="text" readonly value="Hendro Purwono" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Organisasi</h6></td>
                                            <td>
                                                <input type="text" readonly value="Bagian Fasilitasi Perdagangan" class="form-control">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped" style="width: auto;">
                                        <tr>
                                            <td><h6>Rencana Mingguan <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="input_rencana" id="" cols="30" rows="10" class="form-control summernote">{!! json_decode($exist->json_data)->input_rencana[0] !!}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Output <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="input_output_rencana" id="" cols="30" rows="10" class="form-control summernote">{!! json_decode($exist->json_data)->input_output_rencana[0] !!}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Realisasi <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="input_realisasi" id="input_realisasi" cols="30" rows="10" class="form-control summernote">{!!@json_decode($exist->json_data)->input_realisasi[0]!!}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Upload</h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input multiple name="upload_file[]" accept=".pdf, .jpg, .png, .xlsx, .xls" type="file" style="height: auto;" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div class="btn btn-sm bg-primary text-white">Reset Upload</div></td>
                                        </tr>
                                    </table>
                                    @php
                                        $files = @json_decode($exist->json_data)->arr_files;
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
                                </div>
                                <div class="my-3 d-flex flex-row justify-content-between">
                                    <div class="">
                                        <div class="form-group form-check">
                                            <input checked type="checkbox" name="input_realisasi_sebagai_draft" class="form-check-input cuti" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Simpan sebagai Draft</label>
                                        </div>
                                        <button type="submit" class="float-right btn btn-md bg-primary text-white"><i class="fas fa-save"></i>&nbsp; Simpan</button>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </form>

                        @endif

                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header" style="background-color: #b8e0d2">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class="text-dark">Log Book Harian</h6>
                            <div class="{{Auth::user()->roles_id == 1 ? "" : "d-none"}}">
                                <button style="background-color: #9cadce;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong" class="modalTambah btn btn-md text-white"><i class="fas fa-plus"></i>&nbsp; Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pr-1">
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
        $('.table').DataTable();
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
    $.getScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', function () {
            $('.summernote').summernote({
                theme: 'monokai',
                // width: 30,
                height: 100,
            });
    });    
</script>
@endpush
