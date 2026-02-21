<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrollment Portal | Luxury Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;800&family=Playfair+Display:ital,wght@1,900&display=swap" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top left, #1e1b4b, #000000);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: white;
            margin: 0;
        }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        input, select, textarea {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border-radius: 1rem !important;
        }
        input:focus { border-color: #ec4899 !important; ring: 1px #ec4899; }
    </style>
</head>
<body>
    <div class="fixed top-[-10%] left-[-10%] w-[500px] h-[500px] bg-pink-500/10 blur-[120px] rounded-full -z-10"></div>
    
    <nav class="glass sticky top-0 z-50 px-10 py-6 flex justify-between items-center mb-10">
        <div class="text-sm font-black tracking-[0.4em] uppercase">ENROLLMENT<span class="text-pink-500 font-serif italic">PORTAL</span></div>
        <div class="flex items-center gap-8">
            <a href="{{ route('dashboard') }}" class="text-[10px] font-bold uppercase tracking-widest opacity-60 hover:opacity-100 transition">Dashboard</a>
            <a href="{{ route('courses.index') }}" class="text-[10px] font-bold uppercase tracking-widest opacity-60 hover:opacity-100 transition">Catalog</a>
            <div class="h-4 w-[1px] bg-white/10"></div>
            <a href="{{ route('profile.edit') }}" class="text-[10px] font-bold uppercase tracking-widest text-pink-400">Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button onclick="confirmLogout()" class="text-[10px] font-bold uppercase tracking-widest opacity-40 hover:text-red-400 transition">Exit</button>

<script>
    function confirmLogout() {
        if (confirm("Are you sure you want to terminate your session?")) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('logout') }}";
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = "{{ csrf_token() }}";
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
            
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-10 pb-20">
        @yield('content')
    </main>
</body>
</html>