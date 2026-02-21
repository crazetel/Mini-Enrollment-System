<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_students'    => User::where('role', 'student')->count(),
            'total_courses'     => Course::count(),
            'total_enrollments' => DB::table('course_user')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers'));
    }

    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course) 
    {
        $students = $course->students()->get();
        return view('courses.show', compact('course', 'students'));
    }

    public function enroll(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = Auth::user();

        // Check if already enrolled
        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        // Check if course is full
        if ($course->students()->count() >= $course->capacity) {
            return back()->with('error', 'This course is full. Please try another course.');
        }

        // Enroll user
        $user->courses()->attach($course->id);
        return back()->with('success', 'Successfully enrolled in ' . $course->course_name . '!');
    }

    public function unenroll($courseId)
    {
        $course = Course::findOrFail($courseId);
        Auth::user()->courses()->detach($courseId);
        return back()->with('success', 'Successfully withdrawn from ' . $course->course_name . '.');
    }

    public function create() 
    { 
        return view('courses.create'); 
    }

    public function store(Request $request) {
    $validated = $request->validate([
        'course_name' => 'required|string|max:255',
        'course_code' => 'required|string|unique:courses',
        'description' => 'required',
        'capacity' => 'required|integer'
    ]);
    Course::create($validated);
    return redirect()->route('courses.index');
}

    // 6. Admin: Edit & Update
    public function edit(Course $course) 
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
{
    $validated = $request->validate([
        'course_name' => 'required|string|max:255', 
        'description' => 'required',
        'capacity' => 'required|integer'
    ]);

    $course->update($validated); 
    return redirect()->route('courses.index')->with('success', 'Course updated!');
}

    public function destroy(Course $course) 
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Role updated.');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own admin account.');
        }

        $user->courses()->detach();
        $user->delete();

        return back()->with('success', 'Account successfully removed.');
    }
}