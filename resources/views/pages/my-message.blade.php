@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Berita & Pengumuman'])
    
    {{-- modal --}}
    <div class="modal fade" style="height: 100vh" id="exampleModal" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color:steelblue">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Buat Pesan Baru...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="overflow-y:auto; height:90vh">
                        <table class="table" style="width: 100%">
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>
                                        <div class="d-flex flex-row">
                                            <div>
                                                <img src="./img/tim.png" class="avatar me-3" alt="image">
                                            </div>
                                            <div>
                                                <div class="p-1">
                                                    <h5>{{$d->username}}</h5>
                                                    <i>({{$d->email}})</i>
                                                </div>
                                                <div class="btn btn-md bg-success text-white make-new" data-bs-dismiss="modal" data-type="new" data-id="{{$d->id}}"><i class="fas fa-chat"></i>&nbsp; Buat Pesan</div>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
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
    {{-- end modal --}}
    
    <div class="row mt-4 mx-4">
        <div class="col-sm-12">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-secondary">
                    <h3 class="text-white">Pesan Saya</h3>
                </div>
                <div class="card-body p-2" style="background-color: #fff">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="table-responsive" style="overflow-y:auto; height:auto">
                                <table class="table">
                                    @foreach (@$messages as $m)
                                    <tr>
                                        <td>
                                            <div class="card row-pesan" data-id="{{$m->id}}" data-id1="{{$m->sender_user_id}}" data-id2="{{$m->receiver_user_id}}" data-color="" role="button">
                                                <div class="card-body">
                                                    <div class="d-flex flex-row">
                                                        <div>
                                                            <img src="./img/tim.png" class="avatar me-3" alt="image">
                                                        </div>
                                                        <div>
                                                            <h5 class="name-head">{{DB::table('users')->where('id',$m->receiver_user_id)->first()->firstname}}</h5>
                                                            <div class="last-mess">
                                                                {{-- <p>Ini bagaimana ya, tolong dikondisikan ya. Terima kasih</p> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> 
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-9 chat-card">
                            <div class="card fade-mini">
                                <div class="card-header chat-header" style="background-color:darkcyan">
                                    <div class="d-flex flex-row">
                                        <div class="header-img">
                                            <img src="./img/tim.png" class="avatar me-3" alt="image">
                                        </div>
                                        <h4 class="text-white header-name"></h4>
                                    </div>
                                </div>
                                <div class="card-body" style="height:auto">
                                    <div class="message-div">
                                        {{-- <p>Test</p>
                                        <p>Lorem Ipsum</p> --}}
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex">
                                        <textarea name="kolom_pesan" id="ta_main_pesan" cols="30" rows="1" class="form-control my-2"></textarea>
                                        <div data-type="send" data-id="" class="btn btn-block text-white make-sent mt-3 mx-1 py-2" style="background-color:darkcyan"><i class="fas fa-paper-plane"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-block btn-left" data-bs-toggle="modal" data-bs-target="#exampleModal" data-title="Pesan Baru"><i class="fas fa-plus"></i>&nbsp; Pesan Baru</button>
                </div>
            </div>
        </div>
    </div>
    <script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $('.fade-card').hide().fadeIn(400);
        $('.header-img').hide();
        $('.chat-card').hide();

        $(document).ready(function() {
            $('.editor').summernote({
                height: 200,
                focus: true
            });
        });

        $(document).delegate('.row-pesan', 'click', function(){
            $('.row-pesan').css('background-color','white');
            $('.chat-card').hide().fadeIn(400);
            $('.header-img').show();
            $('.message-div').html('');
            $('.header-name').text($(this).find('.name-head').text());
            $('.make-sent').data('id',$(this).data('id'));
            $(this).css('background-color','lightblue');

            $.ajax({
                type: "GET",
                url: "{{url('/fetchMessages')}}",
                data: {
                    "id": $(this).data('id'),
                },
                success: function(data){
                    let html = ``;
                    data = JSON.parse(data);
                    if (data){
                        data.map((val,idx) => {
                            if (val.message){
                                let message = JSON.parse((val.message));
                                message.map((v,i) => {
                                    html += `<p><b>${v.sender_uname}</b>:  ${v.msg}</p>`;
                                })
                            }
                        })
                        $('.message-div').html(html).hide().fadeIn(300);
                    }
                },
            }).done(function(){});
        })

        $(document).delegate('.make-new','click',function(){
            $.ajax({
                type: "POST",
                url: "{{url('/messaging')}}",
                data: {
                    "receiver_id": $(this).data('id'),
                    "type": $(this).data('type'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data){
                    console.log(data);
                    window.location.reload();
                },
            }).done(function(){});
        });

        $(document).delegate('.make-sent','click',function(){
            // alert('sent');
            let main_id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{url('/messaging')}}",
                data: {
                    "message_id": main_id,
                    "type": $(this).data('type'),
                    "message": $('#ta_main_pesan').val(),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data){
                    $('#ta_main_pesan').val('');
                    $.ajax({
                        type: "GET",
                        url: "{{url('/fetchMessages')}}",
                        data: {
                            "id": main_id,
                        },
                        success: function(data){
                            let html = ``;
                            data = JSON.parse(data);
                            if (data){
                                data.map((val,idx) => {
                                    if (val.message){
                                        let message = JSON.parse((val.message));
                                        message.map((v,i) => {
                                            html += `<p><b>${v.sender_uname}</b>:  ${v.msg}</p>`;
                                        })
                                    }
                                })
                                $('.message-div').html(html).hide().fadeIn(300);
                            }
                        },
                    }).done(function(){});
                },
            }).done(function(){});
        });

    </script>
@endsection
