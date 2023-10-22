@extends('layouts.base')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Profile Card -->
                    <div class="card shadow mb-4">

                        <!-- Card Header -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">

                            <div class="text-center mb-3">
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" width="200px">
                            </div>
                            <form>

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" value="Kelompok 9" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="Kelompok9@example.com" readonly>
                                </div>

                                <div class="form-group">
                                    <label>No. Telepon</label>
                                    <input type="text" class="form-control" value="081234567890" readonly>
                                </div>

                            </form>

                            <!-- Profile Info -->

                            <a href="edit-profile.html" class="btn btn-primary btn-user btn-block">
                                Edit Profile
                            </a>

                        </div>
                    </div>

                </div>
@endsection