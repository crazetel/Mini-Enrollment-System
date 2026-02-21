<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;800&family=Playfair+Display:ital,wght@1,900&display=swap" rel="stylesheet">
    <style>
        body { 
            background: radial-gradient(circle at bottom right, #1e1b4b, #000000); 
            min-height: 100vh; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: white; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin: 0;
        }
        .glass { 
            background: rgba(255, 255, 255, 0.03); 
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
        }
    </style>
</head>
<body>
    <div class="glass p-16 rounded-[4rem] w-full max-w-lg mx-4 shadow-2xl">
        <div class="text-center mb-10">
            <h1 class="text-5xl font-serif italic mb-3">Create <span class="opacity-30">Account</span></h1>
            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-cyan-400">Initialize identity</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-5 rounded-2xl bg-pink-500/10 border border-pink-500/20 text-pink-500 text-[10px] font-bold uppercase tracking-widest">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            
            <input type="text" name="name" value="{{ old('name') }}" placeholder="FULL NAME" required 
                   class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white focus:border-cyan-400 outline-none transition">
            
            <input type="email" name="email" value="{{ old('email') }}" placeholder="EMAIL ADDRESS" required 
                   class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white focus:border-cyan-400 outline-none transition">

            <div class="relative">
                <input type="password" id="password" name="password" placeholder="PASSWORD" required 
                       class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white focus:border-cyan-400 outline-none transition">
                <button type="button" onclick="togglePassword('password')" class="absolute right-6 top-1/2 -translate-y-1/2 text-white/20 hover:text-cyan-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>

            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="CONFIRM PASSWORD" required 
                       class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white focus:border-cyan-400 outline-none transition">
                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-6 top-1/2 -translate-y-1/2 text-white/20 hover:text-cyan-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>

            <button type="submit" class="w-full bg-cyan-500 text-white font-black py-6 rounded-2xl text-[10px] uppercase tracking-[0.5em] hover:bg-white hover:text-black transition-all transform hover:scale-[1.02] shadow-lg mt-4">
                CREATE ACCOUNT
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="text-[10px] font-bold uppercase tracking-widest opacity-30 hover:text-cyan-400 hover:opacity-100 transition">Already registered? Log in</a>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>