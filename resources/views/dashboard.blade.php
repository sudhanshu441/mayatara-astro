<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Explore community insights on Vedic astrology, horoscopes, planetary transits, numerology and tarot. Connect with astrologers and trending predictions.">
  <title>Mayatara – Community Feed</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root {
      --primary: #6366f1;
      --primary-light: #818cf8;
      --secondary: #8b5cf6;
      --accent: #06b6d4;
      --success: #10b981;
      --bg-primary: #ffffff;
      --bg-secondary: #f8fafc;
      --bg-tertiary: #f1f5f9;
      --text-primary: #1e293b;
      --text-secondary: #64748b;
      --text-tertiary: #94a3b8;
      --border: #e2e8f0;
    }

    * {
      scrollbar-width: thin;
      scrollbar-color: var(--border) transparent;
    }

    *::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    *::-webkit-scrollbar-track {
      background: transparent;
    }

    *::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 4px;
    }

    *::-webkit-scrollbar-thumb:hover {
      background: #cbd5e1;
    }

    body {
      background: var(--bg-secondary);
      color: var(--text-primary);
    }

    .gradient-primary {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    }

    .gradient-light {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
    }

    .card-hover {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-hover:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    .community-card {
      border-radius: 12px;
      border: 1px solid var(--border);
      background: var(--bg-primary);
      overflow: hidden;
      cursor: pointer;
    }

    .community-card:hover {
      border-color: var(--primary);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    }

    .post-card {
      background: var(--bg-primary);
      border: 1px solid var(--border);
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .post-card:hover {
      border-color: var(--primary);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .badge {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-primary {
      background: rgba(99, 102, 241, 0.1);
      color: var(--primary);
    }

    .badge-success {
      background: rgba(16, 185, 129, 0.1);
      color: var(--success);
    }

    .avatar-circle {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--bg-secondary);
    }

    .like-button {
      transition: all 0.2s ease;
    }

    .like-button:hover {
      transform: scale(1.1);
    }

    .like-button.liked svg {
      fill: #ef4444;
      color: #ef4444;
    }
  </style>
</head>

<body class="bg-slate-50">
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
          <div class="flex items-center gap-3 cursor-pointer">
            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-slate-200 flex-shrink-0">
              <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200" alt="Profile" />
            </div>
            <p class="hidden sm:block text-sm font-semibold text-slate-900">{{ session('user_name', 'User') }}</p>
          </div>

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

  <!-- MAIN CONTENT -->
  <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="mb-12">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
        <div>
          <h2 class="text-3xl md:text-3xl font-bold text-slate-900 mb-2">Discover insights from astrologers around the world</h2>
          <!-- <p class="text-lg text-slate-600">Discover insights from astrologers around the world</p> -->
        </div>
        <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 px-6 py-3 gradient-primary text-white rounded-lg font-semibold hover:shadow-lg transition-all">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14M5 12h14"></path>
          </svg>
          Create Post
        </a>
      </div>

      <!-- Communities Section (YouTube Style) -->
      <div class="mb-10">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-2xl font-bold text-slate-900">Trending Communities</h2>
          <a href="#" class="text-primary font-semibold text-sm hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
          @php
            $communities = [
              ['name' => 'Vedic Astrology', 'emoji' => '🌟', 'color' => 'from-blue-100 to-blue-50'],
              ['name' => 'Horoscopes', 'emoji' => '♈', 'color' => 'from-purple-100 to-purple-50'],
              ['name' => 'Numerology', 'emoji' => '🔢', 'color' => 'from-pink-100 to-pink-50'],
              ['name' => 'Tarot', 'emoji' => '🃏', 'color' => 'from-orange-100 to-orange-50'],
              ['name' => 'Planetary Transit', 'emoji' => '🪐', 'color' => 'from-green-100 to-green-50'],
              ['name' => 'Zodiac Signs', 'emoji' => '♋', 'color' => 'from-red-100 to-red-50'],
            ];
          @endphp

          @foreach($communities as $community)
          <div class="community-card gradient-light border border-slate-200 p-4 text-center hover:shadow-md">
            <div class="text-3xl mb-2">{{ $community['emoji'] }}</div>
            <h3 class="font-semibold text-slate-900 text-sm">{{ $community['name'] }}</h3>
            <p class="text-xs text-slate-500 mt-1">Join now</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Main Feed Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Left Section - Filters (Desktop) -->
      <aside class="hidden lg:block">
        <div class="bg-white rounded-lg border border-slate-200 p-5 sticky top-24">
          <h3 class="text-lg font-bold text-slate-900 mb-4">Filters</h3>
          
          @php
            $currentSort = request('sort', 'newest');
            $currentTopic = request('topic');
          @endphp

          <div class="space-y-6">
            <!-- Sort By -->
            <div>
              <p class="text-xs font-semibold uppercase text-slate-600 mb-3">Sort By</p>
              <div class="space-y-2">
                @foreach(['newest' => 'Newest First', 'popular' => 'Most Popular', 'trending' => 'Trending'] as $sortKey => $label)
                <button onclick="applyFilters({ sort: '{{ $sortKey }}' }}"
                  class="w-full px-3 py-2 rounded-lg border text-sm font-medium text-left transition-all
                  {{ $currentSort === $sortKey ? 'gradient-primary text-white border-primary' : 'border-slate-200 text-slate-700 hover:border-slate-300' }}">
                  {{ $label }}
                </button>
                @endforeach
              </div>
            </div>

            <!-- Topics -->
            <div>
              <p class="text-xs font-semibold uppercase text-slate-600 mb-3">Topics</p>
              <div class="space-y-2">
                @foreach(['Vedic Astrology', 'Horoscopes', 'Numerology', 'Tarot'] as $topic)
                <button onclick="applyFilters({ topic: '{{ $topic }}' }}"
                  class="w-full px-3 py-2 rounded-lg border text-sm font-medium text-left transition-all
                  {{ $currentTopic === $topic ? 'gradient-primary text-white border-primary' : 'border-slate-200 text-slate-700 hover:border-slate-300' }}">
                  {{ $topic }}
                </button>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </aside>

      <!-- Center Section - Posts Feed -->
      <div class="lg:col-span-2">
        <div class="space-y-6">
          @forelse ($posts as $post)
          <article class="post-card p-6 md:p-8 card-hover">
            <!-- Post Header -->
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-center gap-3 flex-1">
                <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200" alt="Author" class="avatar-circle" />
                <div>
                  <p class="font-semibold text-slate-900">{{ $post->user->name ?? session('user_name', 'Astrologer') }}</p>
                  <p class="text-xs text-slate-500">{{ $post->created_at->diffForHumans() }}</p>
                </div>
              </div>
              <span class="badge badge-primary">Astrologer</span>
            </div>

            <!-- Post Content -->
            <a href="{{ route('posts.show', $post->id) }}">
              <h3 class="text-xl font-bold text-slate-900 mb-2 hover:text-primary transition">{{ $post->title }}</h3>
            </a>
            <p class="text-slate-600 mb-4">{{ Str::limit(strip_tags($post->content), 160) }}</p>

            <!-- Post Image -->
            @if(!empty($post->media))
            <div class="rounded-lg overflow-hidden mb-5 border border-slate-200">
              <img src="{{ url('public/' . $post->media[0]) }}" alt="{{ $post->media_alt }}" class="w-full h-80 object-cover" />
            </div>
            @endif

            <!-- Tags -->
            @if($post->tags)
            <div class="flex flex-wrap gap-2 mb-4">
              @foreach ($post->tags as $tag)
              <span class="badge badge-success">#{{ $tag }}</span>
              @endforeach
            </div>
            @endif

            <!-- Post Footer - Interactions -->
            <div class="flex items-center gap-6 text-slate-600 border-t border-slate-200 pt-4">
              @php
                $userLiked = $post->likes->contains('user_id', session('user_id'));
              @endphp

              <!-- Like -->
              <button onclick="toggleLike({{ $post->id }})" class="like-button flex items-center gap-2 hover:text-primary transition {{ $userLiked ? 'liked' : '' }}">
                <svg id="like-icon-{{ $post->id }}" class="w-5 h-5" viewBox="0 0 24 24" fill="{{ $userLiked ? '#ef4444' : 'none' }}" stroke="{{ $userLiked ? '#ef4444' : 'currentColor' }}" stroke-width="2">
                  <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>
                </svg>
                <span id="like-count-{{ $post->id }}" class="text-sm font-medium">{{ $post->likes->count() }}</span>
              </button>

              <!-- Comments -->
              <a href="{{ route('posts.show', $post->id) }}" class="flex items-center gap-2 hover:text-primary transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
                </svg>
                <span class="text-sm font-medium">{{ $post->comments_count ?? $post->comments->count() }}</span>
              </a>

              <!-- Share -->
              <button class="flex items-center gap-2 hover:text-primary transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 2L11 13M22 2l-7 20-5-9-9-5 20-7z"></path>
                </svg>
                <span class="text-sm font-medium">Share</span>
              </button>
            </div>
          </article>
          @empty
          <div class="post-card p-12 text-center">
            <p class="text-slate-500">No posts yet. Be the first to share!</p>
          </div>
          @endforelse
        </div>
      </div>

      <!-- Right Section - Trending & Recommendations (YouTube Style) -->
      <aside class="hidden lg:block">
        <div class="bg-white rounded-lg border border-slate-200 p-5 sticky top-24">
          <h3 class="text-lg font-bold text-slate-900 mb-4">Trending Now</h3>
          <div class="space-y-4">
            @php
              $trendingTopics = [
                ['title' => 'Mercury Retrograde Effects', 'views' => '12.5K', 'icon' => '📅'],
                ['title' => 'Aries Season Predictions', 'views' => '8.3K', 'icon' => '♈'],
                ['title' => 'Full Moon Rituals', 'views' => '6.7K', 'icon' => '🌕'],
                ['title' => 'Career Numerology Guide', 'views' => '5.2K', 'icon' => '✨'],
              ];
            @endphp

            @foreach($trendingTopics as $trend)
            <div class="p-3 rounded-lg hover:bg-slate-50 cursor-pointer transition">
              <div class="flex items-start gap-3">
                <span class="text-2xl">{{ $trend['icon'] }}</span>
                <div class="flex-1">
                  <p class="font-semibold text-slate-900 text-sm">{{ $trend['title'] }}</p>
                  <p class="text-xs text-slate-500 mt-1">{{ $trend['views'] }} views</p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <!-- Popular Communities -->
        <div class="bg-white rounded-lg border border-slate-200 p-5 mt-6 sticky top-80">
          <h3 class="text-lg font-bold text-slate-900 mb-4">Popular Astrologers</h3>
          <div class="space-y-3">
            @php
              $astrologers = [
                ['name' => 'Sarah Celestial', 'specialty' => 'Vedic Astrology', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200'],
                ['name' => 'Marcus Starseeker', 'specialty' => 'Tarot Reader', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200'],
                ['name' => 'Luna Numerologist', 'specialty' => 'Numerology Expert', 'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200'],
              ];
            @endphp

            @foreach($astrologers as $astrologer)
            <div class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-lg transition cursor-pointer">
              <div class="flex items-center gap-3 flex-1">
                <img src="{{ $astrologer['avatar'] }}" alt="{{ $astrologer['name'] }}" class="w-10 h-10 rounded-full object-cover" />
                <div>
                  <p class="font-semibold text-slate-900 text-sm">{{ $astrologer['name'] }}</p>
                  <p class="text-xs text-slate-500">{{ $astrologer['specialty'] }}</p>
                </div>
              </div>
              <button class="text-primary font-semibold text-xs hover:bg-primary/10 px-2 py-1 rounded transition">Follow</button>
            </div>
            @endforeach
          </div>
        </div>
      </aside>
    </div>
  </main>

  <!-- Mobile Navigation -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 z-40">
    <div class="flex items-center justify-around h-16">
      <a href="#" class="flex flex-col items-center gap-1 px-4 py-2 text-primary">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
        </svg>
        <span class="text-xs font-medium">Feed</span>
      </a>
      <a href="{{ route('posts.create') }}" class="flex flex-col items-center gap-1 px-4 py-2 text-slate-600 hover:text-primary">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 5v14M5 12h14"></path>
        </svg>
        <span class="text-xs font-medium">Create</span>
      </a>
      <button onclick="openMobileFilters()" class="flex flex-col items-center gap-1 px-4 py-2 text-slate-600 hover:text-primary">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 6h18M7 12h10M10 18h4"></path>
        </svg>
        <span class="text-xs font-medium">Filter</span>
      </button>
    </div>
  </nav>

  <!-- Like Toggle Script -->
  <script>
    let filters = {
      sort: "{{ request('sort', 'newest') }}",
      topic: "{{ request('topic') }}"
    };

    function applyFilters(newFilters = {}) {
      Object.keys(newFilters).forEach(key => {
        if (filters[key] === newFilters[key]) {
          delete filters[key];
        } else {
          filters[key] = newFilters[key];
        }
      });

      if (!filters.sort) {
        filters.sort = 'newest';
      }

      const query = new URLSearchParams(filters).toString();
      fetch(`{{ route('dashboard') }}?${query}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.text())
      .then(html => {
        document.getElementById('postsContainer').innerHTML = html;
        window.history.pushState({}, '', `?${query}`);
      })
      .catch(err => console.error(err));
    }

    function toggleLike(postId) {
      let url = "{{ route('posts.like', ':id') }}";
      url = url.replace(':id', postId);

      fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
        },
      })
      .then(response => {
        if (!response.ok) throw new Error('Not logged in');
        return response.json();
      })
      .then(data => {
        const icon = document.getElementById(`like-icon-${postId}`);
        const count = document.getElementById(`like-count-${postId}`);
        const button = icon.closest('.like-button');

        if (data.liked) {
          icon.setAttribute('fill', '#ef4444');
          icon.setAttribute('stroke', '#ef4444');
          button.classList.add('liked');
        } else {
          icon.setAttribute('fill', 'none');
          icon.setAttribute('stroke', 'currentColor');
          button.classList.remove('liked');
        }

        count.innerText = data.likes_count;
      })
      .catch(err => {
        alert('Please login to like this post');
        console.error(err);
      });
    }

    function openMobileFilters() {
      alert('Filter functionality for mobile');
    }

    function confirmLogout() {
      return confirm('Are you sure you want to logout?');
    }
  </script>
</body>

</html>
