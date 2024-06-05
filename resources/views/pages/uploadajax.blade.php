@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Proyek'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 fade-card">
                <div class="card-header pb-0 bg-warning">
                    <h6 class="text-white">SMART PSR</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data" id="theform">
                        <input type="text" name="_token" value="{{csrf_token()}}">
                        <input type="file" class="form-control" name="filenya">
                        <br>
                        <button class="btn btn-sm bg-success text-white" type="submit">
                            simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    {{-- donut --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $('#theform').on('submit',function(){
            var a = new FormData(this);
            console.log(a);
            return false;
        })
    </script>
@endsection
