<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mayatara</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #1e1345, #0f0a1e 40%);
            background-attachment: fixed;
        }
        .glass {
            background: rgba(26, 20, 46, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .input-field { transition: all 0.3s ease; }
        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(139, 92, 246, 0.15);
        }
        .btn-submit:active { transform: scale(0.98); }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md">

    <!-- Logo -->
    <div class="text-center mb-8">
        <div class="inline-flex w-16 h-16 items-center justify-center bg-gradient-to-tr from-purple-600 to-blue-500 rounded-2xl mb-3">
            <span class="text-white text-sm">Logo</span>
        </div>
        <h1 class="text-3xl font-bold text-white">Welcome Back</h1>
        <p class="text-gray-400 text-sm">Sign in to continue</p>
    </div>

    <!-- Login Card -->
    <div class="glass rounded-2xl p-8 shadow-2xl">

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="mb-4 bg-red-500/20 text-red-400 px-4 py-2 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- VALIDATION ERRORS --}}
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
                    class="input-field w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none"
                    placeholder="Enter 10-digit number"
                    required>
            </div>

            <!-- Password -->
            <div>
                <label class="text-gray-300 text-sm mb-2 block">Password</label>
                <input
                    type="password"
                    name="password"
                    class="input-field w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none"
                    placeholder="Enter your password"
                    required>
            </div>

            <!-- Actions -->
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
                <a href="#" class="text-purple-400 font-semibold hover:text-purple-300">Sign up</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
