@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="my-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2>Ubah Password</h2>
                    <hr>
                    <div class="p-3">
                        <div class="row">
                            <form action="{{url('/setting/password/save')}}" method="POST" id="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-12">
                                    <div class="my-2">
                                        <h6>Email</h6>
                                        <input type="text" readonly value="{{Auth::user()->email}}" class="form-control">
                                    </div>
                                    <div class="my-2">
                                        <h6>Password</h6>
                                        <input type="password" name="passw" class="form-control">
                                    </div>
                                    <div class="my-2">
                                        <h6>Konfirmasi Password</h6>
                                        <input type="password" name="confirm_passw" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-block bg-primary my-2 text-white"><i class="fas fa-save"></i>&nbsp; Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#form').on('submit',function(){
            let a = $('input[name="passw"]').val();
            let b = $('input[name="confirm_passw"]').val();
            if (a === b){
                return true;
            } else {
                swal.fire({
                    title: "{{ __('Error!') }}",
                    text: "Konfirmasi Password berbeda!",
                    type: "Error"
                });
            }
            return false;
        });
    </script>
@endsection