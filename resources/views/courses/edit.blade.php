@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-8">
    <div class="glass p-16 rounded-[4rem] w-full max-w-xl border border-white/10">
        <div class="mb-10">
            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-cyan-400">Management</p>
            <h1 class="text-4xl font-serif italic text-white mt-2">Edit <span class="opacity-30">Course</span></h1>
        </div>

        <form action="{{ route('courses.update', $course->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="text-[10px] font-bold uppercase opacity-30 mb-2 block ml-4">Course Name</label>
                <input type="text" name="course_name" value="{{ $course->course_name }}" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-bold uppercase opacity-30 mb-2 block ml-4">Course Code</label>
                    <input type="text" value="{{ $course->course_code }}" readonly class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white/30 cursor-not-allowed">
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase opacity-30 mb-2 block ml-4">Capacity</label>
                    <input type="number" name="capacity" value="{{ $course->capacity }}" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white focus:border-cyan-400 outline-none">
                </div>
            </div>

            <div>
                <label class="text-[10px] font-bold uppercase opacity-30 mb-2 block ml-4">Description</label>
                <textarea name="description" rows="4" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white focus:border-cyan-400 outline-none">{{ $course->description }}</textarea>
            </div>

            <button type="submit" class="w-full bg-cyan-500 text-white font-black py-6 rounded-2xl text-[10px] uppercase tracking-[0.5em] hover:bg-white hover:text-black transition-all">
                UPDATE MODULE
            </button>
            <a href="{{ route('courses.index') }}" class="block text-center text-[10px] font-bold uppercase tracking-widest opacity-30 mt-4">Cancel</a>
        </form>
    </div>
</div>
@endsection