@extends('admin.layouts')
@section('title', 'Subject in Class')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subject in Class</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subject in Class</li>
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
                        <form action="" method="GET" class="row">
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
                                <label for="subject_id">Select Subject</label>
                                <select name="subject_id" class="form-control">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            @if (request()->subject_id == $subject->id) selected @endif>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 d-flex align-items-end">
                                <button class="btn btn-success w-100" type="submit">Filter</button>
                            </div>
                            <div class="form-group col-md-2 d-flex align-items-end">
                                <a href="{{route('assign_subject.index')}}" class="btn btn-danger w-100">Clear</a>
                            </div>
                        </form>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Subject in Class List</h3>
                                <a href="{{ route('assign_subject.create') }}" class="btn btn-primary" style="position: absolute; right: 20px;">Add New</a>
                            </div>
                            <div class="card-body">
                                <table id="academicYearTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Subject Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assign_subjects as $assign_subject)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $assign_subject->id }}</td>
                                                <td>{{ $assign_subject->class->name }}</td>
                                                <td>{{ $assign_subject->subject->name }}</td>
                                                <td>{{ $assign_subject->subject->type }}</td>
                                                <td>
                                                    <a class="btn btn-success" href="{{ route('assign_subject.edit', ['id' => $assign_subject->id]) }}">Edit</a>
                                                    <form action="{{ route('assign_subject.destroy', $assign_subject->id) }}" method="POST"
                                                        class="d-inline" id="delete-form-{{ $assign_subject->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $assign_subject->id }})">Delete</button>
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
