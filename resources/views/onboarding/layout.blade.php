<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome to Hovertask')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#2C418F',
                            50: '#EEF2FF',
                            100: '#E0E7FF',
                            200: '#C7D2FE',
                            300: '#A5B4FC',
                            400: '#818CF8',
                            500: '#6366F1',
                            600: '#4F46E5',
                            700: '#4338CA',
                            800: '#2C418F',
                            900: '#1E1B4B',
                        },
                        accent: {
                            DEFAULT: '#3A5AE8',
                        },
                    },
                    fontFamily: {
                        heading: ['Outfit', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Outfit', sans-serif; }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-primary via-indigo-600 to-purple-700 min-h-screen">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="py-4 px-6">
            <div class="max-w-4xl mx-auto flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-primary font-bold text-xl">H</span>
                    </div>
                    <span class="text-white font-heading font-bold text-xl">Hovertask</span>
                </a>
                <a href="{{ route('onboarding.skip') }}" class="text-white/70 hover:text-white text-sm font-medium transition-colors">
                    Skip Setup <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </header>

        <!-- Progress Bar -->
        <div class="px-6 mb-8">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center justify-between mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="flex items-center {{ $i < 5 ? 'flex-1' : '' }}">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-all
                                {{ $i <= ($step ?? 1) ? 'bg-white text-primary' : 'bg-white/20 text-white/60' }}">
                                {{ $i }}
                            </div>
                            @if($i < 5)
                                <div class="flex-1 h-1 mx-2 rounded-full transition-all
                                    {{ $i < ($step ?? 1) ? 'bg-white' : 'bg-white/20' }}"></div>
                            @endif
                        </div>
                    @endfor
                </div>
                <p class="text-white/60 text-center text-sm">Step {{ $step ?? 1 }} of 5</p>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 flex items-center justify-center px-6 pb-12">
            <div class="w-full max-w-lg">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
