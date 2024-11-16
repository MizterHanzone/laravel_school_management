@extends('admin.layouts')
@section('title', 'Edit Assign Subject')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Assign Subject</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('assign_subject.index') }}">Assign Subject</a></li>
                            <li class="breadcrumb-item active">Edit Assign Subject</li>
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
                                <h3 class="card-title">Edit Assign Subject</h3>
                            </div>
                            <form action="{{ route('assign_subject.update', ['id' => $assign_subjects->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <!-- Class Dropdown -->
                                    <div class="form-group">
                                        <label for="class_id">Class</label>
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option value="" disabled>Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" 
                                                    {{ $assign_subjects->class_id == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('class_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <!-- Subject Checkboxes -->
                                    <div class="form-group">
                                        <select name="subject_id" id="" class="form-control">
                                            <option value="" disabled selected>Select Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{$subject->id}}" {{$assign_subjects->subject_id == $subject->id ? 'selected' : ''}}>
                                                    {{$subject->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('subject_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
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
