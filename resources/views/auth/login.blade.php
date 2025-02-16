<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/coctel.png') }}" type="image/png">

    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans antialiased min-h-screen flex items-center justify-center">
    <x-guest-layout>
        <!-- Contenedor principal -->
        <div class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
        
            <form method="POST" action="{{ route('login') }}">
                @csrf
        
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__(key: 'Correo electrónico')" class="text-white" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 rounded-md p-3 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Ingrese su correo electrónico" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>
        
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-white" />
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 rounded-md p-3 focus:ring-blue-500" type="password" name="password" placeholder="Ingrese su contraseña" required autocomplete="current-password" />
                        
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400">
                            <!-- Ícono de ojo abierto (visible por defecto) -->
                            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 2C5.58 2 1.73 4.61.29 8.5c-.1.26-.1.54 0 .8C1.73 15.39 5.58 18 10 18s8.27-2.61 9.71-6.5c.1-.26.1-.54 0-.8C18.27 4.61 14.42 2 10 2zm0 14c-3.31 0-6.31-2.01-7.75-5C3.69 8.01 6.69 6 10 6s6.31 2.01 7.75 5c-1.44 2.99-4.44 5-7.75 5zm0-9a4 4 0 100 8 4 4 0 000-8z"/>
                            </svg>
                            
                            <!-- Ícono de ojo cerrado (oculto por defecto) -->
                            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.94 10.94A9.94 9.94 0 0110 14c-2.74 0-5.23-1.11-7.07-2.93A9.94 9.94 0 0110 6c2.74 0 5.23 1.11 7.07 2.93a9.94 9.94 0 01.87 1.01m-7.87-1.99a2 2 0 100 4 2 2 0 000-4m0-8C5.53 2 1.61 4.61.22 8.5a.99.99 0 000 .99c1.39 3.89 5.31 6.51 9.78 6.51s8.39-2.62 9.78-6.51a.99.99 0 000-.99C18.39 4.61 14.47 2 10 2m0 14c-3.42 0-6.56-1.79-8.39-4.5a10.03 10.03 0 01.6-.79c1.83 2.19 4.63 3.79 7.79 3.79s5.96-1.6 7.79-3.79c.2.26.39.52.6.79A10.03 10.03 0 0110 16z"/>
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <script>
                    function togglePasswordVisibility() {
                        const passwordInput = document.getElementById('password');
                        const eyeOpen = document.getElementById('eye-open');
                        const eyeClosed = document.getElementById('eye-closed');

                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            eyeOpen.classList.add('hidden');
                            eyeClosed.classList.remove('hidden');
                        } else {
                            passwordInput.type = 'password';
                            eyeOpen.classList.remove('hidden');
                            eyeClosed.classList.add('hidden');
                        }
                    }
                </script>
                
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-gray-900 border-gray-600 text-indigo-500 focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-300">{{ __('Mantener sesión iniciada') }}</span>
                    </label>
                </div>
        
                <!-- Login Actions -->
                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-400 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tú contraseña?') }}
                        </a>
                    @endif
        
                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg shadow-lg transform hover:scale-105 transition">
                        {{ __('Iniciar Sesión') }}
                    </x-primary-button>
                </div>
            </form>
            <div class="mt-2 text-center">
                <a class="text-sm text-blue-400 hover:underline" href="{{ route('register') }}">
                    {{ __('¿No tienes una cuenta? Regístrate aquí') }}
                </a>
            </div>
        </div>
    </x-guest-layout>
</body>
</html>
