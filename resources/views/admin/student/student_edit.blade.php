@extends('admin.layouts')
@section('title', 'Edit Student')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Student</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Students</a></li>
                            <li class="breadcrumb-item active">Edit Student</li>
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
                                <h3 class="card-title">Edit Student</h3>
                            </div>
                            <form action="{{ route('student.update', $students->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Class ID Field -->
                                        <div class="form-group col-md-4">
                                            <label for="class_id">Class</label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}" 
                                                        @if ($students->class_id == $class->id) selected @endif>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Academic Year Field -->
                                        <div class="form-group col-md-4">
                                            <label for="academic_id">Academic Year</label>
                                            <select name="academic_id" class="form-control">
                                                <option value="">Select Academic Year</option>
                                                @foreach ($academic_years as $academic_year)
                                                    <option value="{{ $academic_year->id }}" 
                                                        @if ($students->academic_id == $academic_year->id) selected @endif>
                                                        {{ $academic_year->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('academic_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Admission Date Field -->
                                        <div class="form-group col-md-4">
                                            <label for="admission_date">Admission Date</label>
                                            <input type="date" name="admission_date" class="form-control" 
                                                value="{{ old('admission_date', $students->admission_date) }}">
                                            @error('admission_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Name Field -->
                                        <div class="form-group col-md-4">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" 
                                                value="{{ old('name', $students->name) }}">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email Field -->
                                        <div class="form-group col-md-4">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" 
                                                value="{{ old('email', $students->email) }}">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Father's Name Field -->
                                        <div class="form-group col-md-4">
                                            <label for="father_name">Father's Name</label>
                                            <input type="text" name="father_name" class="form-control" 
                                                value="{{ old('father_name', $students->father_name) }}">
                                            @error('father_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Mother's Name Field -->
                                        <div class="form-group col-md-4">
                                            <label for="mother_name">Mother's Name</label>
                                            <input type="text" name="mother_name" class="form-control" 
                                                value="{{ old('mother_name', $students->mother_name) }}">
                                            @error('mother_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Date of Birth Field -->
                                        <div class="form-group col-md-4">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" name="dob" class="form-control" 
                                                value="{{ old('dob', $students->dob) }}">
                                            @error('dob')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Phone Field -->
                                        <div class="form-group col-md-4">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" class="form-control" 
                                                value="{{ old('phone', $students->phone) }}">
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
