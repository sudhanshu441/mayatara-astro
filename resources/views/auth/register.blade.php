<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Mayatara</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(circle at top right, #2a1b5d, #0f0a1e 45%);
        }
        .glass {
            background: rgba(26, 20, 46, 0.75);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .input {
            transition: all .25s ease;
        }
        .input:focus {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.25);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 sm:px-6 py-6 sm:py-10">

<div class="w-full max-w-3xl glass rounded-3xl p-6 sm:p-10 shadow-2xl text-white">

    <!-- Header -->
    <div class="text-center mb-8 sm:mb-10">
        <h1 class="text-3xl sm:text-4xl font-extrabold mb-2">Create Account</h1>
        <p class="text-gray-400 text-sm sm:text-base">Begin your mystical journey with Mayatara ✨</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-500/20 text-red-400 px-4 py-3 rounded-xl text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}" class="space-y-8">
        @csrf

        <!-- Role -->
        <div class="max-w-sm mx-auto">
            <label class="block mb-2 text-sm text-gray-300">Register As</label>
            <select name="role" id="role"
                class="input w-full text-base bg-black text-white border border-white/20 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="user" class="bg-black text-white">User</option>
                <option value="astrologer" class="bg-black text-white">Astrologer</option>
            </select>
        </div>

        <!-- Common Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input name="name" placeholder="Full Name"
                class="input text-base bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none">

            <input name="phone" maxlength="10" placeholder="Phone Number"
                class="input text-base bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none">

            <input name="email" placeholder="Email Address (optional)"
                class="input text-base bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none md:col-span-2">
        </div>

        <!-- Astrologer Fields -->
        <div id="astrologer-fields" class="hidden">
            <h3 class="text-xl font-semibold mb-4 text-purple-400">Astrologer Details</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input name="expertise" placeholder="Expertise (Vedic, Tarot, Numerology)"
                    class="input text-base bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none">

                <input name="experience_years" type="number" placeholder="Years of Experience"
                    class="input text-base bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none">

                <textarea name="bio" placeholder="Short Bio"
                    class="input text-base bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none md:col-span-2"></textarea>
            </div>
        </div>

        <!-- Password Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Password -->
            <div class="relative">
                <input type="password" id="password" name="password" placeholder="Password"
                    class="input w-full text-base bg-white/5 border border-white/10 rounded-xl px-4 py-3 pr-12 focus:outline-none">
                
                <button type="button" onclick="togglePassword('password', this)"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-xl px-2 text-gray-400 hover:text-purple-400">
                    👁
                </button>
            </div>

            <!-- Confirm Password -->
            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"
                    class="input w-full text-base bg-white/5 border border-white/10 rounded-xl px-4 py-3 pr-12 focus:outline-none"
                    oninput="checkPasswordMatch()">

                <button type="button" onclick="togglePassword('password_confirmation', this)"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-xl px-2 text-gray-400 hover:text-purple-400">
                    👁
                </button>
            </div>

        </div>

        <!-- Password Match Message -->
        <p id="password-message" class="mt-2 text-sm hidden"></p>

        <!-- Submit Button -->
        <button
            class="w-full mt-4 sm:mt-6 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 py-3 sm:py-4 rounded-xl font-bold text-base sm:text-lg shadow-xl transition">
            Create Account
        </button>

        <p class="text-center text-gray-400 text-sm mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-400 font-semibold hover:text-purple-300">Login</a>
        </p>

    </form>
</div>

<!-- Scripts -->
<script>
    const role = document.getElementById('role');
    const astroFields = document.getElementById('astrologer-fields');

    role.addEventListener('change', () => {
        astroFields.classList.toggle('hidden', role.value !== 'astrologer');
    });

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
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('password_confirmation').value;
        const msg = document.getElementById('password-message');

        if (!confirm) {
            msg.classList.add('hidden');
            return;
        }

        msg.classList.remove('hidden');

        if (password === confirm) {
            msg.textContent = "Passwords match ✔";
            msg.className = "mt-2 text-sm text-green-400";
        } else {
            msg.textContent = "Passwords do not match ✖";
            msg.className = "mt-2 text-sm text-red-400";
        }
    }
</script>

</body>
</html>
