@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('header')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Berita & Pengumuman'])
    
    {{-- modal --}}
    <div class="modal fade" style="height: 100vh" id="exampleModal" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <form action="{{url('/storeNews')}}" method="post" id="input-form" enctype="multipart/form-data">
                            @csrf
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6>Foto/ Gambar Header</h6>
                                            <input accept="image/*" type="file" class="form-control">
                                            <hr>
                                            <h6>Judul</h6>
                                            <input type="text" name="judul_berita" class="form-control judul-berita">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            <h6>Isi Berita</h6>
                                            <input type="hidden" name="type">
                                            <textarea id="summernote" class="editor" rows="20" name="editordata"></textarea>
                                            <button class="btn btn-sm bg-primary text-white mt-2 komentar-add"><i class="fas fa-save"></i>&nbsp;Simpan</Button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" style="height: 100vh" id="exampleModal1" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title text-dark" id="exampleModalLabel"></h5>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <form action="{{url('/storeNews')}}" method="post" id="input-form" enctype="multipart/form-data">
                            @csrf
                            <table class="table edit-table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="inn mb-2">                                                
                                            </div>
                                            <div class="btn btn-md bg-success text-white edit-button">Edit</div>
                                            <div class="btn btn-md bg-danger text-white archive">Hapus & Arsipkan</div>
                                            <h2 class="title-view"></h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="detail-view">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" class="this_id" name="id" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}
    
    <div class="row mt-4 mx-4">
        <div class="col-6">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-warning ">
                    <h3 class="text-white">Berita</h3>
                </div>
                <div class="card-body p-2" style="background-color: #fff">
                    <div class="table-responsive" style="overflow-y:auto; height:auto">
                        <table class="table">
                            @foreach ($news as $n)
                            @php
                                $n->archived = @json_decode($n->json_details,true)['archived'];
                            @endphp
                            <tr>
                                <td>
                                    <div class="card berita" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-id="{{$n->id}}" role="button">
                                        <div class="card-body">
                                            <h4>{{$n->title}}</h4>
                                            <p>{{date('d/m/Y', strtotime($n->created_at))}} oleh {{$n->created_by}}</p>
                                            <b style="color:red">
                                                {{(@$n->archived == 1) ? "TERARSIP" : ""}}
                                            </b>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-block btn-left" data-bs-toggle="modal" data-bs-target="#exampleModal" data-title="Tambah Berita"><i class="fas fa-plus"></i>&nbsp; Tambah Berita</button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-success">
                    <h3 class="text-white">Pengumuman</h3>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive" style="overflow-y:auto; height:auto">
                        <table class="table">
                            @foreach ($announ as $a)
                            <tr>
                                <td>
                                    <div class="card pengumuman" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-id="{{$a->id}}" data-title="Detail Berita" role="button">
                                        <div class="card-body">
                                            <h4>{{$a->title}}</h4>
                                            <p>{{date('d/m/Y', strtotime($a->created_at))}} oleh {{$a->created_by}}</p>
                                            <b style="color:red">
                                                {{(@$n->archived == 1) ? "TERARSIP" : ""}}
                                            </b>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div data-bs-toggle="modal" data-bs-target="#exampleModal" data-title="Tambah Pengumuman" class="btn btn-block btn-right"><i class="fas fa-plus"></i>&nbsp; Tambah Pengumuman</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $('.fade-card').hide().fadeIn(400);
        $(document).ready(function() {
            $('.editor').summernote({
                height: 200,
                focus: true
            });
        });

        $(document).delegate('.edit-button','click', function(){
            let title = $('.title-view').text();
            let main = $('.detail-view').text();
            let id = $('.this_id').val();
            $(this).hide(); $('.archive').hide();
            $('.inn').hide().html(`
                <h6>Judul</h6>
                <input type="text" value="${title}" name="judul_berita" class="form-control my-2 judul-berita">
                <textarea id="summernote" class="editor" rows="20" name="editordata">${main}</textarea>
                <button class="btn btn-sm bg-primary text-white mt-2 komentar-add"><i class="fas fa-save"></i>&nbsp;Simpan</Button>
                <input type="hidden" name="type" value="update">
                <a role="button" class="mx-2 mt-2 batal-btn" data-bs-dismiss="modal" style="color: steelblue" aria-label="Close">batal</a>
            `).fadeIn(400);
            $('.editor').summernote({
                height: 200,
                focus: true
            });
        })

        $(document).delegate('.archive','click', function(){
            $.ajax({
                type: "POST",
                url: "{{url('/archiveNews')}}",
                data: {
                    "id": $('.this_id').val(),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data){
                    console.log(data);
                    window.location.reload();
                },
            }).done(function(){});
        })

        $(document).delegate('.batal-btn','click',function(){
            window.location.reload();
        })

        $(document).delegate('.berita','click',function(){
            $('.modal-header').css('background-color','white');
            $.ajax({
                type: "GET",
                url: "{{url('/fetchNews')}}",
                data: {
                    "id": $(this).data('id'),
                },
                success: function(data){
                    data = JSON.parse(data);
                    $('.modal-title').text("Upload oleh "+ data.created_by+" pada "+data.created_at);
                    $('.title-view').text((data.title));
                    $('.detail-view').html((data.message));
                    $('.this_id').val(data.id);
                },
            }).done(function(){});
        });

        $(document).delegate('.pengumuman','click',function(){
            $('.modal-header').css('background-color','white');
            $.ajax({
                type: "GET",
                url: "{{url('/fetchNews')}}",
                data: {
                    "id": $(this).data('id'),
                },
                success: function(data){
                    data = JSON.parse(data);
                    $('.modal-title').text("Upload oleh "+ data.created_by+" pada "+data.created_at);
                    $('.title-view').text((data.title));
                    $('.detail-view').html((data.message));
                    $('.this_id').val(data.id);
                },
            }).done(function(){});
        });

        $(document).delegate('.btn-left','click',function(){
            $('.modal-header').css('background-color','lightgreen');
            $('.modal-title').text($(this).data('title'));
            $('input[name="type"]').val(1);
        });
        $(document).delegate('.btn-right','click',function(){
            $('.modal-header').css('background-color','lightblue');
            $('.modal-title').text($(this).data('title'));
            $('input[name="type"]').val(2);
        });
    </script>
@endsection
