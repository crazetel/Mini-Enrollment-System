<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Enrollment Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;800&display=swap" rel="stylesheet">
    <style>
        body { background: radial-gradient(circle at top right, #1e1b4b, #000000); min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif; color: white; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="antialiased">
    <nav class="p-6 flex justify-between items-center glass mb-10">
        <div class="text-sm font-black tracking-[0.4em] uppercase">ENROLLMENT<span class="text-pink-500 italic">PORTAL</span></div>
        <div class="flex items-center gap-6">
            <span class="text-[10px] font-bold uppercase tracking-widest opacity-60">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
    @csrf
    <button type="button" 
            onclick="confirmLogout()" 
            class="text-[10px] font-black uppercase tracking-widest bg-pink-500 px-6 py-3 rounded-xl hover:bg-pink-600 transition shadow-lg shadow-pink-500/20">
        Logout
    </button>
</form>

<script>
    function confirmLogout() {
        if (confirm("Are you sure you want to log out of the system?")) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 pb-20">
        @if(Auth::user()->role === 'admin')
            <div class="flex justify-between items-end mb-12">
                <div>
                    <p class="text-pink-500 font-black text-xs uppercase tracking-[0.4em] mb-2">Management Console</p>
                    <h1 class="text-5xl font-extrabold tracking-tighter"> <span class="opacity-40 italic">Dashboard</span></h1>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('courses.create') }}" class="glass px-6 py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-white hover:text-black transition">Create Course</a>
                    <a href="{{ route('admin.users') }}" class="glass px-6 py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-white hover:text-black transition">Manage Users</a>
                    <a href="{{ route('courses.index') }}" class="bg-white text-black px-6 py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-pink-500 hover:text-white transition">View Catalog</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="glass p-10 rounded-[3rem]">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-40">Total Students</p>
                    <p class="text-6xl font-bold mt-2">{{ $stats['total_students'] ?? 0 }}</p>
                </div>
                <div class="glass p-10 rounded-[3rem]">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-40">Active Courses</p>
                    <p class="text-6xl font-bold mt-2">{{ $stats['total_courses'] ?? 0 }}</p>
                </div>
                <div class="glass p-10 rounded-[3rem]">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-40">Total Enrollments</p>
                    <p class="text-6xl font-bold mt-2">{{ $stats['total_enrollments'] ?? 0 }}</p>
                </div>
            </div>

            <div class="glass p-10 rounded-[3rem]">
                <h3 class="text-sm font-black uppercase tracking-widest mb-8 opacity-60">Recent Activity</h3>
                <div class="space-y-4">
                    @foreach($recentUsers as $user)
                        <div class="flex justify-between items-center p-4 rounded-2xl bg-white/5 border border-white/5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-pink-500 flex items-center justify-center font-bold">{{ substr($user->name, 0, 1) }}</div>
                                <div>
                                    <p class="font-bold text-sm">{{ $user->name }}</p>
                                    <p class="text-xs opacity-40">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-black px-3 py-1 rounded-full bg-white/10">{{ $user->role }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        @else
            <div class="mb-12">
                <p class="text-cyan-400 font-black text-xs uppercase tracking-[0.4em] mb-2">Student Portal</p>
                <h1 class="text-5xl font-extrabold tracking-tighter">Welcome, <span class="opacity-40 italic">{{ Auth::user()->name }}</span></h1>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="glass p-10 rounded-[3rem] bg-gradient-to-br from-cyan-500/10 to-transparent">
                        <h3 class="text-xl font-bold mb-4">My Enrollments</h3>
                        @if(Auth::user()->courses->isEmpty())
                            <p class="opacity-40 italic mb-6">You haven't enrolled in any courses yet.</p>
                            <a href="{{ route('courses.index') }}" class="inline-block bg-cyan-500 text-white px-8 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest">Explore Catalog</a>
                        @else
                            <div class="grid gap-4">
                                @foreach(Auth::user()->courses as $course)
                                    <div class="flex justify-between items-center p-6 rounded-2xl bg-white/5 border border-white/10">
                                        <p class="font-bold">{{ $course->title }}</p>
                                        <form action="{{ route('courses.unenroll', $course->id) }}" method="POST">
                                            @csrf
                                            <button class="text-[10px] font-black text-pink-500 uppercase hover:underline">Withdraw</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="glass p-8 rounded-[3rem] h-fit">
                    <h3 class="text-sm font-black uppercase tracking-widest mb-6 opacity-60">Quick Links</h3>
                    <div class="space-y-4">
                        <a href="{{ route('courses.index') }}" class="block w-full py-4 text-center glass rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-white hover:text-black transition">Course Catalog</a>
                        <a href="{{ route('profile.edit') }}" class="block w-full py-4 text-center glass rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-white hover:text-black transition">Profile Settings</a>
                    </div>
                </div>
            </div>
        @endif
    </main>
</body>
</html>