<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Mayatara</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: url('{{ asset("public/loginbg.jpeg") }}');
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

<div class="w-full max-w-2xl">

    <div class="glass rounded-2xl p-6 sm:p-8 shadow-2xl">

        <!-- Logo -->
        <img src="{{ asset('public/logofiles/png/logo-new.png') }}"
             alt="Logo"
             style="width:200px; display:block; margin:0 auto 16px;">

        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-white">
                Create your <span class="text-purple-400">Mayatara</span> account
            </h1>
            <p class="text-gray-400 text-sm mt-1">
                Begin your mystical journey ✨
            </p>
        </div>

        <!-- Error -->
        @if ($errors->any())
            <div class="mb-4 bg-red-500/20 text-red-400 px-4 py-2 rounded-lg text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}" class="space-y-6">
            @csrf

            <!-- Role -->
            <div class="max-w-xs mx-auto">
                <label class="text-gray-300 text-sm mb-2 block">Register As</label>
                <select name="role" id="role"
                    class="input-field w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none">
                    <option value="user">User</option>
                    <option value="astrologer">Astrologer</option>
                </select>
            </div>

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <input name="name" placeholder="Full Name"
                    class="input-field bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none">

                <input name="phone" maxlength="10" placeholder="Phone Number"
                    class="input-field bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none">

                <input name="email" placeholder="Email Address (optional)"
                    class="input-field bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none md:col-span-2">
            </div>

            <!-- Category -->
            <div id="category-field" class="hidden">
                <select name="category"
                    class="input-field w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none">
                    <option value="">Select Astrology Category</option>
                    <option>Vedic Astrology</option>
                    <option>Horoscopes</option>
                    <option>Zodiac Signs</option>
                    <option>Planetary Transit</option>
                    <option>Numerology</option>
                    <option>Tarot</option>
                </select>
            </div>

            <!-- Astrologer Fields -->
            <div id="astrologer-fields" class="hidden">
                <div class="rounded-xl border border-purple-500/20 bg-purple-500/10 p-5 space-y-4">
                    <h3 class="text-sm font-semibold text-purple-400">
                        🔮 Astrologer Profile
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input name="expertise" placeholder="Expertise"
                            class="input-field bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none">

                        <input name="experience_years" type="number" placeholder="Experience (Years)"
                            class="input-field bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none">

                        <textarea name="bio" rows="2" placeholder="Short Bio"
                            class="input-field bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none md:col-span-2"></textarea>
                    </div>
                </div>
            </div>

            <!-- Passwords -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="input-field w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 pr-12 text-white focus:outline-none">
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                        👁
                    </button>
                </div>

                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm Password" oninput="checkPasswordMatch()"
                        class="input-field w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 pr-12 text-white focus:outline-none">
                    <button type="button" onclick="togglePassword('password_confirmation', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                        👁
                    </button>
                </div>
            </div>

            <p id="password-message" class="text-xs hidden"></p>

            <!-- Submit -->
            <button type="submit"
                class="btn-submit w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white py-3 rounded-xl font-semibold shadow-lg">
                Create Account
            </button>

            <p class="text-center text-gray-400 text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="text-purple-400 font-semibold hover:text-purple-300">
                    Sign In
                </a>
            </p>
        </form>
    </div>
</div>

<script>
    const role = document.getElementById('role');
    const astroFields = document.getElementById('astrologer-fields');
    const categoryField = document.getElementById('category-field');

    function toggleAstrologerFields() {
        const isAstrologer = role.value === 'astrologer';
        astroFields.classList.toggle('hidden', !isAstrologer);
        categoryField.classList.toggle('hidden', !isAstrologer);
    }
    role.addEventListener('change', toggleAstrologerFields);
    toggleAstrologerFields();

    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function checkPasswordMatch() {
        const p = document.getElementById('password').value;
        const c = document.getElementById('password_confirmation').value;
        const m = document.getElementById('password-message');

        if (!c) return m.classList.add('hidden');

        m.classList.remove('hidden');
        m.textContent = p === c ? "Passwords match ✔" : "Passwords do not match ✖";
        m.className = p === c ? "text-xs text-green-400" : "text-xs text-red-400";
    }
</script>

</body>
</html>
