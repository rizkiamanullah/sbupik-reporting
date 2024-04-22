@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Atur Role'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0">
                    <h6>Atur Role</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th> --}}
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="data-body">
                                @foreach ($data as $role)
                                <tr>
                                    <td width="25%">
                                        <div class="d-flex px-3 py-1">
                                            <div>
                                                <img src="./img/tim.png" class="avatar me-3" alt="image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center col-a">
                                                <h6 class="mb-0 text-sm">{{$role->id}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-b" width="25%">
                                        <p class="text-sm font-weight-bold mb-0">{{$role->nama}}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-sm font-weight-bold mb-0">{{date('d/m/Y H:i:s',strtotime($role->created_at))}}</p>
                                    </td>
                                    <td class="align-middle text-end">
                                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                            <p data-id="{{$role->id}}" class="text-sm btn mx-2 edit text-primary font-weight-bold mb-0">Edit</p>
                                            <p data-id="{{$role->id}}" class="text-sm btn mx-2 del text-danger font-weight-bold mb-0">Delete</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="btn btn-md data-add"><i class="fas fa-plus"></i>&nbsp; Tambah</div>
            </div>
        </div>
    </div>
    <script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script>
        // anim
        $('.fade-card').hide().fadeIn(400);
        $(document).delegate('.batal','click',function(){
            window.location.href = "{{url('/role-management')}}";
        });

        $(document).delegate('.data-add','click',function(){
            $(this).hide();
            $('.edit').hide();
            $('.del').hide();
            let tbody = $('.data-body');
            tbody.append(`
                <tr>
                    <td width="25%">
                        <div class="d-flex px-3 py-1">
                            <div>
                                <img src="./img/tim.png" class="avatar me-3" alt="image">
                            </div>
                            <div class="d-flex flex-column justify-content-center col-a">
                            </div>
                        </div>
                    </td>
                    <td class="col-b" width="25%">
                        <input type="text" class="form-control input-b">
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-sm font-weight-bold mb-0">{{date('d/m/Y H:i:s',strtotime($role->created_at))}}</p>
                    </td>
                    <td class="align-middle text-end">
                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                            <p data-id="" role="button" class="text-sm mx-2 batal btn text-danger font-weight-bold mb-0">Batal</p>
                            <p data-id="" class="text-sm btn mx-2 add bg-primary text-white font-weight-bold mb-0">Simpan</p>
                        </div>
                    </td>
                </tr>
            `).hide()
        .fadeIn(200);
        })

        $(document).delegate('.del','click',function(){
            if (confirm('Yakin ingin menghapus?')){
                $.ajax({
                    type: "POST",
                    url: "{{url('/deleteRowData')}}",
                    data: {
                        "id": $(this).data('id'),
                        "type": 'role',
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data){
                        console.log(data);
                        window.location.href = "{{url('/role-management')}}";
                    },
                }).done(function(){});
            }
        })

        $(document).delegate('.add','click',function(){
            let tr = $(this).parent().parent().parent();
            let input_a = tr.find('.input-a').val();
            let input_b = tr.find('.input-b').val();
            let input_c = tr.find('.input-c').val();
            let input_d = tr.find('.input-d').val();
            let id = $(this).data('id');
            console.log(input_a, input_b, id);
            $.ajax({
                type: "POST",
                url: "{{url('/saveRowData')}}",
                data: {
                    "id": $(this).data('id'),
                    "nama": input_b,
                    // "role": input_b,
                    // "email": input_c,
                    // "password": input_d,
                    "type": 'role',
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data){
                    console.log(data);
                    window.location.href = "{{url('/role-management')}}";
                },
            }).done(function(){});
        });

        $(document).delegate('.save','click',function(){
            let tr = $(this).parent().parent().parent();
            let input_a = tr.find('.input-a').val();
            let input_b = tr.find('.input-b').val();
            let input_c = tr.find('.input-c').val();
            let id = $(this).data('id');
            console.log(input_a, input_b, id);
            $.ajax({
                type: "POST",
                url: "{{url('/updateRowData')}}",
                data: {
                    "id": $(this).data('id'),
                    "nama": input_b,
                    // "role": input_b,
                    // "email": input/_c,
                    "type": 'role',
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data){
                    console.log(data);
                    window.location.href = "{{url('/role-management')}}";
                },
            }).done(function(){});
        });

        $(document).delegate('.edit','click',function(){
            let tr = $(this).parent().parent().parent();
            let id = $(this).data('id');
            let a = tr.find('.col-a');
            let b = tr.find('.col-b');
            let c = tr.find('.col-c');
            let a_val = a.find('.text-sm').text();
            let b_val = b.find('.text-sm').text();
            let c_val = c.find('.text-sm').text();
            console.log(a_val,b_val,c_val);
            $('.fade-card').hide().fadeIn(200);
            b.html(`
            <input type="text" placeholder="Masukan nama" name="input-a" class="form-control input-b" value="${b_val}">
            `);
            // c.html(`
            // <input type="text" placeholder="Masukan email" name="input-c" class="form-control input-c" value="${c_val}">
            // `);
            // b.html(`
            // <select required name="input-b" id="" class="form-control input-b">
            //     <option value="99">Admin - 99</option>
            //         @foreach (@$dataRoles as $role)
            //             <option value="{{$role->id}}" ${b_val == '{{$role->id}}' ? 'selected': ''} >{{$role->id}} - {{$role->nama}}</option>
            //         @endforeach
            //     </select>
            //     `);
            $(this).text('Batal').removeClass('edit').addClass('batal');
            $(this).parent().append(`
                <p data-id="${id}" class="text-sm btn mx-2 save btn-primary font-weight-bold mb-0">Simpan</p>
            `);
            $('.edit').hide();
            $('.data-add').hide();
            tr.parent().find('.del').hide();
        })
    </script>
@endsection
