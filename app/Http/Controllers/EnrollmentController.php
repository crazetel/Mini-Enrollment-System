<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::all();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        return view('enrollments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'email' => 'required|email',
            'course' => 'required',
        ]);

        Enrollment::create($request->all());

        return redirect()->route('enrollments.index');
    }
}