@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Proyek'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-warning">
                    <h6 class="text-white">SMART PSR</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row p-3">
                        <div class="col-sm-12">
                            <div class="btn btn-c btn-md">Informasi</div>
                            <div class="btn btn-a btn-md">Status Terkini</div>
                            <div class="btn btn-b btn-md bg-primary text-white">Infografis</div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-page-general table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div id="donutchart1" style="width: 40vw; height: 400px;"></div>
                                        </td>
                                        <td>
                                            <div id="curve_chart1" style="width: 40vw; height: 400px"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-page-status table-bordered">
                                <tbody>
                                    <tr>
                                        <td width="30%">
                                            <img src="https://www.bpdp.or.id/uploads/images/image_750x_6470ca19ae16c.jpg" alt="">
                                        </td>
                                        <td align="left">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Nama Proyek</td>
                                                    <td>SMART PSR</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Mulai</td>
                                                    <td>01/01/1970</td>
                                                </tr>
                                                <tr>
                                                    <td>Klien</td>
                                                    <td>BPDPKS</td>
                                                </tr>
                                                <tr>
                                                    <td>Nilai Proyek</td>
                                                    <td>Rp. xxxx</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td align="left">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Nama Proyek</td>
                                                    <td>SMART PSR</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Mulai</td>
                                                    <td>01/01/1970</td>
                                                </tr>
                                                <tr>
                                                    <td>Pekerjaan Pending</td>
                                                    <td>3 / 20</td>
                                                </tr>
                                                <tr>
                                                    <td>Pekerjaan Selesai</td>
                                                    <td>25 / 30</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-page-infograph table-bordered">
                                <tbody>
                                    <tr>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="btn btn-md data-add"></i>&nbsp; Buka Project</div>
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
                            <div class="btn btn-md">Informasi</div>
                            <div class="btn btn-md">Status Terkini</div>
                            <div class="btn btn-md bg-primary text-white">Infografis</div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div id="donutchart0" style="width: 40vw; height: 400px;"></div>
                                        </td>
                                        <td>
                                            <div id="curve_chart0" style="width: 40vw; height: 400px"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="btn btn-md data-add"></i>&nbsp; Buka Project</div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-primary">
                    <h6 class="text-white">SCI Kemitraan</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row p-3">
                        <div class="col-sm-12">
                            <div class="btn btn-md">Informasi</div>
                            <div class="btn btn-md">Status Terkini</div>
                            <div class="btn btn-md bg-primary text-white">Infografis</div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div id="donutchart2" style="width: 40vw; height: 400px;"></div>
                                        </td>
                                        <td>
                                            <div id="curve_chart2" style="width: 40vw; height: 400px"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="btn btn-md data-add"></i>&nbsp; Buka Project</div>
            </div>
        </div>
    </div>
    <script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    {{-- donut --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data = google.visualization.arrayToDataTable([
        ['Milestone', 'Progress per Hari'],
        ['Inisiasi',11],
        ['Perencanaan',2],
        ['Eksekusi',  2],
        ['Monitoring & Kontrol', 7],
        ['Selesai', 2],
        ]);

        var options = {
        title: 'Progress Project',
        pieHole: 0.4,
        };

        var chart0 = new google.visualization.PieChart(document.getElementById('donutchart0'));
        var chart1 = new google.visualization.PieChart(document.getElementById('donutchart1'));
        var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart0.draw(data, options);
        chart1.draw(data, options);
        chart2.draw(data, options);
    }
    </script>   
    <script type="text/javascript">
    // google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
        ['Year', 'Kurva S'],
        ['0', 5],
        ['1', 5],
        ['2', 15],
        ['3', 50],
        ['4', 55],
        ]);

        var options = {
        title: 'Kurva S',
        curveType: 'function',
        legend: { position: 'bottom' }
        };

        var chart0 = new google.visualization.LineChart(document.getElementById('curve_chart0'));
        var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart1'));
        var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart2'));

        chart0.draw(data, options);
        chart1.draw(data, options);
        chart2.draw(data, options);
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
