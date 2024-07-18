@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Proyek'])

    <div class="container-fluid my-3 fade-card">
        <div class="card">
            <div class="card-header bg-secondary">
                <div class="d-flex flex-row justify-content-between">
                    <h6 class="text-white">Ubah Detail Proyek</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{url('/projects/saveEditProject/'.$projects->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Nama Proyek</h6>
                            <input type="text" value="{{$projects->nama}}" name="nama_proyek" class="form-control" placeholder="Nama Proyek">
                        </div>
                        <div class="col-sm-6">
                            <h6>Status</h6>
                            <select name="status_proyek" id="" class="form-control select2" style="width: 100%">
                                <option {{json_decode($projects->json_details, true)['status_proyek'] == "Belum Dimulai" ? "selected" : ""}} value="Belum Dimulai">Belum Dimulai</option>
                                <option {{json_decode($projects->json_details, true)['status_proyek'] == "Sedang Berjalan" ? "selected" : ""}} value="Sedang Berjalan">Sedang Berjalan</option>
                                <option {{json_decode($projects->json_details, true)['status_proyek'] == "Tertahan" ? "selected" : ""}} value="Tertahan">Tertahan</option>
                                <option {{json_decode($projects->json_details, true)['status_proyek'] == "Dibatalkan" ? "selected" : ""}} value="Dibatalkan">Dibatalkan</option>
                                <option {{json_decode($projects->json_details, true)['status_proyek'] == "Selesai" ? "selected" : ""}} value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <h6>Klien</h6>
                            <input type="text" name="klien_proyek" value="{{json_decode($projects->json_details, true)['klien_proyek']}}" placeholder="Nama Klien" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <h6>Nilai Total</h6>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" value="{{$projects->nilai}}" name="total_biaya_proyek" placeholder="0" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                            </div>                        
                        </div>
                        <div class="col-sm-6">
                            <h6>Tanggal Mulai</h6>
                            <input type="date" value="{{json_decode($projects->json_details, true)['tanggal_mulai_proyek']}}" name="tanggal_mulai_proyek" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <h6>Tenggat Waktu</h6>
                            <input type="date" value="{{json_decode($projects->json_details, true)['tenggat_waktu_proyek']}}" name="tenggat_waktu_proyek" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <h6>Anggota Proyek</h6>
                            <div>
                                <ul>
                                    @foreach (json_decode($projects->json_details, true)['anggota_proyek'] as $u)
                                    <li>{{$u}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <select name="anggota_proyek[]" readonly id="" multiple class="form-control select2 ang">
                                @foreach ($users as $user)
                                    <option value="{{$user->firstname}}">{{$user->firstname}}</option>
                                @endforeach
                            </select>
                            <hr>
                            <h6>Deskripsi Proyek</h6>
                            <table class="table">
                                <tr>
                                    <td>
                                        {!!json_decode($projects->json_details, true)['deskripsi_proyek']!!}
                                    </td>
                                </tr>
                            </table>
                            <textarea name="deskripsi_proyek" cols="30" rows="5" class="form-control summernote"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="d-flex flex-col justify-content-end">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<script>
    $('.fade-card').hide().fadeIn(400); 
    
    $(document).ready(function(){
        $('#maintable').DataTable();
        $('.select2').select2({width:'100%'});
        $('.summernote').summernote();
    });

    $(document).delegate('.modalDetail','click', function(){
        let id = $(this).data('id');
        $('.hid').hide();
        $.ajax({
            url: '{{url("/getter/project")}}'+'/'+id,
            method: "GET",
            success: function(data){
                let json = JSON.parse(data.json_details);
                let ang = json.anggota_proyek;
                $('#nama').val(data.nama);
                $('#stat').val(json.status_proyek);
                $('#klien').val(json.klien_proyek);
                $('#nilai').val(data.nilai_real);
                $('#mulai').val(json.tanggal_mulai_proyek);
                $('#tenggat').val(json.tenggat_waktu_proyek);
                $('#anggota').val(ang.forEach(x => x));
                $('#desc').summernote('code',json.deskripsi_proyek);
                $('#desc').summernote('disable');
                $('.hid').show();
            }
        })
    })

    $.getScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', function () {
    });    
</script>
@endsection
