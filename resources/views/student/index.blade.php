@extends('layouts.app')

@section('content')
<div class="min-h-screen p-8">
    <div class="mb-12">
        <p class="text-[10px] font-black uppercase tracking-[0.5em] text-pink-500">Records</p>
        <h1 class="text-6xl font-serif italic text-white">Student <span class="opacity-30">Directory</span></h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($students as $student)
        <div class="glass p-8 rounded-[2.5rem] border border-white/5 flex items-center justify-between group">
            <div>
                <h3 class="text-xl font-bold text-white">{{ $student->first_name }} {{ $student->last_name }}</h3>
                <p class="text-[10px] uppercase tracking-widest text-white/30">{{ $student->student_number }}</p>
            </div>
            <a href="{{ route('students.show', $student->id) }}" class="bg-white/5 p-4 rounded-full hover:bg-white text-white hover:text-black transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection