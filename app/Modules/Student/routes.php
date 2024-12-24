<?php

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

Route::prefix('students')->as('students.')->group(function () {
    Route::get('/', function () {
        $students = Student::all();
        return view('Student::index', [
            'students' => $students,
        ]);
    })->name('index');

    Route::get('/create', function () {
        return view('Student::create');
    })->name('create');

    Route::get('/edit/{id}', function ($id) {
        $student = Student::find($id);
        if(!$student) {
            return redirect()->route('students.index')->with('error', 'Student not found');
        }
        return view('Student::edit', [
            'student' => $student,
        ]);
    })->name('edit');

    // store
    Route::post('/store', function (Request $request) {
        $username = $request->input('username');
        $full_name = $request->input('full_name');
        $class = $request->input('class');
        $dob = $request->input('dob');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $user = User::create([
            'username' => $username,
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
        $user->student()->create([
            'full_name' => $full_name,
            'class' => $class,
            'dob' => $dob,
            'email' => $email,
            'phone' => $phone,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully');
    })->name('store');

    // update
    Route::post('/update/{id}', function (Request $request, $id) {
        $username = $request->input('username');
        $full_name = $request->input('full_name');
        $class = $request->input('class');
        $dob = $request->input('dob');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $user = User::find($id);
        $user->update([
            'username' => $username,
        ]);
        $user->student()->update([
            'full_name' => $full_name,
            'class' => $class,
            'dob' => $dob,
            'email' => $email,
            'phone' => $phone,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    })->name('update');

    // delete
    Route::delete('/delete/{id}', function ($id) {
        $user = User::find($id);
        $user->student()->delete();
        $user->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    })->name('delete');
});