@extends('layouts.base')
@section('content')
<br>
<div class="container " >
    <div class="card">
        <div class="card-header">
            <h4>Update Profile</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session()->get('success')}}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error')}}
                </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>          
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ url('update_profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ session('name') }}" required id="">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email</label> <!-- Ubah label ini -->
                <input type="email" name="email" class="form-control" value="{{ session('email') }}" required id="">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Gambar Profil</label>
                <input id="image" type="file" name="image" class="form-control">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection