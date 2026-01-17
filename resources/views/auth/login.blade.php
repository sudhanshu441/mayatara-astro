<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mayatara</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: url('{{ asset("public/loginbg.jpeg") }}') !important;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        .glass {
            background: rgba(26, 20, 46, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(139, 92, 246, 0.15);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md">

    <!-- Login Card -->
    <div class="glass rounded-2xl p-6 shadow-2xl">
    <img src="{{ asset('public/logofiles/png/logo-new.png') }}"
     alt="Logo"
     style="width:200px; display:block; margin:0 auto;">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-4 bg-green-500/20 text-green-400 px-4 py-2 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="mb-4 bg-red-500/20 text-red-400 px-4 py-2 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- VALIDATION ERROR --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-500/20 text-red-400 px-4 py-2 rounded-lg text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
            @csrf

            <!-- Phone -->
            <div>
                <label class="text-gray-300 text-sm mb-2 block">Phone Number</label>
                <input
                    type="tel"
                    name="phone"
                    maxlength="10"
                    value="{{ old('phone') }}"
                    placeholder="Enter 10-digit number"
                    class="input-field w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none"
                    required>
            </div>

            <!-- Password -->
            <div>
                <label class="text-gray-300 text-sm mb-2 block">Password</label>
                <div class="relative">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        class="input-field w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 pr-12 text-white placeholder-gray-500 focus:outline-none"
                        required>
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-300">
                        👁
                    </button>
                </div>
            </div>

            <!-- Remember & Forgot -->
            <div class="flex justify-between text-sm">
                <label class="flex items-center gap-2 text-gray-400">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
                <a href="#" class="text-purple-400 hover:text-purple-300">Forgot Password?</a>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="btn-submit w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white py-3 rounded-xl font-semibold shadow-lg">
                Sign In
            </button>

            <p class="text-center text-gray-400 text-sm">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-purple-400 font-semibold hover:text-purple-300">
                    Sign up
                </a>
            </p>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

</body>
</html>
