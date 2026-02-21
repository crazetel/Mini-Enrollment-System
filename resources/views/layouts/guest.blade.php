<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EnrollmentPortal Access</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;800&display=swap" rel="stylesheet">
        <style>
            body {
                /* Deep Dark Background */
                background: radial-gradient(circle at top left, #1e1b4b, #000000);
                font-family: 'Plus Jakarta Sans', sans-serif;
                min-height: 100vh;
                margin: 0;
            }
            .glass-container {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(25px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="flex items-center justify-center p-6">
        <div class="fixed top-[-10%] left-[-10%] w-[400px] h-[400px] bg-pink-500/20 blur-[120px] rounded-full -z-10"></div>
        <div class="fixed bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-cyan-500/20 blur-[120px] rounded-full -z-10"></div>

        <div class="w-full max-w-md glass-container p-10 rounded-[3rem] shadow-2xl relative">
            {{ $slot }}
        </div>
    </body>
</html>