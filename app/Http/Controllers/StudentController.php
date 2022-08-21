<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $students = DB::table('students')
            ->get();
        return view('students.index', compact('students'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('students.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        Student::create($request->all());
        return redirect()->route('students.index')->with('success','Student created successfully.');
    }

    public function show(Student $student): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('students.show',compact('student'));
    }

    public function edit(Student $student): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('students.edit',compact('student'));
    }

    public function update(Request $request, Student $student): \Illuminate\Http\RedirectResponse
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student): \Illuminate\Http\RedirectResponse
    {
        $student->delete();
        return redirect()->route('students.index')
            ->with('success','Student deleted successfully');
    }
}
