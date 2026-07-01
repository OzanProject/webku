<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <title>{{ $siteName }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>

        <!-- Tailwind CDN (Matching Frontend) -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <script>
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary-container": "#f97316",
                            "orange": "#f97316",
                            "orange-light": "#fff7ed",
                            "orange-border": "#fdba74",
                            "surface": "#f8f9ff",
                        },
                        fontFamily: {
                            'sans': ['Inter', 'sans-serif'],
                            'display': ['"Plus Jakarta Sans"', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
        <style>
            body { background-color: var(--surface, #f8f9ff); }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-50">
        <div class="min-h-screen grid place-items-center py-12 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-orange-100 to-white -z-10"></div>
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -z-10"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-orange-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>

            <div class="w-full max-w-md flex flex-col items-center z-10 px-6">
                <a href="/" class="flex items-center gap-2 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-[#ff6b00] text-white flex items-center justify-center font-bold text-3xl leading-none shadow-lg shadow-orange-500/30">{{ substr($siteName, 0, 1) }}</div>
                    <span class="font-display text-3xl font-extrabold text-slate-800 tracking-tight">{{ $siteName }}</span>
                </a>

                <div class="w-full bg-white shadow-2xl overflow-hidden rounded-[24px] border border-gray-100 p-8 sm:p-10">
                    {{ $slot }}
                </div>
                
                <div class="mt-8 text-sm text-gray-500">
                    &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
                </div>
            </div>
        </div>
    </body>
</html>
