@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tasks'])
    {{-- Modal --}}
    <div class="modal fade" id="staticBd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #f1f3f4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-dark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column modal-view-task w-50">
                            <div class="p-2">
                                <h5 class="task-title">Lorem Ipsum</h5>
                                <div class="label"></div>
                                <hr>
                                <table class="table" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="btn mx-0 p-1 btn-outline-secondary">Progress</div>
                                                <div class="btn mx-0 p-1 btn-outline-secondary" disabled>Detail</div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-marker"></i>&nbsp;Kategori</td>
                                            <td class="cat"></td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-business-time"></i>&nbsp;Pemberi Tugas</td>
                                            <td class="giver"></td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-business-time"></i>&nbsp;Deadline</td>
                                            <td class="deadline"></td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-user"></i>&nbsp;PIC </td>
                                            <td class="pic_name"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fas fa-users"></i>&nbsp;Anggota
                                            </td>
                                            <td>
                                                <div class="d-flex flex-row div-list"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-comment-dots"></i>&nbsp;Deskripsi</td>
                                            <td><p class="text-wrap desc">Lorem ipsum sir dolor amet. Lorem ipsum sir dolor amet. Lorem ipsum sir dolor amet. Lorem ipsum sir dolor amet. Lorem ipsum sir dolor amet.</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex w-50">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Laporan</th>
                                        <th>Catatan</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <form action="{{url('/project/saveDeliverable')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-weight-bold" id="staticBackdropLabel">Tugas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-dark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row p-2">
                            @csrf
                            <input type="hidden" name="project_id" value="{{$data->id}}">
                            <div class="col-sm-12">
                                <input name="nama" type="text" class="form-control br" placeholder="Tugas Baru">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Terakhir Update</label>
                                <input type="date" name="last_update" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Kategori</label>
                                <select name="kategori" id="" class="form-control select2">
                                    <option value="A">Kategori A</option>
                                    <option value="C">Kategori B</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">PIC</label>
                                <select name="pic" id="" class="form-control text-dark select2">
                                    @foreach ($users as $u)
                                        <option value="{{$u->id}}">{{$u->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Label</label>
                                <select name="label" id="" class="form-control select2">
                                    <option value="Opsi A">Opsi A</option>
                                    <option value="Opsi B">Opsi B</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Deadline pada</label>
                                <input type="date" name="deadline" class="form-control">
                            </div>
                            <div class="col-sm-12 my-3">
                                <label for="">Gambar Cover</label>
                                <input type="file" accept="image/*" name="cover_img" class="form-control">
                            </div>
                            <div class="col-sm-12 my-3">
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Deskripsi"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <label for="">Diberikan kepada</label>
                                <div class="table-responsive" style="height:160px; overflow-y:auto; border-size: 1px;">
                                    <table class="table table-striped">
                                        <tbody id="dbody">
                                            <tr>
                                                <td>
                                                    <select name="anggota[]" id="" class="form-control text-dark select2">
                                                        @foreach ($users as $u)
                                                            <option value="{{$u->id}}">{{$u->username}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="my-2 btn btn-sm bg-success add text-white"><i class="fas fa-plus"></i>&nbsp;Tambah Anggota</div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    
    <div class="container-fluid fade-card my-2">
        <div class="row">
            <div class="col-lg-12 my-2">
                <div class="card" style="background-color: #fff">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="p-2"><h4>Kanban {{$data->nama}}</h4></div>
                        </div>
                        <div class="d-flex flex-row justify-content-between mx-auto">
                            <select class="select2 form-control" name="pic_search">
                                @foreach ($users as $s)
                                <option value="{{$s->id}}">{{$s->username}}</option>
                                @endforeach
                            </select>
                            <select class="select2 form-control" name="kategori_search">
                                <option value="">Kategori</option>
                            </select>
                            <select class="select2 form-control" name="label_search">
                                <option value="">Label</option>
                            </select>
                            <input type="text" placeholder="Cari" class="form-control mx-2 h-100">
                            <div data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-md btn-success h-100 w-100"><i class="fas fa-plus"></i>&nbsp;Buat Task</div>
                        </div>
                        <div class="d-flex flex-row w-100" style="overflow-x: auto;">
                            {{-- outer --}}
                            <div class="col-sm-3">
                                <div class="p-3">
                                    <div class="btn btn-block btn-primary align-self-center">TODOS</div>
                                    {{-- inner --}}
                                    <div class="w-100">
                                        @foreach ($deliverables as $dv)
                                        @php
                                            $json = json_decode($dv->json_details);
                                        @endphp
                                        <div class="d-flex flex-column mb-3">
                                            <a href="#" class="this-task" data-id="{{$dv->id}}" data-bs-toggle="modal" data-bs-target="#staticBd">
                                                <div class="card" style="background-color: #eeeff3">
                                                    <div class="card-body">
                                                        <div class="p-0 btn-outline-secondary">
                                                            <span class="badge bg-secondary">{{$json->label}}</span>
                                                            <div class="d-flex flex-row">
                                                                <div>
                                                                    <h5 class="px-2 font-weight-bold">{{$dv->title}}</h5>
                                                                    <div style="margin-left:20px;" class="d-flex flex-row ulist">
                                                                        @foreach (json_decode($json->anggota) as $ang)
                                                                            @php
                                                                                $initial = DB::table('users')->where('id',$ang)->first();
                                                                            @endphp
                                                                            <h6 class="p-2 py-0 text-white" title="{{$initial->username}}" style="margin-left:-10px ;background-color:forestgreen; border-radius:90px;">{{strtoupper($initial->username[0])}}</h6>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-between mt-2">
                                                                <div class="d-flex flex-row">
                                                                    <div class="px-1 pt-1 pb-0 d-flex flex-column" style="border-radius: 10px; background-color:goldenrod">
                                                                        <div class="text-white align-self-center bg-white" style="border-radius:5px;"><b class="text-dark p-1">{{date('d',strtotime($json->deadline))}}</b></div>
                                                                        <div class="text-white font-weight-bold">{{date('M',strtotime($json->deadline))}}</div>
                                                                    </div>
                                                                    <label class="mt-2 font-weight-bold">PIC</label>
                                                                </div>
                                                                <label class="mt-2 font-weight-bold">{{Auth::user()->firstname}}</label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row justify-content-between mt-2">
                                                            <label class="mt-0" for="">Updated: {{$json->deadline}}</label>
                                                        </div>
                                                        <label for="">ID: {{substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 20).$data->id}}</label>
                                                    </div>
                                                </div>
                                            </a>
                                        </div> 
                                        @endforeach
                                    </div>
                                    {{-- inner --}}
                                </div>
                            </div>
                            {{-- outer --}}
                            <div class="col-sm-3">
                                <div class="p-3">
                                    <div class="btn btn-block btn-warning">BACKLOG</div>
                                    {{-- inner --}}
                                    <div class="w-100">
                                    </div>
                                    {{-- inner --}}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="p-3">
                                    <div class="btn btn-block btn-secondary">PROGRESS</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="p-3">
                                    <div class="btn btn-block btn-info">REVIEW</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="p-3">
                                    <div class="btn btn-block btn-success">DONE</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="{{url('./assets/js/plugins/chartjs.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/Gruntfile.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet">
    <script>
        $(document).ready(function(){
            $('.select2').select2({
                theme: "bootstrap4",
                width: '100%',
            });
        });
        $('.select2').css('height','auto');
        $(document).delegate('.br','keyup',function(){
            if ($(this).val()){
                $('#staticBackdropLabel').text($(this).val());
            } else {
                $('#staticBackdropLabel').text('Tugas Baru');
            }
        });

        $(document).delegate('.add','click',function(){
            let html = `
                <tr>
                    <td>
                        <select name="anggota[]" id="" class="form-control text-dark select2">
                            @foreach ($users as $u)
                                <option value="{{$u->id}}">{{$u->username}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            `;
            $('#dbody').append(html);
            $('.select2').select2({
                theme: "bootstrap4",
            });
        });
        $('.navbar-else').hide();
        $('.fade-card').hide().fadeIn(400);

        $(document).delegate('.this-task','click', function(){
            let id = $(this).data('id');
            let modal = $('.modal-view-task');
            $.ajax({
                type: "GET",
                url: "{{url('/project/fetchDeliverable')}}",
                data: {
                    "id": id,
                },
                success: function(res){
                    res = JSON.parse(res)[0];
                    let details = JSON.parse(res.json_details);
                    let anggota = JSON.parse(details.anggota);
                    modal.find('.giver').text(res.created_by);
                    modal.find('.deadline').text(details.deadline);
                    modal.find('.pic_name').text(details.pic);
                    modal.find('.task-title').text(res.nama);
                    modal.find('.desc').text(details.deskripsi);
                    modal.find('.cat').text(details.kategori);
                    modal.find('.label').html(`<span class="badge bg-secondary">${details.label}</span>`);
                }
            });
            modal.find('.div-list').html($(this).find('.ulist').html());
        })
    </script>
@endpush
