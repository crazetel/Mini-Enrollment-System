@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto space-y-12">
    <div>
        <h1 class="text-6xl font-serif italic text-white">Identity <span class="opacity-30">Parameters</span></h1>
        <p class="text-[10px] font-black uppercase tracking-[0.5em] text-cyan-400 mt-4 ml-1">Modify your portal profile</p>
    </div>
    
    <div class="glass p-12 rounded-[3.5rem] relative overflow-hidden">
        <div class="absolute -left-20 top-0 w-64 h-64 bg-cyan-500/10 blur-[100px] -z-10"></div>
        <h3 class="text-xl font-bold mb-10 tracking-tight">Profile Information</h3>
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="glass p-12 rounded-[3.5rem]">
        <h3 class="text-xl font-bold mb-10 tracking-tight">Security Update</h3>
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="glass p-12 rounded-[3.5rem] border-l-8 border-red-500/20">
        <h3 class="text-xl font-bold mb-4 tracking-tight text-red-400">Danger Zone</h3>
        <p class="text-xs text-white/40 mb-10">Once deleted, your account and all data will be permanently purged from the system.</p>
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection