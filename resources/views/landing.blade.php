<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Nepal Rates Dashboard - Real-time market rates for fuel, foreign exchange, metals, weather, and electricity tariffs in Nepal">
    <meta name="keywords" content="Nepal rates, fuel prices, exchange rates, metal prices, weather, electricity tariffs, Nepal market">
    
    <title>NepaRates Dashboard - Real-time Market Data for Nepal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Inter', 'Playfair Display', system-ui, -apple-system, sans-serif;
                line-height: 1.6;
                color: #1a1a1a;
                background: #ffffff;
                font-weight: 400;
            }
            
            .gradient-bg {
                background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
                position: relative;
            }
            
            .gradient-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
                pointer-events: none;
            }
            
            .text-gradient {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .card-hover {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            }
            
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
            }
            
            .btn-secondary {
                border: 2px solid #10b981;
                color: #10b981;
                transition: all 0.3s ease;
            }
            
            .btn-secondary:hover {
                background: #10b981;
                color: white;
                transform: translateY(-2px);
            }
            
            /* Enhanced Typography */
            h1, h2, h3, h4, h5, h6 {
                font-weight: 600;
                line-height: 1.2;
                letter-spacing: -0.02em;
                word-wrap: break-word;
                overflow-wrap: break-word;
            }
            
            h1 {
                font-size: 3.5rem;
                font-weight: 800;
                line-height: 1.1;
                margin-bottom: 1.5rem;
            }
            
            h2 {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }
            
            h3 {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 0.75rem;
            }
            
            p {
                font-size: 1.125rem;
                line-height: 1.7;
                color: #4b5563;
                margin-bottom: 1rem;
                word-wrap: break-word;
                overflow-wrap: break-word;
                hyphens: auto;
            }
            
            .text-white {
                color: #ffffff !important;
            }
            
            .text-gray-600 {
                color: #6b7280 !important;
            }
            
            .text-gray-400 {
                color: #9ca3af !important;
            }
            
            /* Enhanced visibility for all text */
            .text-visible {
                color: #1a1a1a;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                z-index: 10;
                position: relative;
            }
            
            .text-white-visible {
                color: #ffffff;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
                z-index: 10;
                position: relative;
            }
            
            .text-black {
                color: #000000 !important;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
                z-index: 10;
                position: relative;
            }
            
            /* Force full width display */
            .full-width {
                width: 100% !important;
                max-width: 100% !important;
            }
            
            /* Hero Section Text - Simple and Working */
            .hero-text-container {
                width: 100vw;
                padding: 2rem 1rem;
                text-align: center;
                margin-left: calc(-50vw + 50%);
                margin-right: calc(-50vw + 50%);
            }
            
            .hero-main-text {
                font-size: clamp(2rem, 5vw, 4rem);
                font-weight: 800;
                color: #000000;
                line-height: 1.1;
                margin-bottom: 1rem;
                text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.8);
            }
            
            .hero-sub-text {
                font-size: clamp(1rem, 2.5vw, 1.25rem);
                color: #000000;
                line-height: 1.6;
                background: #ffffff;
                padding: 1.5rem;
                border-radius: 0.5rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                display: inline-block;
                width: 100%;
                max-width: 1200px;
                word-wrap: break-word;
                overflow-wrap: break-word;
                hyphens: auto;
                white-space: normal;
            }
            
            /* Override all container constraints */
            .no-container-limit {
                width: 100vw !important;
                max-width: 100vw !important;
                padding: 0 2rem !important;
                margin: 0 !important;
                overflow: visible !important;
                position: relative !important;
            }
            
            /* Force text to display */
            .force-text-visible {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                overflow: visible !important;
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
            }
            
            /* Footer text styling */
            .footer-text {
                color: #000000 !important;
                z-index: 10 !important;
                position: relative !important;
                width: 100% !important;
                max-width: none !important;
                overflow: visible !important;
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
            }
            
            .footer-heading {
                color: #000000 !important;
                font-weight: bold !important;
                z-index: 10 !important;
                position: relative !important;
                width: 100% !important;
                max-width: none !important;
                overflow: visible !important;
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
            }
            
            .footer-description {
                color: #000000 !important;
                z-index: 10 !important;
                position: relative !important;
                width: 100% !important;
                max-width: none !important;
                overflow: visible !important;
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
            }
            
            .footer-copyright {
                color: #000000 !important;
                z-index: 10 !important;
                position: relative !important;
                width: 100% !important;
                max-width: none !important;
                overflow: visible !important;
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
            }
            
            /* Force full width for CTA and Footer */
            .cta-container {
                width: 100vw !important;
                max-width: 100vw !important;
                margin-left: calc(-50vw + 50%) !important;
                margin-right: calc(-50vw + 50%) !important;
                padding: 0 2rem !important;
            }
            
            .footer-container {
                width: 100vw !important;
                max-width: 100vw !important;
                margin-left: calc(-50vw + 50%) !important;
                margin-right: calc(-50vw + 50%) !important;
                padding: 0 2rem !important;
            }
            
            /* Simple full width container */
            .text-container {
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 1rem !important;
                margin: 0 !important;
                overflow: visible !important;
            }
            
            /* Remove all constraints from body and html */
            html, body {
                overflow-x: hidden !important;
                width: 100% !important;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .animate-fade-in-up {
                animation: fadeInUp 0.8s ease-out;
            }
            
            .animate-delay-100 { animation-delay: 0.1s; }
            .animate-delay-200 { animation-delay: 0.2s; }
            .animate-delay-300 { animation-delay: 0.3s; }
            .animate-delay-400 { animation-delay: 0.4s; }
            
            /* Responsive navigation styles */
            .hidden { display: none !important; }
            @media (min-width: 768px) {
                .md\\:flex { display: flex !important; }
                .md\\:block { display: block !important; }
                .md\\:hidden { display: none !important; }
            }
            
            @media (max-width: 768px) {
                h1 { font-size: 2.5rem; }
                h2 { font-size: 2rem; }
                h3 { font-size: 1.25rem; }
                p { font-size: 1rem; }
            }
        </style>
    @endif
</head>
<body>
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-gradient">NepaRates </h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-white-visible bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-2 rounded-full font-semibold hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-lg">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="text-white-visible bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-2 rounded-full font-semibold hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-lg">
                        Sign Up
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button x-data="{ open: false }" @click="open = !open" class="text-gray-700 hover:text-emerald-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg text-white pt-24 pb-20 px-4 relative">
        <div class="animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-8 text-white-visible leading-tight">
                <span class="text-black">Real-Time Market Rates</span><br>
                <span class="text-black">for Nepal</span>
            </h1>
            <div style="width: 100vw; margin-left: calc(-50vw + 50%); padding: 0 1rem;">
                <p style="font-size: 1.375rem; line-height: 1.8; color: #1f2937; background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%); padding: 2rem 2.5rem; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08), 0 4px 6px rgba(0, 0, 0, 0.04); text-align: center; word-wrap: break-word; overflow-wrap: break-word; hyphens: auto; white-space: normal; display: block; border: 1px solid #e5e7eb; font-weight: 400; letter-spacing: 0.025em;">
                    Track fuel prices, exchange rates, metal prices, weather data, and electricity tariffs in one comprehensive dashboard
                </p>
            </div>
        </div>
    </section>

    <!-- Live Prices Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-extrabold mb-6 text-gradient leading-tight">
                    Live Market Rates
                </h2>
                <p class="text-xl md:text-2xl text-emerald-600 font-medium">Real-time data from <span class="text-blue-600 font-semibold">official sources</span></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- LPG Gas -->
                @php $lpg = $fuelPrices->firstWhere('product', 'Gas (LPG)'); @endphp
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-8 border border-indigo-200 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-bold text-indigo-700">LPG Gas</span>
                        <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-white text-xl">⛽</span>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-indigo-900 mb-2">रु {{ $lpg ? number_format($lpg->price) : '1,910' }}</div>
                    <div class="text-sm font-semibold text-indigo-600">Official NOC Rate</div>
                </div>

                <!-- Gold Price -->
                @php $gold = $metalPrices->firstWhere('metal_type', 'Gold (24K)'); @endphp
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl p-8 border border-amber-200 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-bold text-amber-700">Gold (24K)</span>
                        <div class="w-12 h-12 bg-amber-600 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-white text-xl">🥇</span>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-amber-900 mb-2">रु {{ $gold ? number_format($gold->price) : '--' }}</div>
                    <div class="text-sm font-semibold text-amber-600">Per Tola</div>
                </div>

                <!-- USD Exchange Rate -->
                @php $usd = $fxRates->firstWhere('base_currency', 'USD'); @endphp
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-8 border border-emerald-200 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-bold text-emerald-700">USD/NPR</span>
                        <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-white text-xl font-bold">$</span>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-emerald-900 mb-2">रु {{ $usd ? number_format($usd->buy_rate ?? $usd->rate, 2) : '--' }}</div>
                    <div class="text-sm font-semibold text-emerald-600">NRB Buy Rate</div>
                </div>

                <!-- Weather -->
                <div class="bg-gradient-to-br from-sky-50 to-sky-100 rounded-2xl p-8 border border-sky-200 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-bold text-sky-700">{{ $weatherSnapshots->first()->location ?? 'Kathmandu' }}</span>
                        <div class="w-12 h-12 bg-sky-600 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-white text-xl">🌤️</span>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-sky-900 mb-2">{{ $weatherSnapshots->first()->temperature_c ?? '--' }}°C</div>
                    <div class="text-sm font-semibold text-sky-600">{{ $weatherSnapshots->first()->condition ?? 'Clear' }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">
                    Everything You Need
                </h2>
                <p class="text-xl md:text-2xl text-emerald-700 font-medium max-w-4xl mx-auto">
                    Comprehensive <span class="text-blue-600 font-semibold">market data</span> from <span class="text-purple-600 font-semibold">official sources</span>, updated in <span class="text-green-600 font-semibold">real-time</span>
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Fuel Prices -->
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">⛽</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-visible">Fuel Prices</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">Real-time NOC fuel prices including petrol, diesel, and LPG rates across Nepal</p>
                </div>

                <!-- Exchange Rates -->
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">💱</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-visible">FX Rates</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">Official Nepal Rastra Bank foreign exchange rates for major currencies</p>
                </div>

                <!-- Metal Prices -->
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">🥇</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-visible">Metal Prices</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">Current gold and silver prices with built-in calculator for conversions</p>
                </div>

                <!-- Weather Data -->
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">🌤️</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-visible">Weather Data</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">Live weather conditions and forecasts for major cities in Nepal</p>
                </div>

                <!-- Electricity Tariffs -->
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">⚡</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-visible">Electricity Tariffs</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">Latest electricity tariff rates and billing information from NEA</p>
                </div>

                <!-- Smart Search -->
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">📍</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-visible">Smart Search</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">Find location-specific rates with intelligent search functionality</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-white py-24 relative">
        <div class="cta-container">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-8 footer-heading">
                    Ready to Get Started?
                </h2>
                <p class="text-xl md:text-2xl mb-12 font-medium footer-text">
                    Join thousands of Nepali users who trust us for accurate market data
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white text-gray-800 py-16">
        <div class="footer-container">
            <div class="text-center">
                <h3 class="text-3xl font-bold mb-6 footer-heading">NepaRates</h3>
                <p class="text-xl mb-8 leading-relaxed footer-description">Your trusted source for real-time market rates and economic data in Nepal</p>
                <div class="border-t border-gray-300 pt-8">
                    <p class="text-lg footer-copyright">&copy; {{ date('Y') }} NepaRates Dashboard. All rights reserved.</p>
                    <p class="text-sm mt-2 footer-copyright">Data via NRB, NOC, NEA, and other official sources</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Smooth scroll script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>
