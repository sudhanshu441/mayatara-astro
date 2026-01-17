<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="@yield('meta_description', 'Create your own astrology post on Mayatara: share insights on zodiac, horoscopes, numerology, tarot and Vedic astrology with the community.')">

    <title>@yield('title', 'Create Post | Mayatara Premium')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Quill Editor --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    {{-- Page Styles --}}
   <style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: radial-gradient(circle at top right, #efe5e5ff, #e0e0e0 40%);
        background-attachment: fixed;
        color: #111827;
    }

    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .ql-toolbar.ql-snow {
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
        background: rgba(255, 255, 255, 0.9);
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        padding: 12px !important;
        color: #111827;
    }

    .ql-container.ql-snow {
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
        height: 300px;
        color: #111827;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        background: rgba(255, 255, 255, 0.8);
    }

    .ql-editor::before {
        color: #9ca3af !important; /* placeholder color */
    }

    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f3f4f6;
    }

    ::-webkit-scrollbar-thumb {
        background: #a855f7; /* keep accent color */
        border-radius: 10px;
    }

    .tag-chip {
        animation: fadeIn 0.2s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .modal-overlay {
        transition: opacity 0.3s ease-in-out;
    }

    .modal-content-wrapper {
        transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    }

    .modal-overlay.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .modal-overlay.hidden .modal-content-wrapper {
        transform: scale(0.95);
        opacity: 0;
    }

    .drag-over {
        border-color: #a855f7 !important;
        background: rgba(168, 85, 247, 0.05) !important;
    }

    .media-preview-item {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


</head>
<body class="text-gray-100 min-h-screen">

  <!-- HEADER -->
  <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-slate-200">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="h-16 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 cursor-pointer">
          <img src="{{ asset('public/logofiles/png/logo.png') }}"
     alt="Logo"
     style="width:80px;">
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center gap-1">
          <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-100 transition-colors">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span class="text-sm font-medium">Feed</span>
          </a>
          <a href="{{ route('posts.create') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-100 transition-colors">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 5v14M5 12h14"></path>
            </svg>
            <span class="text-sm font-medium">Create</span>
          </a>
        </nav>

        <!-- Right Section -->
        <div class="flex items-center gap-4">
          <!-- Profile -->
         <a href="{{ route('profile.show') }}">
  <div class="flex items-center gap-3 cursor-pointer">
    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-slate-200 flex-shrink-0">
      <img class="w-full h-full object-cover"
           src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200"
           alt="Profile" />
    </div>
    <p class="hidden sm:block text-sm font-semibold text-slate-900">
      {{ session('user_name', 'User') }}
    </p>
  </div>
</a>


          <!-- Logout -->
          <form method="POST" action="{{ route('logout') }}" onsubmit="return confirmLogout();" class="hidden sm:block">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 font-medium text-sm transition">
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </header>
@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 p-4">
        <ul class="list-disc list-inside text-sm text-red-400">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div class="mb-6 rounded-xl border border-green-500/30 bg-green-500/10 p-4 text-green-400">
        {{ session('success') }}
    </div>
@endif

  <!-- MOBILE BOTTOM NAV -->
  <nav
    class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-[rgba(11,16,35,0.95)] backdrop-blur-xl border-t border-white/10">
    <div class="flex items-center justify-around h-16">
      <a href="{{ route('dashboard') }}"
        class="flex flex-col items-center gap-1 px-3 py-2 text-white bg-transparent border-none cursor-pointer transition-colors">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
          <path
            d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
        </svg>
        <span class="text-xs font-medium">Home</span>
      </a>

      <a href="{{ route('posts.create') }}"
        class="flex flex-col items-center gap-1 px-3 py-2 text-white/60 bg-transparent border-none cursor-pointer transition-colors">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
          <path
            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
        </svg>
        <span class="text-xs font-medium">Create</span>
      </a>
    </div>
  </nav>


  <main class="max-w-7xl mx-auto px-4 md:px-6 py-20">
    <div class="flex flex-col lg:flex-row gap-10">

      <div class="flex-1 space-y-8">
        <header>
          <h1 class="text-3xl font-extrabold text-black mb-2 tracking-tight">Compose Insights</h1>
          <p class="text-black">What do the stars have in store today?</p>
        </header>
@php
    // Check for community ID either from route parameter OR query string
    $communityId = request()->route('communityId') ?? request()->query('community_id');
@endphp

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($communityId)
        <div class="mb-4">
            <input 
                   name="community_id" 
                   type="hidden"
                   id="community_id" 
                   value="{{ $communityId }}" 
                   class="w-full bg-black text-white border border-white/10 rounded-xl px-4 py-2"
            >
        </div>
    @endif

    <!-- rest of your form fields -->


    <!-- rest of your form fields -->


        <!-- rest of your form fields -->
    @csrf
    <div class="glass rounded-3xl md:p-8 p-4 shadow-2xl">
        <div class="space-y-6">
            <!-- Title -->
            <div>
                <input type="text" name="title" id="post-title" placeholder="Title of your mystical journey..."
                    class="w-full bg-transparent border-b border-white/10 pb-4 text-3xl font-bold focus:outline-none focus:border-purple-500 transition-colors placeholder:text-gray-600"
                    required>
            </div>

            <!-- Media Upload Area -->
            <div class="relative">
                <input type="file" name="media[]" id="media-upload" class="hidden" accept="image/*,video/*" multiple>
                <div id="drop-zone"
                    class="border-2 border-dashed border-white/10 rounded-2xl p-8 text-center hover:bg-white/5 hover:border-purple-500/50 transition-all cursor-pointer">
                    <div id="upload-prompt">
                        <div
                            class="w-16 h-16 bg-purple-500/10 rounded-full flex items-center justify-center mb-4 mx-auto hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <p class="text-lg font-semibold text-gray-300 mb-1">Add Images or Video</p>
                        <p class="text-sm text-gray-500 mb-3">Drag & drop or click to upload</p>
                        <p class="text-xs text-gray-600">Multiple images or 1 video (MP4, WebM)</p>
                    </div>
                </div>

                <!-- Media Preview -->
                <div id="media-preview-container" class="hidden mt-4 grid grid-cols-2 md:grid-cols-3 gap-4"></div>
            </div>

            <!-- Category and Visibility -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-purple-400">Category</label>
                  <select name="category" id="post-category"
    class="w-full bg-black text-white border border-white/10 rounded-xl px-4 py-3
           focus:outline-none focus:ring-2 focus:ring-purple-500/50 appearance-none"
    required>
    <option value="">Select Category</option>
    <option value="Daily Horoscope">Daily Horoscope</option>
    <option value="Planetary Alignment">Planetary Alignment</option>
    <option value="Tarot Reading">Tarot Reading</option>
</select>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-purple-400">Visibility</label>
                   <select name="visibility" id="post-visibility"
    class="w-full bg-black text-white border border-white/10 rounded-xl px-4 py-3
           focus:outline-none focus:ring-2 focus:ring-purple-500/50 appearance-none"
    required>
    <option value="public">Public</option>
    <option value="followers">Followers Only</option>
    <option value="private">Private Draft</option>
</select>

                </div>
            </div>

            <!-- URL Slug & Media Alt -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-purple-400">URL Slug</label>
                    <div class="relative">
                        <input type="text" name="slug" id="url-slug" placeholder="e.g. daily-cosmic-forecast"
                            class="w-full bg-white/5 border border-white/10 rounded-xl pl-3 pr-16 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500/50 placeholder:text-gray-600 text-sm" />
                        <button type="button" id="auto-generate-slug"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-xs text-purple-400 hover:text-purple-300 font-semibold">Auto</button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-purple-400">Media Alt Text<span
                            class="text-red-400">*</span></label>
                    <input type="text" name="media_alt" id="media-alt" placeholder="Describe the media for accessibility"
                        class="w-full bg-white/5 border border-white/10 rounded-xl pl-3 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500/50 placeholder:text-gray-600 text-sm" />
                </div>
            </div>

            <!-- Tags -->
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-purple-400">Tags</label>
                <input type="text" name="tags" id="tag-input" placeholder="Comma separated tags"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500/50 text-sm" />
            </div>

            <!-- Content Body -->
             <!-- Content Body -->
            <div class="space-y-2">
              <label class="text-xs font-bold uppercase tracking-widest text-purple-400">Content Body</label>
              
                <div id="editor-container" class="bg-white rounded-xl text-black"></div>

  <!-- Hidden input for Laravel -->
  <input type="hidden" name="content" id="post-content">

            </div>

            <!-- Zodiac Symbols -->
            <div
              class="flex md:flex-row flex-col md:items-center items-start gap-4 bg-white/5 p-4 rounded-2xl border border-white/5">
              <span class="text-[10px] font-bold text-gray-500 uppercase ">Insert Symbol</span>
              <div class="flex flex-wrap gap-3 text-xl text-purple-300">
                <button aria-label="symbol-btn" type="button" data-symbol="♈"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♈</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♉"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♉</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♊"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♊</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♋"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♋</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♌"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♌</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♍"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♍</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♎"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♎</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♏"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♏</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♐"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♐</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♑"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♑</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♒"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♒</button>
                <button aria-label="symbol-btn" type="button" data-symbol="♓"
                  class="symbol-btn w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-purple-600/40 hover:text-white hover:-translate-y-0.5 transition-all border border-white/10">♓</button>
              </div>
            </div>

            <!-- Allow Comments -->
           
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap items-center justify-between gap-4 glass p-4 rounded-3xl mt-4">
          <div class="flex gap-2">
           <button type="submit"
            class="bg-purple-600 hover:bg-purple-500 text-white px-8 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-purple-600/25 active:scale-95">
            Publish Now
        </button>
       
        <button type="button" id="preview-btn"
            class="bg-white/5 hover:bg-white/10 px-6 py-3 rounded-2xl font-semibold transition">Preview</button>
          </div>
             <div class="flex items-center gap-6">
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="allow_comments" checked class="w-5 h-5 rounded-md border-white/10 bg-white/5">
                    <span class="text-sm text-gray-400">Allow Comments</span>
                </label>
            </div>
        <button type="reset"
            class="text-gray-500 hover:text-red-400 transition font-medium">Discard</button>
          </div>
    </div>
</form>

      </div>

      <!-- Sidebar -->
      <aside class="w-full lg:w-96 space-y-6">
        <div class="glass rounded-3xl p-6 relative overflow-hidden group">
          <div
            class="absolute -top-10 -right-10 w-32 h-32 bg-orange-500/10 blur-3xl rounded-full transition-all group-hover:bg-orange-500/20">
          </div>
          <h3 class="text-orange-400 font-bold flex items-center gap-2 mb-6">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            CREATIVE TIPS
          </h3>
          <div class="space-y-6">
            <div class="group/item">
              <h4 class="text-sm font-bold text-gray-200 mb-1 group-hover/item:text-orange-300 transition">Engagement
                Hub</h4>
              <p class="text-xs text-gray-400 leading-relaxed">Ask a question at the end of your post to start a cosmic
                conversation.</p>
            </div>
            <div class="group/item border-t border-white/5 pt-4">
              <h4 class="text-sm font-bold text-gray-200 mb-1 group-hover/item:text-orange-300 transition">Visual Magic
              </h4>
              <p class="text-xs text-gray-400 leading-relaxed">Posts with charts or planetary images get 4x more
                mystical attention.</p>
            </div>
          </div>
        </div>

        <div
          class="bg-gradient-to-br from-purple-900/40 to-blue-900/40 border border-white/10 rounded-3xl p-8 text-center">
          <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl">👁️</span>
          </div>
          <h3 class="font-bold mb-2">Community Shield</h3>
          <p class="text-xs text-gray-400 mb-4 italic">"Respect the cosmic flow. Avoid medical claims and keep the
            vibrations positive."</p>
          <button aria-label="full Guidelines"
            class="text-[10px] font-bold uppercase tracking-widest text-purple-300 hover:text-white transition">Read
            Full Guidelines</button>
        </div>
      </aside>
    </div>
  </main>

  <!-- Preview Modal -->
  <div id="preview-modal"
    class="modal-overlay hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="modal-content-wrapper glass rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
      <div class="flex items-center justify-between p-6 border-b border-white/10">
        <h2 class="text-2xl font-bold text-white">Preview Post</h2>
        <button aria-label="Close Preview" id="close-modal"
          class="w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center transition-colors">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div class="p-6 space-y-6">
        <div class="flex items-center gap-3">
          <img src="https://ui-avatars.com/api/?name=Sarah+Mitchell&background=8b5cf6&color=fff"
            class="w-12 h-12 rounded-full border-2 border-purple-500/30" alt="avtar">
          <div>
            <h3 class="font-bold text-white">Sarah Mitchell</h3>
            <p class="text-sm text-gray-400">Just now</p>
          </div>
        </div>

        <h1 id="preview-title" class="text-3xl font-bold text-white">Your article title will appear here...</h1>

        <div id="preview-media-container" class="hidden">
          <!-- Media previews will be inserted here -->
        </div>

        <div id="preview-content" class="text-gray-300 leading-relaxed prose prose-invert max-w-none">
          <p>Your article content will appear here...</p>
        </div>

        <div id="preview-tags-container" class="hidden flex flex-wrap gap-2"></div>

        <div class="flex items-center gap-6 pt-4 border-t border-white/10">
          <button aria-label="Like" class="flex items-center gap-2 text-gray-400 hover:text-purple-400 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <span class="font-semibold">0</span>
          </button>
          <button aria-label="Comment" class="flex items-center gap-2 text-gray-400 hover:text-blue-400 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span class="font-semibold">0</span>
          </button>
          <button aria-label="share"
            class="flex items-center gap-2 text-gray-400 hover:text-green-400 transition ml-auto">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            <span class="font-semibold">Share</span>
          </button>
        </div>
      </div>

      <div class="p-6 border-t border-white/10 bg-white/5">
        <p class="text-sm text-gray-400 text-center mb-4">This is how your post will appear to others</p>
        <button aria-label="preview" id="close-preview-btn"
          class="w-full bg-purple-600 hover:bg-purple-500 text-white py-3 rounded-2xl font-bold transition-all">Close
          Preview</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script>
    // Initialize Editor
   var quill = new Quill('#editor-container', {
  modules: {
    toolbar: [
      [{ header: [1, 2, false] }],
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['link', 'blockquote', 'code-block'],
      ['clean']
    ]
  },
  placeholder: 'Type your celestial message here...',
  theme: 'snow'
});

// Sync editor content to hidden input
quill.on('text-change', function () {
  document.getElementById('post-content').value =
    quill.root.innerHTML;
});

    // Media Upload Management
    const mediaUploadInput = document.getElementById('media-upload');
    const dropZone = document.getElementById('drop-zone');
    const mediaPreviewContainer = document.getElementById('media-preview-container');
    const uploadedFiles = [];

    // Click to upload
    dropZone.addEventListener('click', () => {
      mediaUploadInput.click();
    });

    // Drag and drop handlers
    dropZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropZone.classList.add('drag-over');
    });

    dropZone.addEventListener('dragleave', () => {
      dropZone.classList.remove('drag-over');
    });

    dropZone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropZone.classList.remove('drag-over');
      const files = Array.from(e.dataTransfer.files);
      handleFiles(files);
    });

    mediaUploadInput.addEventListener('change', (e) => {
      const files = Array.from(e.target.files);
      handleFiles(files);
    });

    function handleFiles(files) {
      files.forEach(file => {
        if (file.type.startsWith('image/')) {
          addImagePreview(file);
        } else if (file.type.startsWith('video/')) {
          // Only one video allowed
          const existingVideo = uploadedFiles.find(f => f.type.startsWith('video/'));
          if (existingVideo) {
            alert('Only one video can be uploaded. Please remove the existing video first.');
            return;
          }
          addVideoPreview(file);
        }
      });
    }

    function addImagePreview(file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        const fileData = {
          type: file.type,
          name: file.name,
          url: e.target.result,
          id: Date.now() + Math.random()
        };
        uploadedFiles.push(fileData);
        renderMediaPreviews();
      };
      reader.readAsDataURL(file);
    }

    function addVideoPreview(file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        const fileData = {
          type: file.type,
          name: file.name,
          url: e.target.result,
          id: Date.now() + Math.random()
        };
        uploadedFiles.push(fileData);
        renderMediaPreviews();
      };
      reader.readAsDataURL(file);
    }

    function removeMedia(id) {
      const index = uploadedFiles.findIndex(f => f.id === id);
      if (index > -1) {
        uploadedFiles.splice(index, 1);
        renderMediaPreviews();
      }
    }

    function renderMediaPreviews() {
      mediaPreviewContainer.innerHTML = '';

      if (uploadedFiles.length === 0) {
        mediaPreviewContainer.classList.add('hidden');
        return;
      }

      mediaPreviewContainer.classList.remove('hidden');

      uploadedFiles.forEach((file, index) => {
        const previewItem = document.createElement('div');
        previewItem.className = 'media-preview-item relative group rounded-xl overflow-hidden border border-white/10';

        if (file.type.startsWith('image/')) {
          previewItem.innerHTML = `
                        <img src="${file.url}" class="w-full h-48 object-cover" alt="${file.name}">
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button aria-label="Remove Media" onclick="removeMedia(${file.id})" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute top-2 left-2 bg-purple-600 text-white text-xs px-2 py-1 rounded-full">
                            Image ${index + 1}
                        </div>
                    `;
        } else if (file.type.startsWith('video/')) {
          previewItem.innerHTML = `
                        <video src="${file.url}" class="w-full h-48 object-cover" controls></video>
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                            <button aria-label="remove media" onclick="removeMedia(${file.id})" class="pointer-events-auto bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                            Video
                        </div>
                    `;
        }

        mediaPreviewContainer.appendChild(previewItem);
      });
    }

    // Symbol insertion
    document.querySelectorAll('.symbol-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const symbol = btn.getAttribute('data-symbol');
        const range = quill.getSelection(true);
        if (range) {
          quill.insertText(range.index, symbol + ' ', 'user');
          quill.setSelection(range.index + symbol.length + 1);
        } else {
          const length = quill.getLength();
          quill.insertText(length, symbol + ' ', 'user');
          quill.setSelection(length + symbol.length + 1);
        }
        quill.focus();
      });
    });

    // Slug generation
    function generateSlug(text) {
      return text.toLowerCase().trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
    }

    document.getElementById('auto-generate-slug').addEventListener('click', () => {
      const title = document.getElementById('post-title').value;
      if (title) {
        document.getElementById('url-slug').value = generateSlug(title);
      }
    });

    // Tags functionality
    const tagInput = document.getElementById('tag-input');
    const tagsContainer = document.getElementById('tags-container');
    const tags = [];

    function createTagElement(tagText) {
      const tagChip = document.createElement('span');
      tagChip.className = 'tag-chip inline-flex items-center gap-1.5 bg-purple-600/20 text-purple-300 border border-purple-500/30 px-3 py-1 rounded-full text-sm font-medium';
      tagChip.innerHTML = `
                ${tagText}
                <button aria-label="Remove Tag" type="button" class="remove-tag hover:text-white transition-colors" data-tag="${tagText}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
      return tagChip;
    }

    function addTag(tagText) {
      const trimmed = tagText.trim();
      if (trimmed && !tags.includes(trimmed)) {
        tags.push(trimmed);
        const tagElement = createTagElement(trimmed);
        tagsContainer.appendChild(tagElement);

        tagElement.querySelector('.remove-tag').addEventListener('click', function () {
          const tagToRemove = this.getAttribute('data-tag');
          const index = tags.indexOf(tagToRemove);
          if (index > -1) {
            tags.splice(index, 1);
            tagElement.remove();
          }
        });
      }
    }

    tagInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' && tagInput.value) {
        e.preventDefault();
        addTag(tagInput.value);
        tagInput.value = '';
      }
    });

    tagInput.addEventListener('input', (e) => {
      const value = e.target.value;
      if (value.includes(',')) {
        const parts = value.split(',');
        parts.slice(0, -1).forEach(part => addTag(part));
        tagInput.value = parts[parts.length - 1];
      }
    });

    // Preview Modal
    const previewModal = document.getElementById('preview-modal');
    const previewBtn = document.getElementById('preview-btn');
    const closeModal = document.getElementById('close-modal');
    const closePreviewBtn = document.getElementById('close-preview-btn');

    function openPreviewModal() {
      const title = document.getElementById('post-title').value || 'Untitled Post';
      const content = quill.root.innerHTML;

      document.getElementById('preview-title').textContent = title;
      document.getElementById('preview-content').innerHTML = content;

      // Media preview
      const previewMediaContainer = document.getElementById('preview-media-container');
      previewMediaContainer.innerHTML = '';

      if (uploadedFiles.length > 0) {
        if (uploadedFiles.length === 1) {
          const file = uploadedFiles[0];
          if (file.type.startsWith('image/')) {
            previewMediaContainer.innerHTML = `
                            <div class="rounded-2xl overflow-hidden border border-white/10">
                                <img src="${file.url}" class="w-full h-96 object-cover" alt="Post image">
                            </div>
                        `;
          } else if (file.type.startsWith('video/')) {
            previewMediaContainer.innerHTML = `
                            <div class="rounded-2xl overflow-hidden border border-white/10">
                                <video src="${file.url}" class="w-full h-96 object-cover" controls></video>
                            </div>
                        `;
          }
        } else {
          previewMediaContainer.innerHTML = '<div class="grid grid-cols-2 gap-3">';
          uploadedFiles.forEach(file => {
            if (file.type.startsWith('image/')) {
              previewMediaContainer.innerHTML += `
                                <div class="rounded-xl overflow-hidden border border-white/10">
                                    <img src="${file.url}" class="w-full h-48 object-cover" alt="Post image">
                                </div>
                            `;
            }
          });
          previewMediaContainer.innerHTML += '</div>';
        }
        previewMediaContainer.classList.remove('hidden');
      } else {
        previewMediaContainer.classList.add('hidden');
      }

      // Tags preview
      const previewTagsContainer = document.getElementById('preview-tags-container');
      previewTagsContainer.innerHTML = '';
      if (tags.length > 0) {
        tags.forEach(tag => {
          const tagSpan = document.createElement('span');
          tagSpan.className = 'bg-purple-600/20 text-purple-300 border border-purple-500/30 px-3 py-1 rounded-full text-sm font-medium';
          tagSpan.textContent = '#' + tag;
          previewTagsContainer.appendChild(tagSpan);
        });
        previewTagsContainer.classList.remove('hidden');
      } else {
        previewTagsContainer.classList.add('hidden');
      }

      previewModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closePreviewModal() {
      previewModal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    previewBtn.addEventListener('click', openPreviewModal);
    closeModal.addEventListener('click', closePreviewModal);
    closePreviewBtn.addEventListener('click', closePreviewModal);

    previewModal.addEventListener('click', (e) => {
      if (e.target === previewModal) {
        closePreviewModal();
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !previewModal.classList.contains('hidden')) {
        closePreviewModal();
      }
    });
  </script>
</body>
</html>
