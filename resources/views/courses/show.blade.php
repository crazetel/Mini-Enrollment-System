@extends('layouts.app')

@section('content')
<div class="min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-12">
            <a href="{{ route('courses.index') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-cyan-400 hover:text-white transition">← Back to Catalog</a>
            <h1 class="text-6xl font-serif italic text-white mt-4">{{ $course->course_name }} <span class="opacity-20">Details</span></h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="glass p-8 rounded-[2rem] border border-white/5">
                <p class="text-[10px] font-bold uppercase opacity-30 mb-2">Course Code</p>
                <p class="text-2xl font-bold text-cyan-400">{{ $course->course_code }}</p>
            </div>
            <div class="glass p-8 rounded-[2rem] border border-white/5">
                <p class="text-[10px] font-bold uppercase opacity-30 mb-2">Total Capacity</p>
                <p class="text-2xl font-bold">{{ $course->capacity }} Slots</p>
            </div>
            <div class="glass p-8 rounded-[2rem] border border-white/5">
                <p class="text-[10px] font-bold uppercase opacity-30 mb-2">Enrolled</p>
                <p class="text-2xl font-bold text-pink-500">{{ $students->count() }} Students</p>
            </div>
        </div>

        <div class="glass p-12 rounded-[3rem] border border-white/5">
            <h2 class="text-xl font-bold mb-8 uppercase tracking-widest text-white/50">Enrolled Students</h2>
            
            @if($students->isEmpty())
                <p class="text-sm opacity-30 italic">No students enrolled in this module yet.</p>
            @else
                <div class="space-y-4">
                    @foreach($students as $student)
                    <div class="flex justify-between items-center p-6 rounded-2xl bg-white/5 border border-white/5">
                        <div>
                            <p class="font-bold text-white">{{ $student->first_name }} {{ $student->last_name }}</p>
                            <p class="text-[10px] opacity-40 uppercase tracking-widest">{{ $student->student_number }}</p>
                        </div>
                        <span class="text-[9px] font-black px-3 py-1 bg-cyan-500/10 text-cyan-400 rounded-full">STUDENT</span>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection