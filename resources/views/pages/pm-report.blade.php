@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <form action="{{url('/reporting/save')}}" id="modalForm" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body" style="height: 80vh;">
                    <div class="container p-2">
                        @csrf
                        <input type="hidden" name="user_id" class="uid" value="{{ Auth::user()->id }}">
                        <div class="page-1 p-4 d-none">
                            <h4><b>Hari ini,</b></h4>
                            <h6><b>rencana</b> saya hari ini adalah...</h6>
                            <label class="text-danger notif-danger"></label>
                            <textarea name="rencana" placeholder="Tuliskan target hari ini" class="form-control plan" id="" cols="30" rows="10"></textarea>
                            <div class="d-flex flex-row justify-content-between my-2">
                                <div></div>
                                <div style="background-color:tomato; border-radius:20px;" class="btn-outline-dark float-right pg2 btn-block p-3 text-white">OK</div>
                            </div>
                        </div>
                        <div class="page-2 p-4">
                            <h4><b>Hari ini,</b></h4>
                            <h6><b>realisasi</b> saya hari ini adalah...</h6>
                            <textarea name="realisasi" placeholder="Tuliskan realisasi hari ini" class="form-control real" id="" cols="30" rows="10"></textarea>
                            <div class="d-flex flex-row justify-content-between my-2">
                                <div></div>
                                <div style="background-color:tomato; border-radius:20px;" class="pg3 btn-outline-dark float-right btn-block p-3 text-white">OK</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    
    <div class="container-fluid fade-card my-3">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="card" style="background-color: #fff">
                    <div class="card-body">
                        <h3>Pelaporan Pegawai</h3>
                        <div class="mt-3">
                            <label>Manajer Proyek</label>
                            <h6 class="">{{Auth::user()->firstname}}</h6>
                        </div>
                        <div class="d-block flex-row">
                            <input type="text" class="form-control my-3 search-input" placeholder="Cari Nama Pegawai">
                        </div>
                        <div class="table-responsive" style="height: 40rem; overflow-y:auto">
                            <table class="table table-striped table-bordered employeeTable">
                                <thead class="sticky-top bg-dark text-white">
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Rencana Hari Ini</th>
                                    <th>Realisasi Hari Ini</th>
                                    <th>Aksi</th>
                                    <th>Daftar</th>
                                </thead>
                                <tbody>
                                    @foreach (@$dataUser as $key => $du)
                                    @php
                                        $recap = DB::table('tb_daily_progress')
                                        ->where('id_user',$du->id)
                                        ->where('date',date('Y-m-d'))
                                        ->first();
                                    @endphp
                                    <tr>
                                        <td style="max-width:1rem;">{{$key+1}}</td>
                                        <td style="max-width:20rem;">{{$du->firstname}}</td>
                                        <td><p class="text-break">{{@json_decode($recap->progress, true)['rencana'] ?: "-"}}</p></td>
                                        <td><p class="text-break">{{@json_decode($recap->progress, true)['realisasi'] ?: "-"}}</p></td>
                                        <td>
                                            @if (@json_decode($recap->progress, true)['realisasi'] && (!@json_decode($recap->progress, true)['ok']))
                                                <div class="btn btn-sm bg-success text-white report-ok" data-id="{{$recap->id}}"><i class="fas fa-thumbs-up"></i>&nbsp;OK!</div>
                                            @elseif((@json_decode($recap->progress, true)['ok']))
                                            OK
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/pm-report/user/'.$du->id)}}" class="btn btn-sm bg-primary text-white"><i class="fas fa-list alt"></i>&nbsp;Daftar Lengkap</a>
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
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.text-break').each(function(){
                var len = 20;
                var txt = $(this).text();
                if (txt.length > len){
                    $(this).text(txt.substring(0,len) + "...");
                }
            });
        });

        $(document).delegate('.buat-lap','click',function(){
            $('.modal-body').find('.page-1').removeClass('d-none').hide().fadeIn(500);
            $('.modal-body').find('.page-2').addClass('d-none');
        });
        $(document).delegate('.buat-lap-2','click',function(){
            $('.modal-body').find('.page-2').removeClass('d-none').hide().fadeIn(500);
            $('.modal-body').find('.page-1').addClass('d-none');
        });

        $(document).delegate('.pg2, .pg3','click',function(){
            var plan = $('.plan').val();
            var real = $('.real').val();
            if (plan || real){
                // saving
                $.ajax({
                    url: "{{url('/reporting/save')}}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: $('#modalForm').serialize(),
                    success: function(data){
                        $('.modal-body').html('<img src="https://media.tenor.com/ogsClPgCYcAAAAAi/mochi-mochi-mochi.gif" width="250" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" />').hide().fadeIn(90);
                        $('.modal-body').find('.page-1').addClass('d-none');
                        setTimeout(function() {
                            $('.modal').modal('hide');
                        }, 2000);
                        setTimeout(function() {
                            window.location.reload();   
                        }, 2500);
                    }
                });
            } else {
                $('.notif-danger').text("Isian tidak boleh kosong");
            }
        });

        $(document).delegate('.report-ok','click',function(){
            // saving
            if (confirm('Yakin akan ceklist?')){
                $.ajax({
                    url: "{{url('/pm-report/reportok')}}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: {
                        'id': $(this).data('id'),
                    },
                    success: function(data){
                        setTimeout(function() {
                            // window.location.reload();   
                        }, 1000);
                    }
                });
            }
        });

        $('.tap-close').click(function(){
            $(this).hide();
        })

        $(".search-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".employeeTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });        
        $('.fade-card').hide().fadeIn(400);        
    </script>
@endpush
