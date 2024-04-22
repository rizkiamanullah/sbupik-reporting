@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Keuangan Proyek'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-warning">
                    <h6 class="text-white">VPD</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row p-3">
                        <div class="col-sm-12">
                            <div class="btn btn-a btn-md">Realisasi v Penagihan</div>
                            <div class="btn btn-a btn-md">UMK dan PUMK</div>
                            <div class="btn btn-b btn-md bg-primary text-white">Status Penagihan</div>
                            <div class="btn btn-c btn-md">Status Dokumen At Cost</div>
                        </div>
                        <div class="col-sm-12">
                            <div class="container">
                                <table class="table" align="center">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Nilai Tagihan</th>
                                        <th>Status Penagihan</th>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>    
                                                Pihak {{$i}}
                                            </td>
                                            <td>
                                                Rp. {{$i+1}}0.000.000
                                            </td>
                                            <td>
                                                <div class="badge bg-success">Sudah</div>
                                            </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn btn-md data-add"></i>&nbsp; Detail Informasi Keuangan</div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-secondary">
                    <h6 class="text-white">KEMITRAAN</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row p-3">
                        <div class="col-sm-12">
                            <div class="btn btn-a btn-md bg-primary text-white">Realisasi v Penagihan</div>
                            <div class="btn btn-a btn-md">UMK dan PUMK</div>
                            <div class="btn btn-b btn-md ">Status Penagihan</div>
                            <div class="btn btn-c btn-md">Status Dokumen At Cost</div>
                        </div>
                        <div class="col-sm-12">
                            <div class="container">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="col-sm-12">
                                                    <div id="piechart" style="width: 600px; height: 400px;"></div>
                                                </div>
                                            </td>
                                            <td align="left">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>Nilai RAB Project</td>
                                                            <td>Rp. 250.000.000,00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td align="left">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>Total Realisasi Tercapai</td>
                                                            <td>Rp. 250.000.000,00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Penagihan</td>
                                                            <td>Rp. 300.000.000,00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn btn-md data-add"></i>&nbsp; Detail Informasi Keuangan</div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-success">
                    <h6 class="text-white">SARPRAS</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row p-3">
                        <div class="col-sm-12">
                            <div class="btn btn-a btn-md">Realisasi v Penagihan</div>
                            <div class="btn btn-a btn-md">UMK dan PUMK</div>
                            <div class="btn btn-b btn-md ">Status Penagihan</div>
                            <div class="btn btn-c btn-md bg-primary text-white">Status Dokumen At Cost</div>
                        </div>
                        <div class="col-sm-12">
                            <div class="container">
                                <table class="table" align="center">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Nilai Dokumen</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        @for ($i = 6; $i < 60; $i++)
                                        <tr>
                                            <td>    
                                                Dokumen {{$i}}
                                            </td>
                                            <td>
                                                Rp. {{$i+1}}0.000.000
                                            </td>
                                            <td>
                                                <div class="badge bg-success">Sudah</div>
                                            </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn btn-md data-add"></i>&nbsp; Detail Informasi Keuangan</div>
            </div>
        </div>
    </div>
    <script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Work',     11],
        ['Eat',      2],
        ['Commute',  2],
        ['Watch TV', 2],
        ['Sleep',    7]
        ]);

        var options = {
        title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    </script>    
    <script>
        // anim
        $('.fade-card').hide().fadeIn(400);
        $(document).delegate('.batal','click',function(){
            window.location.href = "{{url('/customer-management')}}";
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
                                <input type="text" placeholder="Nama Customer" name="name_add" class="form-control input-a">
                            </div>
                        </div>
                    </td>
                    <td class="col-b" width="25%">
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
                        "type": 'customer',
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data){
                        console.log(data);
                        window.location.href = "{{url('/customer-management')}}";
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
                    "nama": input_a,
                    // "role": input_b,
                    // "email": input_c,
                    // "password": input_d,
                    "type": 'customer',
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data){
                    console.log(data);
                    window.location.href = "{{url('/customer-management')}}";
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
                    "nama": input_a,
                    // "role": input_b,
                    // "email": input/_c,
                    "type": 'customer',
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data){
                    console.log(data);
                    window.location.href = "{{url('/customer-management')}}";
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
            a.html(`
            <input type="text" placeholder="Masukan nama" name="input-a" class="form-control input-a" value="${a_val}">
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
