@extends('admin.layouts')
@section('title', 'Edit Fee Structure')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Fee Structure</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('fee_structure.index') }}">Fee Structure</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Fee Structure</li>
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
                                <h3 class="card-title">Edit Fee Structure</h3>
                            </div>

                            <!-- Edit form with the correct action and method -->
                            
                            <form action="{{ route('fee_structure.update', ['id' => $fee_structure->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="row">
                                        <!-- Select Class -->
                                        <div class="form-group col-md-4">
                                            <label for="class_id">Select Class</label>
                                            <select name="class_id" class="form-control" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $fee_structure->class_id == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Select Academic Year -->
                                        <div class="form-group col-md-4">
                                            <label for="academic_id">Select Academic Year</label>
                                            <select name="academic_id" class="form-control" id="academic_id">
                                                <option value="">Select Academic Year</option>
                                                @foreach ($academic_years as $academic_year)
                                                    <option value="{{ $academic_year->id }}"
                                                        {{ $fee_structure->academic_id == $academic_year->id ? 'selected' : '' }}>
                                                        {{ $academic_year->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('academic_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Select Fee -->
                                        <div class="form-group col-md-4">
                                            <label for="fee_id">Select Fee</label>
                                            <select name="fee_id" class="form-control" id="fee_id">
                                                <option value="">Select Fee</option>
                                                @foreach ($fees as $fee)
                                                    <option value="{{ $fee->id }}"
                                                        {{ $fee_structure->fee_id == $fee->id ? 'selected' : '' }}>
                                                        {{ $fee->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('fee_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php
                                            $months = [
                                                'january' => 'January Fee',
                                                'february' => 'February Fee',
                                                'march' => 'March Fee',
                                                'april' => 'April Fee',
                                                'may' => 'May Fee',
                                                'june' => 'June Fee',
                                                'july' => 'July Fee',
                                                'august' => 'August Fee',
                                                'september' => 'September Fee',
                                                'october' => 'October Fee',
                                                'november' => 'November Fee',
                                                'december' => 'December Fee',
                                            ];
                                        @endphp

                                        @foreach ($months as $key => $month)
                                            <div class="form-group col-md-4">
                                                <label for="{{ $key }}">{{ $month }}</label>
                                                <input type="text" name="{{ $key }}" class="form-control"
                                                    id="{{ $key }}" value="{{ old($key, $fee_structure->$key) }}"
                                                    placeholder="Enter {{ $month }}">
                                                @error($key)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @endforeach
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

@section('scripts')
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endsection
