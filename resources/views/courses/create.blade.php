@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="glass p-16 rounded-[4rem] relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-pink-500/10 blur-[100px] -z-10"></div>
        
        <h2 class="text-5xl font-serif italic mb-2 text-white">New <span class="opacity-40 text-white">Course</span></h2>
        <p class="text-[10px] font-black uppercase tracking-[0.5em] text-pink-500 mb-12 ml-1">Define educational parameters</p>
        
        @if ($errors->any())
        <div class="glass p-8 rounded-3xl border border-red-500/30 bg-red-500/5 mb-8">
            <div class="flex items-start space-x-4">
                <svg class="w-6 h-6 text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div class="flex-1">
                    <h3 class="text-sm font-bold text-red-400 mb-3 uppercase tracking-widest">Cannot Create Course</h3>
                    <ul class="space-y-2">
                        @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-300 text-opacity-80">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        
        <form action="{{ route('courses.store') }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-[9px] font-black uppercase tracking-widest text-white/30 mb-3 ml-2">Unique Code</label>
                    <input type="text" name="course_code" placeholder="e.g. MATH202" required class="w-full px-8 py-5 @error('course_code') border-2 border-red-500 @enderror">
                </div>
                <div>
                    <label class="block text-[9px] font-black uppercase tracking-widest text-white/30 mb-3 ml-2">Total Capacity</label>
                    <input type="number" name="capacity" placeholder="e.g. 30" required class="w-full px-8 py-5 @error('capacity') border-2 border-red-500 @enderror">
                </div>
            </div>

            <div>
                <label class="block text-[9px] font-black uppercase tracking-widest text-white/30 mb-3 ml-2">Course Title</label>
                <input type="text" name="course_name" placeholder="Advanced Calculus" required class="w-full px-8 py-5 @error('course_name') border-2 border-red-500 @enderror">
            </div>
            
            <div>
                <label class="block text-[9px] font-black uppercase tracking-widest text-white/30 mb-3 ml-2">Detailed Description</label>
                <textarea name="description" rows="4" placeholder="Outline the learning objectives..." class="w-full px-8 py-5 @error('description') border-2 border-red-500 @enderror"></textarea>
            </div>

            <button type="submit" class="w-full bg-white text-black font-black py-6 rounded-3xl text-xs uppercase tracking-[0.5em] hover:bg-pink-500 hover:text-white transition-all transform hover:scale-[1.02] shadow-2xl">
                ADD COURSE
            </button>
        </form>
    </div>
</div>
@endsection