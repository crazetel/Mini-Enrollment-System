@extends('layouts.app')
@section('content')
<div class="p-8">
    <h1 class="text-4xl text-white">{{ $student->first_name }} {{ $student->last_name }}</h1>
    <p class="text-white/50 mb-8">Student Number: {{ $student->student_number }}</p>

    <h2 class="text-2xl text-pink-500 mb-4">Enrolled Courses</h2>
    <ul class="space-y-2">
        @foreach($student->courses as $course)
            <li class="glass p-4 rounded-xl text-white">{{ $course->course_name }} ({{ $course->course_code }})</li>
        @endforeach
    </ul>
</div>
@endsection