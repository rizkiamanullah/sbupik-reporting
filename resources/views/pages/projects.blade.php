@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Proyek'])

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form id="formTambahProyek" enctype="multipart/form-data" action="{{url('projects/saveProject')}}" method="POST">
                @csrf
                <div class="modal-content">
                <div class="modal-header" style="background-color: #679186">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Proyek Baru</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Nama Proyek</h6>
                            <input type="text" name="nama_proyek" class="form-control" placeholder="Nama Proyek">
                        </div>
                        <div class="col-sm-6">
                            <h6>Status</h6>
                            <select name="status_proyek" id="" class="form-control select2" style="width: 100%">
                                <option value="Belum Dimulai">Belum Dimulai</option>
                                <option value="Sedang Berjalan">Sedang Berjalan</option>
                                <option value="Tertahan">Tertahan</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <h6>Klien</h6>
                            <input type="text" name="klien_proyek" placeholder="Nama Klien" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <h6>Nilai Total</h6>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" name="total_biaya_proyek" placeholder="0" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                            </div>                        
                        </div>
                        <div class="col-sm-6">
                            <h6>Tanggal Mulai</h6>
                            <input type="date" name="tanggal_mulai_proyek" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <h6>Tenggal Waktu</h6>
                            <input type="date" name="tenggat_waktu_proyek" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <h6>Anggota Proyek</h6>
                            <select name="anggota_proyek[]" readonly id="" multiple class="form-control select2">
                                @foreach ($users as $user)
                                    <option value="{{$user->firstname}}">{{$user->firstname}}</option>
                                @endforeach
                            </select>
                            <hr>
                            <h6>Deskripsi Proyek</h6>
                            <textarea name="deskripsi_proyek" id="summernote" cols="30" rows="5" class="form-control"></textarea>
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

    {{-- readonly --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form id="" enctype="multipart/form-data" action="#" method="POST">
                @csrf
                <div class="modal-content">
                <div class="modal-header" style="background-color: #679186">
                    <h5 class="modal-title text-white" id="exampleModalTitle">Detail Proyek</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row hid">
                        <div class="col-sm-12">
                            <h6>Nama Proyek</h6>
                            <input type="text" readonly id="nama" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <h6>Status</h6>
                            <input type="text" readonly id="stat" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <h6>Klien</h6>
                            <input type="text" readonly id="klien" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <h6>Nilai Total</h6>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" readonly id="nilai" class="form-control">
                            </div>                        
                        </div>
                        <div class="col-sm-6">
                            <h6>Tanggal Mulai</h6>
                            <input type="text" readonly id="mulai" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <h6>Tenggal Waktu</h6>
                            <input type="text" readonly id="tenggat" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <h6>Anggota Proyek</h6>
                            <input type="text" readonly id="anggota" class="form-control">
                            <hr>
                            <h6>Deskripsi Proyek</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td><textarea id="desc" readonly cols="30" rows="10" class="form-control"></textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger hid" data-bs-dismiss="modal"><i class="fas fa-trash"></i>&nbsp; Hapus</button>
                    <a href="" class="btn btn-success href text-white hid"><i class="fas fa-edit"></i>&nbsp;Ubah</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid my-3 fade-card">
        <div class="card">
            <div class="card-header bg-secondary">
                <div class="d-flex flex-row justify-content-between">
                    <h6 class="text-white">Manajemen Proyek</h6>
                    <div class="btn btn-sm bg-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModalLong">Tambah</div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Ringkasan Proyek</h6>
                        @php
                            
                        @endphp
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td><h2>0</h2></td>
                                    <td><h2>0</h2></td>
                                    <td><h2>0</h2></td>
                                    <td><h2>0</h2></td>
                                    <td><h2>0</h2></td>
                                </tr>
                                <tr>
                                    <td>Belum Dimulai</td>
                                    <td>Sedang Berjalan</td>
                                    <td>Tertahan</td>
                                    <td>Dibatalkan</td>
                                    <td>Selesai</td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="maintable">
                                <thead>
                                    <th>No</th>
                                    <th>Nama Proyek</th>
                                    <th>Status</th>
                                    <th>Klien</th>
                                    <th>Tanggal</th>
                                    <th>Tenggat</th>
                                    <th>Anggota Proyek</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $key => $project)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$project->nama}}</td>
                                            <td>{{json_decode($project->json_details, true)['status_proyek']}}</td>
                                            <td>{{json_decode($project->json_details, true)['klien_proyek']}}</td>
                                            <td>{{json_decode($project->json_details, true)['tanggal_mulai_proyek']}}</td>
                                            <td>{{json_decode($project->json_details, true)['tenggat_waktu_proyek']}}</td>
                                            <td>{{json_decode($project->json_details,true)['anggota_proyek'][0].", ..."}}</td>
                                            <td>
                                                <a href="{{url('/projects/monitoring/'.$project->id)}}" class="btn btn-warning"><i class="fa fa-pie-chart"></i>&nbsp;Progress</a>
                                                <br>
                                                <div class="btn btn-primary text-white modalDetail" data-id="{{$project->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-list"></i>&nbsp;Detail</div>
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
    </div>
    
<script>
    $('.fade-card').hide().fadeIn(400); 
    
    $(document).ready(function(){
        $('#maintable').DataTable();
        $('.select2').select2({width:'100%', multiple: true});
    });

    $(document).delegate('.modalDetail','click', function(){
        let id = $(this).data('id');
        $('.hid').hide();
        $.ajax({
            url: '{{url("/getter/project")}}'+'/'+id,
            method: "GET",
            success: function(data){
                let ul = "";
                let json = JSON.parse(data.json_details);
                let ang = json.anggota_proyek;
                ang.forEach((val,idx) => {
                    ul+= val+", ";
                })
                $('#nama').val(data.nama);
                $('#stat').val(json.status_proyek);
                $('#klien').val(json.klien_proyek);
                $('#nilai').val(data.nilai_real);
                $('#mulai').val(json.tanggal_mulai_proyek);
                $('#tenggat').val(json.tenggat_waktu_proyek);
                $('#anggota').val(ul);
                $('#desc').summernote('code',json.deskripsi_proyek);
                $('#desc').summernote('disable');
                $('.href').attr('href',"{{url('/projects/edit').'/'}}"+data.id);
                $('.hid').show();
            }
        })
    })

    // other
    $.getScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', function () {
            $('#summernote').summernote({
                theme: 'monokai',
                // width: 30,
                height: 100,
            });
    });    
</script>
@endsection
