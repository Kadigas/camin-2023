@extends('master')
@section('content')
    <h1>Daftar Camin 2023</h1>
    <div class="row mx-5 justify-content-center">
        @foreach ($camins as $item)
            <div class="card mx-3" style="width: 20rem;">
                <div class="card-body d-flex flex-column align-items-center">
                    <h4 class="my-3">Camin {{$item->id}}</h4>
                    <i class='fas fa-id-badge' style='font-size:180px'></i>
                    <div class="data my-3">
                        <h5>Nama: {{$item->nama}}</h5>
                        <h5>Angkatan: {{$item->angkatan->nama}}</h5>
                    </div>
                    <a href="/camin/{{$item->id}}" class="btn btn-sm btn-info">Details</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex mx-5 my-5 justify-content-center">
        <a href="/camin/create" class="btn btn-primary mx-5" style="max-width: 18rem;">+Add Camin</a>
    </div>
@endsection