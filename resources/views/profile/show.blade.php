<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Profile – Mayatara</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: #f8fafc;
      color: #1e293b;
    }
  </style>
</head>

<body class="min-h-screen">

<!-- ===== Header ===== -->
<div class="bg-white border-b">
  <div class="max-w-5xl mx-auto px-4 py-4 flex items-center gap-3">
    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200"
         class="w-12 h-12 rounded-full object-cover border">
    <div>
      <h1 class="font-bold text-lg">{{ $user->name }}</h1>
      <p class="text-sm text-gray-500">{{ $user->email }}</p>
    </div>
  </div>
</div>

<!-- ===== Content ===== -->
<div class="max-w-5xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6">

  <!-- ===== Profile Update ===== -->
  <div class="md:col-span-1 bg-white border rounded-xl p-5">
    <h2 class="font-semibold text-lg mb-4">Edit Profile</h2>

    @if(session('success'))
      <p class="mb-3 text-green-600 text-sm">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-3">
      @csrf

      <input type="text" name="name"
             value="{{ $user->name }}"
             class="w-full border rounded px-3 py-2"
             placeholder="Name">

      <input type="text" name="phone"
             value="{{ $user->phone }}"
             class="w-full border rounded px-3 py-2"
             placeholder="Phone">

      <textarea name="bio"
                class="w-full border rounded px-3 py-2"
                rows="4"
                placeholder="Bio">{{ $user->bio }}</textarea>

      <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
        Update Profile
      </button>
    </form>
  </div>

  <!-- ===== Right Side ===== -->
  <div class="md:col-span-2 space-y-6">

    <!-- ===== My Communities ===== -->
    <div class="bg-white border rounded-xl p-5">
      <h2 class="font-semibold text-lg mb-4">My Communities</h2>

      @forelse($communities as $community)
        <div class="flex items-center justify-between border rounded-lg p-3 mb-3">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 flex items-center justify-center bg-indigo-50 rounded-full text-lg">
              {{ $community->icon }}
            </div>
            <div>
              <p class="font-semibold">{{ $community->name }}</p>
              <p class="text-xs text-gray-500">
                Created {{ $community->created_at->diffForHumans() }}
              </p>
            </div>
          </div>

          <form method="POST"
                action="{{ route('community.delete', $community->id) }}"
                onsubmit="return confirm('Delete this community?')">
            @csrf
            @method('DELETE')
            <button class="text-red-600 text-sm hover:underline">
              Delete
            </button>
          </form>
        </div>
      @empty
        <p class="text-gray-500">No communities created yet.</p>
      @endforelse
    </div>

    <!-- ===== Join Requests ===== -->
    <div class="bg-white border rounded-xl p-5">
      <h2 class="font-semibold text-lg mb-4">Community Join Requests</h2>

      @forelse($joinRequests as $request)
        <div class="flex items-center justify-between border rounded-lg p-3 mb-3">
          <div>
            <p class="font-semibold">{{ $request->user->name }}</p>
            <p class="text-sm text-gray-500">
              Wants to join:
              <span class="font-semibold">{{ $request->community->name }}</span>
            </p>
          </div>

          @if($request->status === 'pending')
            <div class="flex gap-2">
              <form method="POST" action="{{ route('community.request.approve', $request->id) }}">
                @csrf
                <button class="text-green-600 text-sm font-semibold">
                  Approve
                </button>
              </form>

              <form method="POST" action="{{ route('community.request.reject', $request->id) }}">
                @csrf
                <button class="text-red-600 text-sm font-semibold">
                  Reject
                </button>
              </form>
            </div>
          @else
            <span class="text-sm text-gray-500">
              {{ ucfirst($request->status) }}
            </span>
          @endif
        </div>
      @empty
        <p class="text-gray-500">No join requests.</p>
      @endforelse
    </div>

  </div>
</div>

</body>
</html>
