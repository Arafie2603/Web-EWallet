@extends('layouts.base')

@section('content')
    

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h5 class="m-1 font-weight-bold text-primary">Form Top Up</h5>
                </div>
                <div class="card-body">
                    <!-- Formulir Mulai Di Sini -->
                    <form>
                        <div class="form-group">
                            <label for="NIK" class="font-weight-bold h6">NIK KTP</label>
                            <input type="number" class="form-control" id="NIK" placeholder="Masukkan NIK">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold h6">Metode Pembayaran:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki">
                                <label class="form-check-label" for="laki_laki">
                                    BRI
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                                <label class="form-check-label" for="perempuan">
                                    Mandiri
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                                <label class="form-check-label" for="perempuan">
                                    BCA
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin" class="font-weight-bold h6">Jenis Kelamin:</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki">Rp. 25.000</option>
                                <option value="Laki-laki">Rp. 50.000</option>
                                <option value="Laki-laki">Rp. 75.000</option>
                                <option value="Laki-laki">Rp. 100.000</option>
                                <option value="Laki-laki">Rp. 200.000</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight-bold h6">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan Password Akun">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <!-- Formulir Selesai Di Sini -->
                </div>
            </div>
        </div>
    </div>
@endsection
