@extends('master')
@section('content')
    <h1>Detail Camin {{$camins->id}}</h1>
    <div class="d-flex justify-content-center my-5">
        <div class="card col-sm-6 mx-3 w-50 p-5 bg-dark text-white">
            <div class="card-body d-flex justify-content-center">
                <i class='fas fa-id-badge' style='font-size:180px' class="mx-5"></i>
                <div class="data m-4 align-items-center">
                    <h5>Nama: {{$camins->nama}}</h5>
                    <h5>NRP: {{$camins->nrp}}</h5>
                    <h5>Jurusan: {{$camins->jurusan}}</h5>
                    <h5>Angkatan: {{$camins->angkatan->nama}}</h5>
                </div>
            </div>
            
            <form action="/camin/{{$camins->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('delete')
                <div class="d-flex justify-content-between">
                    <a href="/camin" class="btn btn-light mt-4 mx-2"><< Back</a>
                    <div class="d-flex justify-content-end">
                        <a href="/camin/{{$camins->id}}/edit" class="btn btn-warning mt-4 mx-2">Edit</a>
                        <input type="submit" class="btn btn-danger mt-4 mx-2" value="Delete">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection