<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnoucementController;
use App\Http\Controllers\AssignSubjectToClassController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    // Routes accessible only by guests (not authenticated as admin)
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminController::class, 'index'])->name('admin.login');
        Route::get('register', [AdminController::class, 'register'])->name('admin.register');
        Route::post('authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    });

    // Routes accessible only by authenticated admins
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('form', [AdminController::class, 'form'])->name('admin.form');
        Route::get('table', [AdminController::class, 'table'])->name('admin.table');
        // academic year
        Route::get('academic_year', [AcademicYearController::class, 'index'])->name('academic_year.index');
        Route::get('academic_year/create', [AcademicYearController::class, 'create'])->name('academic_year.create');
        Route::post('academic_year/store', [AcademicYearController::class, 'store'])->name('academic_year.store');
        Route::get('academic_year/edit/{id}', [AcademicYearController::class, 'edit'])->name('academic_year.edit');
        Route::put('academic_year/update', [AcademicYearController::class, 'update'])->name('academic_year.update');
        Route::delete('academic_year/destroy/{id}', [AcademicYearController::class, 'destroy'])->name('academic_year.destroy');
        // class
        Route::get('classes', [ClassesController::class, 'index'])->name('class.index');
        Route::get('class/create', [ClassesController::class, 'create'])->name('class.create');
        Route::post('class/store', [ClassesController::class, 'store'])->name('class.store');
        Route::get('class/edit/{id}', [ClassesController::class, 'edit'])->name('class.edit');
        Route::put('class/update', [ClassesController::class, 'update'])->name('class.update');
        Route::delete('class/destroy/{id}', [ClassesController::class, 'destroy'])->name('class.destroy');
        // fee
        Route::get('fee', [FeeController::class, 'index'])->name('fee.index');
        Route::get('fee/create', [FeeController::class, 'create'])->name('fee.create');
        Route::post('fee/store', [FeeController::class, 'store'])->name('fee.store');
        Route::get('fee/edit/{id}', [FeeController::class, 'edit'])->name('fee.edit');
        Route::put('fee/update', [FeeController::class, 'update'])->name('fee.update');
        Route::delete('fee/destroy/{id}', [FeeController::class, 'destroy'])->name('fee.destroy');
        // fee structure
        Route::get('fee_structure', [FeeStructureController::class, 'index'])->name('fee_structure.index');
        Route::get('fee_structure/create', [FeeStructureController::class, 'create'])->name('fee_structure.create');
        Route::post('fee_structure/store', [FeeStructureController::class, 'store'])->name('fee_structure.store');
        Route::get('fee_structure/edit/{id}', [FeeStructureController::class, 'edit'])->name('fee_structure.edit');
        Route::put('fee_structure/update', [FeeStructureController::class, 'update'])->name('fee_structure.update');
        Route::delete('fee_structure/destroy/{id}', [FeeStructureController::class, 'destroy'])->name('fee_structure.destroy');
        // student
        Route::get('student', [StudentController::class, 'index'])->name('student.index');
        Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
        Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
        Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
        Route::put('student/update/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('student/destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
        // annoucement
        Route::get('annoucement', [AnnoucementController::class, 'index'])->name('annoucement.index');
        Route::get('annoucement/create', [AnnoucementController::class, 'create'])->name('annoucement.create');
        Route::post('annoucement/store', [AnnoucementController::class, 'store'])->name('annoucement.store');
        Route::get('annoucement/edit/{id}', [AnnoucementController::class, 'edit'])->name('annoucement.edit');
        Route::put('/announcements/update', [AnnoucementController::class, 'update'])->name('announcement.update');
        Route::delete('/announcements/destroy/{id}', [AnnoucementController::class, 'destroy'])->name('announcement.destroy');
        // subject
        Route::get('subject', [SubjectController::class, 'index'])->name('subject.index');
        Route::get('subject/create', [SubjectController::class, 'create'])->name('subject.create');
        Route::post('subject/store', [SubjectController::class, 'store'])->name('subject.store');
        Route::get('subject/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
        Route::put('subject/update', [SubjectController::class, 'update'])->name('subject.update');
        Route::delete('subject/destroy/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
        // assign subject to class
        Route::get('assign_subject', [AssignSubjectToClassController::class, 'index'])->name('assign_subject.index');
        Route::get('assign_subject/create', [AssignSubjectToClassController::class, 'create'])->name('assign_subject.create');
        Route::post('assign_subject/store', [AssignSubjectToClassController::class, 'store'])->name('assign_subject.store');
        Route::get('assign_subject/edit/{id}', [AssignSubjectToClassController::class, 'edit'])->name('assign_subject.edit');
        Route::put('assign_subject/update', [AssignSubjectToClassController::class, 'update'])->name('assign_subject.update');
        Route::delete('assign_subject/destroy/{id}', [AssignSubjectToClassController::class, 'destroy'])->name('assign_subject.destroy');
    });
});

Route::group(['prefix' => 'student'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [UserController::class, 'index'])->name('student.login');
        Route::post('auth', [UserController::class, 'auth'])->name('student.auth');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [UserController::class, 'logout'])->name('student.logout');
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('student.dashboard');
        Route::get('change_password', [UserController::class, 'change_password'])->name('student.change_password');
        Route::post('update_password', [UserController::class, 'update_password'])->name('student.update_password');
    });
});