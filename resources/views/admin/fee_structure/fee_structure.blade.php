@extends('admin.layouts')
@section('title', 'Fee Structure')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <h1>Fee Structures</h1>
                        {{-- <div class="row"> --}}
                        <form action="{{ route('fee_structure.index') }}" method="GET" class="row">
                            <div class="form-group col-md-3">
                                <label for="class_id">Select Class</label>
                                <select name="class_id" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            @if (request()->class_id == $class->id) selected @endif>
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="academic_id">Select Academic Year</label>
                                <select name="academic_id" class="form-control">
                                    <option value="">Select Academic Year</option>
                                    @foreach ($academic_years as $academic_year)
                                        <option value="{{ $academic_year->id }}"
                                            @if (request()->academic_id == $academic_year->id) selected @endif>
                                            {{ $academic_year->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('academic_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 d-flex align-items-end">
                                <button class="btn btn-success w-100" type="submit">Filter</button>
                            </div>
                            <div class="form-group col-md-2 d-flex align-items-end">
                                <a href="{{ route('fee_structure.index') }}" class="btn btn-danger w-100">Clear</a>
                            </div>
                        </form>
                        {{-- </div> --}}
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Fee Structure</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Fee Structure List</h3>
                                <a href="{{ route('fee_structure.create') }}" class="btn btn-primary"
                                    style="position: absolute; right: 20px;">Add New</a>
                            </div>
                            <div class="card-body">
                                <table id="academicYearTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Class</th>
                                            <th>Fee</th>
                                            <th>Academic Year</th>
                                            <th>January Fee</th>
                                            <th>February Fee</th>
                                            <th>March Fee</th>
                                            <th>April Fee</th>
                                            <th>May Fee</th>
                                            <th>June Fee</th>
                                            <th>July Fee</th>
                                            <th>August Fee</th>
                                            <th>September Fee</th>
                                            <th>October Fee</th>
                                            <th>November Fee</th>
                                            <th>December Fee</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fee_structures as $fee_structure)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $fee_structure->Classes->name }}</td>
                                                <td>{{ $fee_structure->Fee->name }}</td>
                                                <td>{{ $fee_structure->AcademicYear->name }}</td>

                                                <!-- Month columns -->
                                                <td>{{ $fee_structure->january }}</td>
                                                <td>{{ $fee_structure->february }}</td>
                                                <td>{{ $fee_structure->march }}</td>
                                                <td>{{ $fee_structure->april }}</td>
                                                <td>{{ $fee_structure->may }}</td>
                                                <td>{{ $fee_structure->june }}</td>
                                                <td>{{ $fee_structure->july }}</td>
                                                <td>{{ $fee_structure->august }}</td>
                                                <td>{{ $fee_structure->september }}</td>
                                                <td>{{ $fee_structure->october }}</td>
                                                <td>{{ $fee_structure->november }}</td>
                                                <td>{{ $fee_structure->december }}</td>

                                                <td>
                                                    <a class="btn btn-success"
                                                        href="{{ route('fee_structure.edit', ['id' => $fee_structure->id]) }}">Edit</a>
                                                    <form action="{{ route('fee_structure.destroy', $fee_structure->id) }}"
                                                        method="POST" class="d-inline"
                                                        id="delete-form-{{ $fee_structure->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $fee_structure->id }})">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>

    <script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>

    <script>
        $(document).ready(function() {
            $('#academicYearTable').DataTable({
                "paging": true,
                "lengthChange": true, // Allow users to change the number of rows displayed
                "lengthMenu": [
                    [50, 100, 150, 200, -1],
                    [50, 100, 150, 200, "All"]
                ], // The options to show
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#academicYearTable_wrapper .col-md-6:eq(0)');
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
