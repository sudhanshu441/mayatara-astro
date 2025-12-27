<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Mayatara</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background:
                radial-gradient(900px at 10% 10%, #4c1d95 0%, transparent 40%),
                radial-gradient(700px at 90% 20%, #1e3a8a 0%, transparent 45%),
                #0b0617;
        }

        .glass {
            background: linear-gradient(
                180deg,
                rgba(30, 24, 58, 0.85),
                rgba(18, 14, 34, 0.85)
            );
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .input {
            transition: all .2s ease;
        }

        .input:focus {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(139,92,246,.25);
            border-color: rgba(139,92,246,.6);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-6">

<div class="w-full max-w-2xl glass rounded-2xl p-6 sm:p-8 text-white">

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold">
            Join <span class="text-purple-400">Mayatara</span>
        </h1>
        <p class="text-gray-400 text-sm mt-1">
            Begin your mystical journey ✨
        </p>
    </div>

    <!-- Errors -->
    @if ($errors->any())
        <div class="mb-5 bg-red-500/15 text-red-400 px-4 py-2 rounded-lg text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}" class="space-y-7">
        @csrf

        <!-- Role -->
        <div class="max-w-xs mx-auto">
            <label class="block mb-1 text-sm text-gray-300">Register As</label>
            <select name="role" id="role"
                class="input w-full bg-black/40 text-white border border-white/20 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="user">User</option>
                <option value="astrologer">Astrologer</option>
            </select>
        </div>

        <!-- Basic Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <input name="name" placeholder="Full Name"
                class="input bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 focus:outline-none">

            <input name="phone" maxlength="10" placeholder="Phone Number"
                class="input bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 focus:outline-none">

            <input name="email" placeholder="Email Address (optional)"
                class="input bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 focus:outline-none md:col-span-2">
        </div>

        <!-- Category (Astrologer only) -->
        <div id="category-field" class="hidden">
            <select name="category"
                class="input w-full bg-black text-white border border-white/20 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="" class="bg-black text-white">Select Astrology Category</option>
                <option class="bg-black text-white">Vedic Astrology</option>
                <option class="bg-black text-white">Horoscopes</option>
                <option class="bg-black text-white">Zodiac Signs</option>
                <option class="bg-black text-white">Planetary Transit</option>
                <option class="bg-black text-white">Numerology</option>
                <option class="bg-black text-white">Tarot</option>
            </select>
        </div>

        <!-- Astrologer Fields -->
        <div id="astrologer-fields" class="hidden">
            <div class="rounded-xl border border-purple-500/20 bg-purple-500/5 p-5 space-y-4">
                <h3 class="text-sm font-semibold text-purple-400">
                    🔮 Astrologer Profile
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="expertise" placeholder="Expertise"
                        class="input bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 focus:outline-none">

                    <input name="experience_years" type="number" placeholder="Experience (Years)"
                        class="input bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 focus:outline-none">

                    <textarea name="bio" rows="2" placeholder="Short Bio"
                        class="input bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 focus:outline-none md:col-span-2"></textarea>
                </div>
            </div>
        </div>

        <!-- Passwords -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="relative">
                <input type="password" id="password" name="password" placeholder="Password"
                    class="input w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 pr-10 focus:outline-none">
                <button type="button" onclick="togglePassword('password', this)"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-purple-400">
                    👁
                </button>
            </div>

            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirm Password"
                    oninput="checkPasswordMatch()"
                    class="input w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 pr-10 focus:outline-none">
                <button type="button" onclick="togglePassword('password_confirmation', this)"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-purple-400">
                    👁
                </button>
            </div>
        </div>

        <p id="password-message" class="text-xs hidden"></p>

        <!-- Submit -->
        <button
            class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 py-3 rounded-xl font-semibold shadow-lg transition">
            Create Account ✨
        </button>

        <p class="text-center text-gray-400 text-sm">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-400 font-semibold hover:text-purple-300">
                Login
            </a>
        </p>
    </form>
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
    toggleAstrologerFields(); // run on load

    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            btn.textContent = "🙈";
        } else {
            input.type = "password";
            btn.textContent = "👁";
        }
    }

    function checkPasswordMatch() {
        const p = document.getElementById('password').value;
        const c = document.getElementById('password_confirmation').value;
        const m = document.getElementById('password-message');

        if (!c) return m.classList.add('hidden');

        m.classList.remove('hidden');
        m.textContent = p === c ? "Passwords match ✔" : "Passwords do not match ✖";
        m.className = p === c
            ? "text-xs text-green-400"
            : "text-xs text-red-400";
    }
</script>

</body>
</html>
