<?php

use App\Imports\StudentImport;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

Route::middleware('auth')->prefix('students')->as('students.')->group(function () {
    // view index
    Route::get('/', function (Request $request) {
        try {
            $username = $request->input('username');
            $full_name = $request->input('full_name');
            $class = $request->input('class');
            $phone = $request->input('phone');
            $students = Student::query();
            if($username) {
                $students = $students->whereHas('user', function($query) use ($username) {
                    $query->where('username', 'like', '%'.$username.'%');
                });
            }
            if($full_name) {
                $students = $students->where('full_name', 'like', '%'.$full_name.'%');
            }
            if($class) {
                $students = $students->where('class', 'like', '%'.$class.'%');
            }
            if($phone) {
                $students = $students->where('phone', 'like', '%'.$phone.'%');
            }
            $students = $students->get();
            $percentages = [0,0,0,0];
            $result = DB::table('results')
                ->selectRaw("
                    COUNT(CASE WHEN score >= 8.5 THEN 1 END) AS excellent,
                    COUNT(CASE WHEN score >= 7.0 AND score < 8.5 THEN 1 END) AS good,
                    COUNT(CASE WHEN score >= 5.0 AND score < 7.0 THEN 1 END) AS average,
                    COUNT(CASE WHEN score < 5.0 THEN 1 END) AS poor,
                    COUNT(*) AS total
                ")
                ->first();
            $percentages = [
                $result->total > 0 ? round(($result->excellent / $result->total) * 100, 2) : 0,
                $result->total > 0 ? round(($result->good / $result->total) * 100, 2) : 0,
                $result->total > 0 ? round(($result->average / $result->total) * 100, 2) : 0,
                $result->total > 0 ? round(($result->poor / $result->total) * 100, 2) : 0,
            ];
            return view('Student::index', [
                'students' => $students,
                'percentages' => $percentages,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'An error occurred while fetching students');
        }
    })->name('index');

    // view create
    Route::get('/create', function () {
        try {
            return view('Student::create');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'An error occurred while loading the create view');
        }
    })->name('create');

    // view detail
    Route::get('/detail/{id}', function ($id) {
        try {
            $student = Student::find($id);
            if(!$student) {
                return redirect()->route('students.index')->with('error', 'Student not found');
            }
            $courses = Course::all();
            $grades = $student->result;
            return view('Student::detail', [
                'student' => $student,
                'courses' => $courses,
                'grades' => $grades,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'An error occurred while loading the detail view');
        }
    })->name('detail');

    // view edit
    Route::get('/edit/{id}', function ($id) {
        try {
            $student = Student::find($id);
            if(!$student) {
                return redirect()->route('students.index')->with('error', 'Student not found');
            }
            return view('Student::edit', [
                'student' => $student,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'An error occurred while loading the edit view');
        }
    })->name('edit');

    // store
    Route::post('/store', function (Request $request) {
        try {
            $username = $request->input('username');
            $full_name = $request->input('full_name');
            $class = $request->input('class');
            $dob = $request->input('dob');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $user = User::create([
                'username' => $username,
                'password' => Hash::make('123@123'),
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
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'An error occurred while creating the student');
        }
    })->name('store');

    // update
    Route::put('/update/{id}', function (Request $request, $id) {
        try {
            $username = $request->input('username');
            $full_name = $request->input('full_name');
            $class = $request->input('class');
            $dob = $request->input('dob');
            $email = $request->input('email');
            $phone = $request->input('phone');

            // check student
            $student = Student::find($id);
            if(!$student) {
                return redirect()->route('students.index')->with('error', 'Student not found');
            }

            // get user
            $user = $student->user;

            // check username
            $checkUser = User::where('username', $username)->where('id', '!=', $user->id)->first();
            if($checkUser) {
                return redirect()->route('students.edit', ['id' => $id])->with('error', 'Username is exist');
            }

            // if username is different then update
            if($username != $user->username) {
                $user->update([
                    'username' => $username,
                ]);
            }

            // update student
            $user->student()->update([
                'full_name' => $full_name,
                'class' => $class,
                'dob' => $dob,
                'email' => $email,
                'phone' => $phone,
            ]);
            return redirect()->route('students.index')->with('success', 'Student updated successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'An error occurred while updating the student');
        }
    })->name('update');

    // delete
    Route::delete('/delete/{id}', function ($id) {
        try {
            $student = Student::find($id);
            if(!$student) {
                return redirect()->route('students.index')->with('error', 'Student not found');
            }
            $student->user->forceDelete();
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'An error occurred while deleting the student');
        }
    })->name('delete');

    // import from excel
    Route::post('/import', function (Request $request) {
        try {
            DB::beginTransaction();
            $file = $request->file('file');
            if (!$file) {
                return redirect()->route('students.index')->with('error', 'You must choose a file to import');
            }
            $import = new StudentImport();
            Excel::import($import, $file);
            $duplicateUsername = $import->getDuplicateUsername();
            $duplicateEmail = $import->getDuplicateEmail();
            DB::commit();
            $message = 'Import successfully';
            if($duplicateUsername > 0) {
                $message .= '. Duplicate username: ' . $duplicateUsername;
            }
            if($duplicateEmail > 0) {
                $message .= '. Duplicate email: ' . $duplicateEmail;
            }
            return redirect()->route('students.index')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'Import failed');
        }
    })->name('import');

    // export to pdf view
    Route::get('/export', function () {
        try {
            $students = Student::all();
            $pdf = Pdf::loadView('pdf.student', ['students' => $students]);
            return $pdf->stream('students.pdf');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'An error occurred while exporting students to PDF');
        }
    })->name('export');

    // add score to student
    Route::post('/add-score/{id}', function (Request $request, $id) {
        try {
            $course_id = $request->input('course_id');
            $score = $request->input('score');
            $student = Student::find($id);
            if(!$student) {
                return redirect()->route('students.index')->with('error', 'Student not found');
            }
            $student->result()->create([
                'course_id' => $course_id,
                'score' => $score,
            ]);
            return redirect()->route('students.detail', ['id' => $id])->with('success', 'Score added successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.detail', ['id' => $id])->with('error', 'An error occurred while adding score');
        }
    })->name('add-score');
});