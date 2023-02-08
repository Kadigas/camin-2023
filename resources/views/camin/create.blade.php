@extends('master')
@section('content')
    <h1>Tambah Camin</h1>
    <form action="/camin" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="nama" placeholder="Enter Name">
                            @error('nama')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NRP</label>
                            <input type="text" class="form-control" name="nrp" placeholder="Enter NRP">
                            @error('nrp')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control" name="jurusan" placeholder="Enter Jurusan">
                            @error('jurusan')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
        
                        <div class="form-group">
                            <label>Angkatan</label>
                            <select class="form-select form-control" name="angkatan_id">
                                <option selected value="">-</option>
                                @foreach ($angkatans as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="./" class="btn btn-light"><< Back</a>
                            <button type="submit" class="btn btn-primary" style="border-radius: 3px">
                                <i class="nav-icon fas fa-plus-circle"></i>
                                Add Camin
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection