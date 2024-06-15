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
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12 my-3">

                <div class="card my-2">
                    <div class="card-header" style="background-color: #ffb4ac">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class="text-dark">Realisasi Mingguan</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/reporting/saveRealisasiMingguan/'.$id_weekly)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
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
                                    <table class="table table-striped">
                                        <tr>
                                            <td><h6>Rencana Mingguan <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea required name="input_rencana" id="" cols="30" rows="10" class="form-control summernote">{!! json_decode($exist->json_data)->input_rencana[0] !!}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Output <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea required name="input_output_rencana" id="" cols="30" rows="10" class="form-control summernote">{!! json_decode($exist->json_data)->input_output_rencana[0] !!}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Realisasi <span style="color: red">*</span></h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea required name="input_realisasi" id="input_realisasi" cols="30" rows="10" class="form-control summernote">{!!@json_decode($exist->json_data)->input_realisasi[0]!!}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>Upload</h6></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input accept=".pdf, .jpg, .png, .xlsx, .xls" type="file" style="height: auto;" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div class="btn btn-sm bg-primary text-white">Reset Upload</div></td>
                                        </tr>
                                    </table>
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
