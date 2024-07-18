@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Proyek'])

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form id="formTambahKegiatan" enctype="multipart/form-data" action="{{url('projects/activities/save').'/'.$projects->id}}" method="POST">
                @csrf
                <div class="modal-content">
                <div class="modal-header" style="background-color: #b382b7">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Aktivitas Baru</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Nama Kegiatan</h6>
                            <input type="text" required name="nama_kegiatan" class="form-control title" placeholder="Nama Kegiatan">
                        </div>
                        <div class="col-sm-6">
                            <h6>Tanggal Mulai</h6>
                            <input type="date" readonly name="mulai_kegiatan" class="form-control start">
                        </div>
                        <div class="col-sm-6">
                            <h6>Tanggal Berakhir</h6>
                            <input type="date" required name="akhir_kegiatan" class="form-control end">
                        </div>
                        <div class="col-sm-6">
                            <h6>Nilai RAB</h6>
                            <input type="text" name="nilai_rab_kegiatan" placeholder="0" class="form-control rab">
                        </div>
                        <div class="col-sm-6">
                            <h6>Bobot Kegiatan</h6>
                            <input type="number" name="bobot_kegiatan" required min="0" max="100" step="1" placeholder="0" class="form-control bobot">
                        </div>
                        <div class="col-sm-12">
                            <h6>Deskripsi Proyek</h6>
                            <textarea name="deskripsi_kegiatan" id="summernote" cols="30" rows="5" class="form-control descr"></textarea>
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

    <div class="container-fluid my-3 fade-card">
        <div class="card">
            <div class="card-header" style="background-color: #679186">
                <label for="" class="text-white">Proyek</label>
                <h5 class="text-white">{{$projects->nama}}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td align="left">
                                    <h6>&nbsp;<b>Klik kalender untuk memulai</b></h6>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="table-responsive">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

<script>
    $('.fade-card').hide().fadeIn(400); 
    
    $(document).ready(function(){
        $('#maintable').DataTable();
        $('.select2').select2({width:'100%', multiple: true});

        // calendar
        $.ajax({
            url: "{{url('/getter/activities').'/'.$projects->id}}",
            method: "GET",
            success: function(res){
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap5',
                    selectable: true,
                    // date when clicked
                    dateClick: function (res){
                        let thisDate = res.dateStr;
                        let split = thisDate.split('-');
                        let Dd = (parseInt(thisDate.split("-")[2])+1);
                        
                        $('.start').val(thisDate);
                        $('.end').val(split[0]+"-"+split[1]+"-"+Dd);
                        $('#summernote').summernote({
                            theme: 'monokai',
                            height: 100,
                        });
                        
                        if ((parseInt(thisDate.split("-")[2])+1) < 10){
                            Dd = "0"+Dd;
                        }
                        
                        $('#exampleModalLong').modal('show');
                    },
                    // selected across date
                    select: function(res){
                        $('.start').val(res.startStr);
                        $('.end').val(res.endStr);
                        $('#summernote').summernote({
                            theme: 'monokai',
                            height: 100,
                        });
                        $('#exampleModalLong').modal('show');
                    },
                    eventClick: function(res){
                        $('.start').val(res.event.startStr);
                        $('.end').val(res.event.endStr);
                        $.ajax({
                            url: "{{url('/getter/event/'.$projects->id)}}?date="+res.event.startStr+"",
                            method: "GET",
                            success: function(data){
                                let json = JSON.parse(data.json_details);
                                $('.title').val(data.nama);
                                $('.rab').val(data.nilai);
                                $('.bobot').val(json.bobot_kegiatan);
                                // $('.descr').val(data.deskripsi);
                                $('#summernote').summernote('code', data.deskrpsi);
                            }
                        })
                        // $('#summernote').summernote({
                        //     theme: 'monokai',
                        //     height: 100,
                        // });
                        $('#exampleModalLong').modal('show');
                    },
                    // event data
                    events: res,
                    eventColor: "#8e6690"
                });
                calendar.render();
            }
        });

    });

    $('#formTambahKegiatan').on('submit', function(){
        return true;
    })

    // other
    $.getScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', function () {
        // $('#summernote').summernote({
        //     theme: 'monokai',
        //     // width: 30,
        //     height: 100,
        // });
    });    
</script>
@endsection
