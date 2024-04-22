@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Dashboard'])
    {{-- modal --}}
    <div class="modal fade" style="height: 100vh" id="exampleModal" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title judul-task text-white" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h6>Deskripsi</h6>
                                        <p class="deskripsi-task"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="3">
                                        <h6>Komentar</h6>
                                        <div class="komentar-task d-flex flex-column mx-2 mb-2">
                                        </div>
                                        <input name="input-komentar" cols="10" placeholder="Tambahkan komentar..." class="form-control komentar-input"></input>
                                        <div class="btn btn-sm bg-secondary text-white mt-2 komentar-add" name="komentar">Simpan</div>
                                        <hr>
                                    </td>
                                    <td>
    
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h6>Pemberi</h6>
                                        <p class="creator-task"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h6>Untuk</h6>
                                        <p class="worker-task">{{Auth::user()->firstname}}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}
    <div class="container-fluid py-4 fade-card">
        <div class="card bg-gray-100" style="height: auto;">
            <div class="card-header pb-1">
                <a href="{{url('/kanban/arsip')}}" class="btn btn-md"><i class="fas fa-save"></i>&nbsp;Arsip</a>
                {{-- <h2>Kanban {{Auth::user()->username}}</h2> --}}
            </div>
            <div class="card-body">
                <div class="row" style="overflow-x: auto">
                    {{-- task --}}
                    @foreach (@$curr_board_db as $a => $board)
                    <div class="col-lg-3 my-2">
                        <div class="card">
                            <div class="card-header py-3" style="margin-bottom: -5vh">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <p class="text-dark"><b>{{$board->title}}</b></p>
                                    </div>
                                </div>
                            </div>
                            @php
                                $this_task_db = $curr_task_db->where('kanban_id', $board->id)->sortByDesc('id')->all();
                            @endphp
                            <div class="card-body kolom-tugas board-{{$a+1}}">
                                <div style="height:auto;">
                                    <div class="div-fade-in"></div>
                                @if (@$this_task_db)
                                @foreach ($this_task_db as $b => $task)
                                    <div class="card my-3">
                                        <div class="card-header {{$task->urgensi == 1 && $task->kanban_id < 2 ? 'bg-success' : ($task->urgensi == 2 && $task->kanban_id < 2 ? 'bg-warning' : ($task->urgensi == 3 && $task->kanban_id < 2 ? 'bg-danger' : 'bg-secondary')) }} p-2 mb-0"></div>
                                        <div class="card-body pb-0 task-body" style="background-color: #fff" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{$task->id}}" role="button">
                                            <small><b>#{{$task->id}}</b></small>
                                            <h6 class="mb-0">{{$task->title}}</h6>
                                            <small class="mb-0">Klik untuk detail</small>
                                        </div>
                                        <div class="card-footer py-1 mb-0">
                                            @if ($a > 0)
                                                @if ($a == count($curr_board_db) - 1)                                                    
                                                    <p role="button" data-id="{{$task->id}}" data-turn="left" class="switch py-1 px-2 btn btn-sm btn-outline-secondary" style="float: left;"><i class="fas fa-arrow-left"></i></p>
                                                    <p role="button" data-id="{{$task->id}}" class="archive py-1 px-2 btn btn-sm btn-outline-secondary" style="float: right;"><i class="fas fa-save"></i>&nbsp;Arsip</p>
                                                @else
                                                    <p role="button" data-id="{{$task->id}}" data-turn="right" class="switch py-1 px-2 btn btn-sm btn-outline-secondary" style="float: right;"><i class="fas fa-arrow-right"></i></p>
                                                    <p role="button" data-id="{{$task->id}}" data-turn="left" class="switch py-1 px-2 btn btn-sm btn-outline-secondary" style="float: left;"><i class="fas fa-arrow-left"></i></p>
                                                @endif
                                            @else
                                                <p role="button" data-id="{{$task->id}}" data-turn="right" class="switch py-1 px-2 btn btn-sm btn-outline-secondary" style="float: right;"><i class="fas fa-arrow-right"></i></p>
                                            @endif
                                        </div>
                                    </div> 
                                @endforeach
                                @endif
                                <div class="div-fade-new"></div>
                                </div>
                            </div>
                            <div class="card-footer footer-board" data-kanbanid="{{$a+1}}">
                                <button type="button" class="btn btn-block btn-tambah">
                                    <i class="fas fa-plus"></i>&nbsp; Tambah Kartu
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
    <script>
        $('.fade-card').hide().fadeIn(400);

        $('.div-hide').hide();
        // functions
        function fetchMessage(id){
            $.ajax({
                type: "GET",
                url: "{{url('/getKomentarTask')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function(d){
                    let field = ``;
                    let dat = JSON.parse(d);
                    let json = JSON.parse(dat.json_details);
                    if (json){
                        json['comments'].map(function(v,i){
                            field += `
                                <div>
                                    <small><b>${v.sender}</b> - ${v.time_sent}</small>
                                    <p>${v.message}</p>
                                </div>
                            `;
                        })
                        $('.komentar-task').html(field);
                        $('.komentar-input').val('');
                    }
                },
            }).done(function(){});
        }
    </script>
    <script>
        // card button functionability
        $(document).delegate('button[class*="btn-tambah"]','click',function(){
            var this_footer = $(this).parent();
            $(this).hide();
            this_footer.append(`
                <div id="form-create-task">
                    <div class="card">
                        <div class="card-body p-3">
                            <input type="text" required name="title" placeholder="Judul" class="form-control mb-1">
                            <textarea name="deskripsi" placeholder="Tambah Deskripsi (opsional)" id="" cols="5" rows="5" class="form-control"></textarea>
                            <select name="urgensi" id="" class="form-control mt-1">
                                <option value="1">Ringan</option>
                                <option value="2">Sedang</option>
                                <option value="3">Tinggi</option>
                            </select>
                        </div>
                        <div class="card-footer py-2">
                            <div class="row">
                                <div class="col-6">
                                    <div role="button" class="text-secondary batal">batal</div>
                                </div>
                                <div class="col-6">
                                    <div role="button" class="btn btn-sm bg-primary text-white btn-tambah-task" style="float: right">Tambah</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        })

        $(document).delegate(".batal","click",function(){
            let form = $(this).parent().parent().parent().parent().parent().parent();
            let this_footer = form.parent().find('.footer-board');
            form.find('#form-create-task').remove();
            $(this_footer).append(`
                <button type="button" class="btn btn-block btn-tambah1">
                    <i class="fas fa-plus"></i>&nbsp; Tambah Kartu
                </button>
            `);
        })

        $(document).delegate('.btn-tambah-task','click',function(){
            let board_footer = $(this).parent().parent().parent().parent().parent().parent();
            let kanban_id = board_footer.parent().find('.footer-board').data('kanbanid');
            let title = board_footer.find('input[name="title"]').val();
            let deskripsi = board_footer.find('textarea[name="deskripsi"]').val();
            let urgensi = board_footer.find('select[name="urgensi"]').val();
            console.log(kanban_id, title, deskripsi, urgensi);
            $.ajax({
                type: "POST",
                url: "{{url('/saveTask')}}/{{Auth::user()->id}}",
                data: {
                    "kanban_id": kanban_id,
                    "title": title,
                    "deskripsi": deskripsi,
                    "urgensi": urgensi,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data){
                    let dummy = $(`
                        <div class="card my-3 div-switch">
                            <div class="card-header p-2 mb-0" style="background-color: ${urgensi == 1 ? 'bg-success' : (urgensi == 2 ? 'bg-warning' : (urgensi == 3 ? 'bg-danger' : 'bg-secondary')) }"></div>
                            <div class="card-body pb-0 task-body" style="background-color: #fff; height:100px;" role="button">
                            </div>
                            <div class="card-footer py-1 mb-0">
                            </div>
                        </div>
                    `).hide().fadeIn(200);
                    board_footer.parent().find('.div-fade-new').html(dummy);
                    window.location.href = "{{url('/kanban')}}";
                },
            }).done(function(){});
        })

        $(document).delegate('.switch','click',function(){
            let id = $(this).data('id');
            let turn = $(this).data('turn');
            let div = $(this).parent().parent();
            $.ajax({
                type: "POST",
                url: "{{url('/switchTask')}}/{{Auth::user()->id}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                    'turn': turn,
                },
                success: function(data){
                    // console.log(data);
                    if (turn == 'left'){
                        div.animate({
                            left: "-100px",
                            opacity: 0
                        }, 250, function() {
                            div.remove();
                        })
                    }
                    if (turn == 'right'){
                        div.animate({
                            right: "-100px",
                            opacity: 0
                        }, 250, function() {
                            div.remove();
                        })
                    }
                    window.location.href = "{{url('/kanban')}}";
                },
            }).done(function(){});
        })

        $(document).delegate('.archive','click',function(){
            let id = $(this).data('id');
            let div = $(this).parent().parent();
            $.ajax({
                type: "POST",
                url: "{{url('/archiveTask')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function(data){
                    div.animate({
                        top: "-100px",
                        opacity: 0
                    }, 250, function() {
                        div.remove();
                    })
                    window.location.href = "{{url('/kanban')}}";
                },
            }).done(function(){});
        })

        $(document).delegate('.task-body','click',function(){
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{url('/getTaskDetail')}}/{{Auth::user()->id}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function(data,val){
                    data = JSON.parse(data);
                    $('.modal-header').css('background-color', data.urgensi == 1 ? '#2dce89' : (data.urgensi == 2 ? '#fb6340' : (data.urgensi == 3 ? '#f5365c' : 'bg-secondary')));  
                    $('.judul-task').html(data.title);
                    $('.creator-task').html(data.created_by);
                    $('.komentar-add').attr('data-idtask', data.id);
                    $('.deskripsi-task').html(data.deskripsi ? data.deskripsi : "<i>Tidak ada deskripsi ditambahkan</i>");
                    $('.komentar-task').html("");
                    fetchMessage(id);
                },
            }).done(function(){});
        })
        // end card button functionability
    </script>
    <script>
        // modal functionability
        $(document).delegate('.komentar-add','click',function(){
            let id = $(this).data('idtask');
            let input = $(this).parent().find('.komentar-input').val();
            if (input){
                $.ajax({
                    type: "POST",
                    url: "{{url('/saveKomentarTask')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id,
                        'input': input,
                    },
                    success: function(data){
                        // console.log(data);
                        fetchMessage(id);
                    },
                }).done(function(){});
            }
        })
        // end modal functionability
    </script>
    <script>
        // board button function functionability
        // $(document).delegate()
        // end board button function functionability
    </script>
@endsection
