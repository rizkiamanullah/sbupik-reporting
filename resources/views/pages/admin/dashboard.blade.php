@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <form action="{{url('/project/saveProject')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Proyek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                        @csrf
                        <div class="col-sm-12">
                            <label for="">Nama Proyek</label>
                            <input name="nama_proyek" type="text" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="">Manajer Proyek</label>
                            <input type="text" name="nama_manager" value="{{Auth::user()->firstname}}" readonly class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="">Anggota</label>
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
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="d-flex flex-column" style="width:100%;">
                            <div class="d-flex flex-row align-self-center px-5">
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/reporting')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/correct.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pelaporan</p>
                                    </div>
                                </a>
                                {{-- <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/project-management')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/project.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Proyek</p>
                                    </div>
                                </a> --}}
                                {{-- <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/kanban')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/task.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Kanban</p>
                                    </div>
                                </a>
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/my-profile')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/user.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Profil</p>
                                    </div>
                                </a>
                                <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/news')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/newspaper.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Berita</p>
                                    </div>
                                </a> --}}
                                {{-- <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/settings')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/cog.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pengaturan</p>
                                    </div>
                                </a> --}}
                                {{-- <a class="px-4 btn-outline-primary" style="border-color:coral;" href="{{url('/my-message')}}">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" src="{{url('/img/bubble-chat.png')}}" style="width: 80px" alt="">
                                        <p class="align-self-center">Pesan</p>
                                    </div>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 my-2">
                <div class="card">
                    <div class="card-body">Segera Hadir</div>
                </div>
            </div>
            {{-- <div class="col-lg-12 d-none">
                <div class="card" style="background-color: #fff">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="p-2"><h4>My Project</h4></div>
                            @if (Auth::user()->role_id > 1)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="pb-0 btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp;Tambah Proyek</a>
                            @endif
                        </div>
                        <div class="row my-3">
                            @foreach (@$projects as $p)
                            @php
                                $json = json_decode($p->json_details);
                                $anggota = json_decode($json->anggota);
                                foreach ($anggota as $b => $k) {
                                    $ang[$b] = DB::table('users')->where('id',$k)->first();
                                }
                            @endphp
                            <div class="col-sm-4 my-2">
                                <a target="" href="{{route('tasks',['id' => $p->id])}}">
                                    <div class="card" style="background-color: #eeeff3">
                                        <div class="card-body">
                                            <div class="p-0 btn-outline-secondary">
                                                <div class="d-flex flex-row">
                                                    <img src="{{url('/img/infographics.png')}}" alt="" style="width: 80px;">
                                                    <div>
                                                        <h5 class="px-2">{{$p->nama}}</h5>
                                                        <div style="margin-left:20px; color:g" class="d-flex flex-row">
                                                            @foreach ($ang as $a)
                                                            @php
                                                                $colors = ['lightskyblue', 'maroon', 'brown','green','gold','orange','chocolate'];
                                                                $random_color = $colors[rand(0,6)];
                                                            @endphp
                                                                <h6 class="p-3 py-2 text-white" title="{{$a->username}}" style="margin-left:-15px ;background-color:{{$random_color}}; border-radius:90px;">{{strtoupper($a->username[0])}}</h6>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row justify-content-between">
                                                <label class="mt-3" for="">Last updated 2 days ago</label>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        $('.fixed-plugin').addClass('d-none');
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
        });

        $('.fade-card').hide().fadeIn(400);
        // sticky notes functionability
    </script>
@endpush
