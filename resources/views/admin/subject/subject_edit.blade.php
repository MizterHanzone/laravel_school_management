@extends('admin.layouts')
@section('title', 'Edit Subject')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subject</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('subject.index')}}">Subject</a></li>
                            <li class="breadcrumb-item active">Edit Subject</li>
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
                                <h3 class="card-title">Edit Subject</h3>
                            </div>
                            <form action="{{route('subject.update', ['id' => $subject->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="subjectName">Subject</label>
                                        <input type="text" name="name" class="form-control" id="subjectName"
                                            placeholder="Enter subject name" value="{{ $subject->name }}">
                                    </div>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                
                                    <div class="form-group">
                                        <label for="subjectType">Type</label>
                                        <select name="type" id="subjectType" class="form-control">
                                            <option value="" disabled>Select Type</option>
                                            <option value="practicle" {{ $subject->type == 'practicle' ? 'selected' : '' }}>Practicle</option>
                                            <option value="theory" {{ $subject->type == 'theory' ? 'selected' : '' }}>Theory</option>
                                        </select>                                        
                                    </div>
                                    @error('type')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
@section('scripts')
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endsection
