@extends('admin.layouts')
@section('title', 'Add Teacher')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('teacher.index') }}">Teacher</a></li>
                            <li class="breadcrumb-item active">Add Teacher</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Teacher</h3>
                            </div>
                            <form action="{{ route('teacher.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-4">
                                            <label for="name">Name</label>
                                            <input type="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Enter password">
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="father_name">Father's Name</label>
                                            <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" placeholder="Enter Father's Name">
                                            @error('father_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="mother_name">Mother's Name</label>
                                            <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name') }}" placeholder="Enter Mother's Name">
                                            @error('mother_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                                            @error('dob')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
