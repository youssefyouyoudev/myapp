<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Youssef Youyou - Fullstack & Android Developer')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <style>
        :root {
            --color-primary: #8B5CF6;
            --color-secondary: #3B82F6;
            --color-accent: #06B6D4;
            --color-background: #f6f8fa;
            --color-surface: #fff;
            --color-surface-light: #f3f4f6;
            --color-text: #222;
            --color-text-secondary: #555;
            --color-border: rgba(139, 92, 246, 0.12);
            --transition: all 0.3s cubic-bezier(.4,0,.2,1);
        }
        [data-theme="dark"] {
            --color-background: #0a0a1a;
            --color-surface: #1a1a2e;
            --color-surface-light: #252540;
            --color-text: #fff;
            --color-text-secondary: #9ca3af;
            --color-border: rgba(139, 92, 246, 0.2);
        }
        body {
            background: var(--color-background);
            color: var(--color-text);
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            transition: background 0.3s, color 0.3s;
        }
        main {
            min-height: 100vh; /* Full viewport height */
            width: 100vw;      /* Full viewport width */
            padding: 0;
            background: var(--color-surface);
            border-radius: 0;
            box-shadow: none;
            margin: 0;
            max-width: 100vw;
            color: var(--color-text);
            transition: background 0.3s, box-shadow 0.3s, color 0.3s;
            overflow-x: hidden;
        }
        .toast {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            background: #222;
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s;
        }
        .toast.show {
            opacity: 1;
            pointer-events: auto;
        }
        .spinner {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255,255,255,0.7);
            z-index: 9998;
            align-items: center;
            justify-content: center;
        }
        .spinner.active {
            display: flex;
        }
        .spinner .loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #222;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg);}
            100% { transform: rotate(360deg);}
        }
        .theme-toggle {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 9999;
            background: var(--color-surface);
            color: var(--color-primary);
            border: 1px solid var(--color-border);
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: background 0.3s, color 0.3s;
        }
        .theme-toggle:focus {
            outline: 2px solid var(--color-primary);
        }
        .theme-toggle svg {
            width: 24px;
            height: 24px;
            transition: transform 0.4s cubic-bezier(.4,0,.2,1);
        }
        .theme-toggle[data-mode="dark"] svg.sun {
            display: none;
        }
        .theme-toggle[data-mode="light"] svg.moon {
            display: none;
        }
        .theme-toggle[data-mode="dark"] svg.moon {
            display: inline;
        }
        .theme-toggle[data-mode="light"] svg.sun {
            display: inline;
        }
        @media (max-width: 900px) {
            main { max-width: 98vw; margin: 1rem; }
        }
    </style>
</head>
<body>
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark/light mode" data-mode="dark">
        <svg class="sun" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
        <svg class="moon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/></svg>
    </button>
    <div class="spinner" id="globalSpinner">
        <div class="loader"></div>
    </div>
    <div class="toast" id="globalToast"></div>
    @include('partials.navbar')

    <main tabindex="-1">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        // Theme toggle logic
        const themeToggle = document.getElementById('themeToggle');
        function setTheme(mode) {
            document.documentElement.setAttribute('data-theme', mode);
            themeToggle.setAttribute('data-mode', mode);
            localStorage.setItem('theme', mode);
        }
        themeToggle.addEventListener('click', () => {
            const current = document.documentElement.getAttribute('data-theme');
            setTheme(current === 'dark' ? 'light' : 'dark');
        });
        document.addEventListener('DOMContentLoaded', function() {
            const saved = localStorage.getItem('theme');
            setTheme(saved || 'dark');
            document.querySelector('main').focus();
        });

        // Toast notification
        window.showToast = function(message, duration = 3000) {
            const toast = document.getElementById('globalToast');
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), duration);
        };

        // Spinner control
        window.showSpinner = function() {
            document.getElementById('globalSpinner').classList.add('active');
        };
        window.hideSpinner = function() {
            document.getElementById('globalSpinner').classList.remove('active');
        };

        // Example: Show spinner on AJAX start/end
        document.addEventListener('ajaxStart', showSpinner);
        document.addEventListener('ajaxEnd', hideSpinner);

        // Focus main content for accessibility
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('main').focus();
        });
    </script>
    @stack('scripts')
</body>
</html>
