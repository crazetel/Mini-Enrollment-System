@extends('layouts.app')
@section('content')
<div class="mb-12">
    <p class="text-cyan-400 font-black text-[10px] uppercase tracking-[0.5em] mb-2">Security & Identity</p>
    <h1 class="text-6xl font-serif italic tracking-tighter text-white">Manage <span class="opacity-40 text-white">Users</span></h1>
</div>

<div class="glass rounded-[3rem] overflow-hidden shadow-2xl">
    <table class="w-full text-left border-collapse">
        <thead class="bg-white/5 border-b border-white/10">
            <tr class="text-[10px] font-black uppercase tracking-widest text-white/40">
                <th class="px-10 py-6">User Identity</th>
                <th class="px-10 py-6">Current Role</th>
                <th class="px-10 py-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach($users as $user)
            <tr class="hover:bg-white/5 transition group">
                <td class="px-10 py-8">
                    <div class="font-bold text-lg group-hover:text-pink-400 transition">{{ $user->name }}</div>
                    <div class="text-xs opacity-40 uppercase tracking-widest">{{ $user->email }}</div>
                </td>
                <td class="px-10 py-8">
                    <span class="px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $user->role == 'admin' ? 'bg-pink-500/20 text-pink-400' : 'bg-cyan-500/20 text-cyan-400' }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="px-10 py-8 text-right">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf @method('PATCH')
                        <select name="role" onchange="this.form.submit()" class="bg-transparent border-none text-[10px] font-black uppercase tracking-widest cursor-pointer focus:ring-0">
                            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Make Student</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Make Admin</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection