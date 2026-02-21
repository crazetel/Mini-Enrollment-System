@extends('layouts.app')

@section('content')
<div class="mb-12">
    <p class="text-pink-500 font-black text-[10px] uppercase tracking-[0.5em] mb-2">Operational Intelligence</p>
    <h1 class="text-6xl font-serif italic tracking-tighter text-white">System <span class="opacity-40 text-white">Overview</span></h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    <div class="glass p-8 rounded-[2rem] relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-pink-500 opacity-20 blur-3xl"></div>
        <p class="text-[10px] font-black uppercase tracking-widest opacity-50">Total Students</p>
        <p class="text-5xl font-bold mt-2">{{ $stats['total_students'] }}</p>
    </div>

    <div class="glass p-8 rounded-[2rem] relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-cyan-500 opacity-20 blur-3xl"></div>
        <p class="text-[10px] font-black uppercase tracking-widest opacity-50">Active Courses</p>
        <p class="text-5xl font-bold mt-2">{{ $stats['total_courses'] }}</p>
    </div>

    <div class="glass p-8 rounded-[2rem] relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500 opacity-20 blur-3xl"></div>
        <p class="text-[10px] font-black uppercase tracking-widest opacity-50">Enrollments</p>
        <p class="text-5xl font-bold mt-2">{{ $stats['total_enrollments'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8 glass p-10 rounded-[3rem]">
        <h3 class="text-xl font-bold mb-8 uppercase tracking-widest text-white/50 italic">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('courses.create') }}" class="p-8 rounded-3xl bg-white/5 border border-white/5 hover:bg-pink-500/20 transition text-center font-bold text-xs uppercase tracking-widest">Create Course</a>
            <a href="{{ route('admin.users') }}" class="p-8 rounded-3xl bg-white/5 border border-white/5 hover:bg-cyan-500/20 transition text-center font-bold text-xs uppercase tracking-widest">Manage Users</a>
        </div>
    </div>
    
    <div class="lg:col-span-4 glass p-10 rounded-[3rem]">
        <h3 class="text-xl font-bold mb-8 uppercase tracking-widest text-white/50 italic">Latest Joiners</h3>
        <div class="space-y-4">
            @foreach($recentUsers as $user)
            <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/5">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-purple-500 flex items-center justify-center font-bold text-xs">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-bold">{{ $user->name }}</p>
                    <p class="text-[9px] opacity-40 uppercase tracking-tighter">{{ $user->email }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection