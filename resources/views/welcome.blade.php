<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrollment Portal | The Future of Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;800&family=Playfair+Display:ital,wght@1,900&display=swap" rel="stylesheet">
    <style>
        body { background: radial-gradient(circle at top left, #1e1b4b, #000000); min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif; color: white; overflow-x: hidden; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .hero-text { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body>
    <div class="fixed top-[-10%] left-[-10%] w-[600px] h-[600px] bg-pink-500/10 blur-[120px] rounded-full -z-10"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-cyan-500/10 blur-[120px] rounded-full -z-10"></div>

    <nav class="p-10 flex justify-between items-center relative z-50">
        <div class="text-sm font-black tracking-[0.4em] uppercase">ENROLLMENT<span class="text-pink-500 italic">PORTAL</span></div>
        <div class="flex gap-8 items-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[10px] font-black uppercase tracking-widest bg-white text-black px-8 py-4 rounded-full hover:bg-pink-500 hover:text-white transition">Go to Dashboard</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-[10px] font-black uppercase tracking-widest opacity-60 hover:opacity-100">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-widest opacity-60 hover:opacity-100 transition">Log In</a>
                    <a href="{{ route('register') }}" class="text-[10px] font-black uppercase tracking-widest bg-pink-500 px-8 py-4 rounded-full shadow-lg shadow-pink-500/20 hover:scale-105 transition text-white">Register Now</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-10 pt-20 pb-32">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div>
                <p class="text-pink-500 font-black text-xs uppercase tracking-[0.6em] mb-6">Revolutionizing Education</p>
                <h1 class="hero-text text-8xl mb-8 leading-[0.9] tracking-tighter">Your Future <br><span class="opacity-40 italic">Starts Here.</span></h1>
                <p class="text-lg text-white/50 leading-relaxed mb-12 max-w-md">
                    Stop waiting in lines. Join thousands of students who have simplified their academic journey with our high-speed glass portal. Secure, beautiful, and efficient.
                </p>
                
                <div class="flex gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="glass px-12 py-6 rounded-2xl font-black text-xs uppercase tracking-[0.3em] hover:bg-white hover:text-black transition-all transform hover:scale-105">Return to Dashboard</a>
                    @endauth
                </div>
            </div>

            <div class="relative">
                <div class="glass p-10 rounded-[4rem] relative z-10">
                    <div class="space-y-8">
                        <div class="flex items-center gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-pink-500/20 flex items-center justify-center text-pink-500 font-bold">01</div>
                            <div>
                                <h4 class="font-bold">Instant Enrollment</h4>
                                <p class="text-sm opacity-40">Secure your spot in seconds.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 font-bold">02</div>
                            <div>
                                <h4 class="font-bold">Smart Catalog</h4>
                                <p class="text-sm opacity-40">Explore courses with ease.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>