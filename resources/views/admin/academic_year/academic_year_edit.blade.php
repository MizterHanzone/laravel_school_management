@extends('admin.layouts')
@section('title', 'Edit Academic Year')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Academic Year</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('academic_year.index')}}">Academic Year</a></li>
                            <li class="breadcrumb-item active">Edit Academic Year</li>
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
                                <h3 class="card-title">Edit Academic Year</h3>
                            </div>
                            <form action="{{route('academic_year.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <input type="hidden" name="id" value="{{ $academic_year->id }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Academic Year</label>
                                        <input type="name" name="name" class="form-control" id="exampleInputEmail1" value="{{$academic_year->name}}" placeholder="Enter academic year">
                                    </div>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </section>

    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endsection
