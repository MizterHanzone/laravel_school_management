@extends('admin.layouts')
@section('title', 'Edit Annoucement')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Annoucement</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('annoucement.index')}}">Annoucementr</a></li>
                            <li class="breadcrumb-item active">Edit Annoucement</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Annoucement</h3>
                            </div>
                            <form action="{{route('announcement.update', ['id' => $annoucements->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <input type="text" name="message" class="form-control" id="message"
                                            value="{{ old('message', $annoucements->message) }}">
                                    </div>
                                    @error('message')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            
                                    <div class="form-group">
                                        <label for="type">Sent to</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="" disabled>Select Receiver</option>
                                            <option value="student" {{ old('type', $annoucements->type) == 'student' ? 'selected' : '' }}>Student</option>
                                            <option value="teacher" {{ old('type', $annoucements->type) == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                            <option value="parent" {{ old('type', $annoucements->type) == 'parent' ? 'selected' : '' }}>Parent</option>
                                        </select>
                                    </div>
                                    @error('type')
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
