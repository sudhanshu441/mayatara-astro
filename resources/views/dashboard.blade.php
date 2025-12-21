<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Explore community insights on Vedic astrology, horoscopes, planetary transits, numerology and tarot. Connect with astrologers and trending predictions.">
  <title>Mayatara – Community Feed</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Custom scrollbar styling */
    .filters-content::-webkit-scrollbar {
      width: 5px;
    }

    .filters-content::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
    }

    .filters-content::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 10px;
    }

    .filters-content::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    /* Smooth transitions for sticky sidebar */
    .filters-card-wrapper {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Floating action button styles */
    .fab-button {
      box-shadow: 0 8px 24px rgba(88, 28, 135, 0.4);
      transition: all 0.3s ease;
    }

    .fab-button:hover {
      transform: scale(1.05);
      box-shadow: 0 12px 32px rgba(88, 28, 135, 0.6);
    }

    .fab-button:active {
      transform: scale(0.95);
    }
  </style>
</head>

<body class="bg-[#070A1A]">
  <!-- HEADER -->
  <header class="sticky top-0 z-50 bg-[rgba(11,16,35,0.4)] backdrop-blur-xl border-b border-white/10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="h-16 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2 cursor-pointer">
          <img class="w-8 h-8" src="{{ url('public\star.png') }}"   alt="Mayatara" />
          <h1 class="text-lg sm:text-xl font-bold text-white">Mayatara</h1>
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center gap-2">
          <a href="#"
            class="flex items-center gap-2 px-3 py-2 rounded-md text-white/70 hover:bg-white/5 transition-colors cursor-pointer">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
              <path
                d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            </svg>
            <span>Feed</span>
          </a>
          <a  href="{{ route('posts.create') }}">
            <button aria-label="Create Post" type="button"
              class="flex items-center gap-2 px-3 py-2 rounded-md text-white/70 hover:bg-white/5 transition-colors cursor-pointer">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                <path
                  d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
              </svg>
              <span>Create</span>
            </button>
          </a>
        </nav>

        <!-- Profile -->
        <a href="{{route('login')}}">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full overflow-hidden cursor-pointer border-2 border-white/10">
              <img class="w-full h-full object-cover"
                src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200" alt="Profile" />
            </div>
            <p class="hidden sm:block text-base font-semibold text-white">Abhishek Kumar</p>
          </div>
        </a>
      </div>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 lg:py-10 pb-20 md:pb-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
      <div>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Community Feed</h1>
        <p class="text-base md:text-lg text-white/70">Discover insights from astrologers around the world</p>
      </div>

      <!-- Create Post Button (Desktop) -->
      <a  href="{{ route('posts.create') }}">
        <button aria-label="create" type="button"
          class="hidden md:inline-flex items-center gap-3 px-4 py-2 rounded-xl border border-white/10 bg-gradient-to-r from-[#2C1B74] to-[#17123B] text-white text-sm font-semibold shadow-[0_14px_40px_rgba(44,27,116,0.35)] hover:brightness-110 active:scale-[0.98] transition-all duration-300 cursor-pointer">
          <span class="grid place-items-center w-9 h-9 rounded-lg bg-white/10 border border-white/10">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 20h9" />
              <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4 11.5-11.5Z" />
            </svg>
          </span>
          Create Post
        </button>
      </a>
    </div>

    <div class="flex gap-6 lg:gap-8 items-start relative">
      <!-- SIDEBAR (Desktop) -->
      <aside id="sidebarContainer" class="hidden lg:block w-[280px] shrink-0">
        <div id="filtersSpacer"></div>
        <div id="filtersCard"
          class="filters-card-wrapper rounded-2xl border border-white/10 bg-gradient-to-b from-[#15183A] to-[#0B0E22] p-5 shadow-[0_20px_60px_rgba(0,0,0,0.55)]">
          <h2 class="text-lg font-semibold mb-4 text-white/90">Filters</h2>

          <div class="space-y-5">
            <!-- Sort By -->
            <div>
              <p class="text-xs font-semibold mb-2 text-white/80">Sort By</p>
              <div class="space-y-2">
                <button aria-label="Newest First" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-purple-500/30 bg-[linear-gradient(to_right,_rgba(58,29,255,0.55),_rgba(35,22,74,0.55))] text-white text-sm font-semibold text-left cursor-pointer shadow-[0_10px_30px_rgba(58,29,255,0.25)] hover:shadow-[0_12px_35px_rgba(58,29,255,0.35)] transition-all duration-200">
                  <svg class="w-4 h-4 text-white/90" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M12 7v6l4 2"></path>
                  </svg>
                  <span>Newest First</span>
                </button>

                <button aria-label="Most Popular" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                  <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 17l6-6 4 4 7-7"></path>
                    <path d="M14 8h6v6"></path>
                  </svg>
                  <span>Most Popular</span>
                </button>

                <button aria-label="Trending" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                  <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22c4 0 7-3 7-7 0-3-2-5-3-7-1 2-2 3-4 4 0-3-2-5-4-7 0 3-3 5-3 10 0 4 3 7 7 7Z"></path>
                  </svg>
                  <span>Trending</span>
                </button>
              </div>
            </div>

            <!-- Topics -->
            <div>
              <p class="text-xs font-semibold mb-2 text-white/80">Topics</p>
              <div class="space-y-2">
                <button aria-label="Vedic Astrology" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                  <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19a2 2 0 0 0 2 2h14"></path>
                    <path d="M6 2h14v20H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"></path>
                  </svg>
                  <span>Vedic Astrology</span>
                </button>

                <button aria-label="Horoscopes" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                  <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l3.1 6.3 7 1-5 4.9 1.2 7-6.3-3.3-6.3 3.3 1.2-7-5-4.9 7-1L12 2Z"></path>
                  </svg>
                  <span>Horoscopes</span>
                </button>

                <button aria-label="Zodiac Signs" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                  <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l1.4 4.3L18 8l-4.6 1.7L12 14l-1.4-4.3L6 8l4.6-1.7L12 2Z"></path>
                    <path d="M19 13l.9 2.7L23 17l-3.1 1.3L19 21l-.9-2.7L15 17l3.1-1.3L19 13Z"></path>
                  </svg>
                  <span>Zodiac Signs</span>
                </button>

                <button aria-label="Planetary Transit" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                  <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M3 12h18"></path>
                    <path d="M12 3a14 14 0 0 1 0 18"></path>
                    <path d="M12 3a14 14 0 0 0 0 18"></path>
                  </svg>
                  <span>Planetary Transit</span>
                </button>

                <button aria-label="Numerology" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                  <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 9h16"></path>
                    <path d="M4 15h16"></path>
                    <path d="M10 3L8 21"></path>
                    <path d="M16 3l-2 18"></path>
                  </svg>
                  <span>Numerology</span>
                </button>

                <button aria-label="Tarot" type="button"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                  <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10L12 5 2 10l10 5 10-5Z"></path>
                    <path d="M6 12v6c4 2 8 2 12 0v-6"></path>
                  </svg>
                  <span>Tarot</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </aside>

      <!-- POSTS FEED -->
      <div class="flex-1 space-y-6">
        <!-- Post Card 1 -->
       @foreach ($posts as $post)
<article
    class="rounded-3xl border border-white/10 bg-gradient-to-b cursor-pointer from-[#1B1E47] to-[#121538] p-6 md:p-8 shadow-[0_30px_80px_rgba(0,0,0,0.55)]">

    {{-- Header --}}
    <div class="flex items-center gap-3 min-w-0">
              <div
                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full overflow-hidden shrink-0 cursor-pointer border-2 border-white/10">
                <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200" alt="Author"
                  class="w-full h-full object-cover" />
              </div>
              <div class="min-w-0">
                <div class="flex flex-wrap items-center gap-2">
                  <p class="text-sm sm:text-base font-semibold truncate cursor-pointer hover:underline text-white/90">
                    Dr. Priya Sharma</p>
                  <svg class="w-4 h-4 text-amber-300" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2l2.2 3.7 4.2 1-2.8 3.2.4 4.3L12 12.9 8 14.2l.4-4.3L5.6 6.7l4.2-1L12 2Z" />
                  </svg>
                  <span
                    class="px-2.5 py-0.5 rounded-full text-xs font-medium cursor-pointer bg-white/5 text-white/70 border border-white/10">Vedic
                    Astrologer</span>
                </div>
                <p class="text-xs sm:text-sm mt-1 text-white/55">2h ago</p>
              </div>
            </div>

    {{-- Tags --}}
    <div class="flex flex-wrap gap-3 text-xs mb-4 text-amber-300">
        @foreach ($post->tags ?? [] as $tag)
            <span>#{{ $tag }}</span>
        @endforeach
    </div>

    {{-- Title --}}
    <a >
        <h3 class="text-xl font-semibold mb-3 text-white/90 hover:underline">
            {{ $post->title }}
        </h3>
    </a>

    {{-- Content --}}
    <p class="text-sm text-white/70 mb-4">
        {{ Str::limit(strip_tags($post->content), 160) }}
    </p>

    {{-- Media --}}
    @if (!empty($post->media))
        <div class="rounded-2xl overflow-hidden mb-5 border border-white/10">
            <img src="{{ url('public/' . $post->media[0]) }}"
                 alt="{{ $post->media_alt }}"
                 class="w-full h-[300px] object-cover">
        </div>
    @endif

    {{-- Footer --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-6 text-white/65">
              <button aria-label="Like Post"
                class="flex items-center gap-2 cursor-pointer hover:text-white transition-colors">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path
                    d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z" />
                </svg>
                <span class="text-sm font-medium">234</span>
              </button>
              <button aria-label="Comment"
                class="flex items-center gap-2 cursor-pointer hover:text-white transition-colors">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z" />
                </svg>
                <span class="text-sm font-medium">45</span>
              </button>
              <button aria-label="read"
                class="flex items-center gap-2 cursor-pointer hover:text-white transition-colors">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="18" cy="5" r="2" />
                  <circle cx="6" cy="12" r="2" />
                  <circle cx="18" cy="19" r="2" />
                  <path d="M8 12l8-7M8 12l8 7" />
                </svg>
              </button>
            </div>
            <p class="text-xs sm:text-sm text-white/55">5 min read</p>
          </div>
</article>
@endforeach

      
      </div>
    </div>
  </main>

  <!-- FLOATING FILTER BUTTON (Mobile Only) -->
  <button aria-label="Filter Posts" id="floatingFilterBtn"
    class="lg:hidden fixed bottom-20 right-4 z-40 w-14 h-14 rounded-full bg-gradient-to-r from-purple-600 to-purple-800 text-white flex items-center justify-center fab-button">
    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M3 6h18M7 12h10M10 18h4" />
    </svg>
  </button>

  <!-- MOBILE BOTTOM NAV -->
  <nav
    class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-[rgba(11,16,35,0.95)] backdrop-blur-xl border-t border-white/10">
    <div class="flex items-center justify-around h-16">
      <a href="./index.html"
        class="flex flex-col items-center gap-1 px-3 py-2 text-white bg-transparent border-none cursor-pointer transition-colors">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
          <path
            d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
        </svg>
        <span class="text-xs font-medium">Feed</span>
      </a>

      <a href="./pages/create-post.html"
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

  <!-- MOBILE FILTERS DRAWER -->
  <div class="lg:hidden">
    <div id="filtersBackdrop"
      class="fixed inset-0 z-40 bg-black/60 opacity-0 pointer-events-none transition-opacity duration-300"></div>
    <aside id="filtersDrawer"
      class="fixed bottom-0 left-0 right-0 z-50 max-h-[85vh] bg-[rgba(11,16,35,0.95)] backdrop-blur-xl border-t border-white/10 rounded-t-3xl transform translate-y-full transition-transform duration-300 ease-out">
      <div class="flex items-center justify-between p-4 border-b border-white/10">
        <h3 class="text-lg font-semibold text-white">Filters</h3>
        <button aria-label="Close Filters" id="closeFiltersBtn"
          class="p-2 rounded-lg cursor-pointer hover:bg-white/5 transition-colors text-white/70">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6 6 18M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="filters-content max-h-[calc(85vh-4rem)] overflow-y-auto p-5">
        <div class="space-y-5">
          <!-- Sort By -->
          <div>
            <p class="text-xs font-semibold mb-2 text-white/80">Sort By</p>
            <div class="space-y-2">
              <button aria-label="Newest First" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-purple-500/30 bg-[linear-gradient(to_right,_rgba(58,29,255,0.55),_rgba(35,22,74,0.55))] text-white text-sm font-semibold text-left cursor-pointer shadow-[0_10px_30px_rgba(58,29,255,0.25)] hover:shadow-[0_12px_35px_rgba(58,29,255,0.35)] transition-all duration-200">
                <svg class="w-4 h-4 text-white/90" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <circle cx="12" cy="12" r="9"></circle>
                  <path d="M12 7v6l4 2"></path>
                </svg>
                <span>Newest First</span>
              </button>
              <button aria-label="Most Popular" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path d="M3 17l6-6 4 4 7-7"></path>
                  <path d="M14 8h6v6"></path>
                </svg>
                <span>Most Popular</span>
              </button>
              <button aria-label="Trending" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path d="M12 22c4 0 7-3 7-7 0-3-2-5-3-7-1 2-2 3-4 4 0-3-2-5-4-7 0 3-3 5-3 10 0 4 3 7 7 7Z"></path>
                </svg>
                <span>Trending</span>
              </button>
            </div>
          </div>

          <!-- Topics -->
          <div>
            <p class="text-xs font-semibold mb-2 text-white/80">Topics</p>
            <div class="space-y-2">
              <button aria-label="Vedic Astrology" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path d="M4 19a2 2 0 0 0 2 2h14"></path>
                  <path d="M6 2h14v20H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"></path>
                </svg>
                <span>Vedic Astrology</span>
              </button>
              <button aria-label="Horoscope" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path d="M12 2l3.1 6.3 7 1-5 4.9 1.2 7-6.3-3.3-6.3 3.3 1.2-7-5-4.9 7-1L12 2Z"></path>
                </svg>
                <span>Horoscopes</span>
              </button>
              <button aria-label="Zodiac Signs" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path d="M12 2l1.4 4.3L18 8l-4.6 1.7L12 14l-1.4-4.3L6 8l4.6-1.7L12 2Z"></path>
                  <path d="M19 13l.9 2.7L23 17l-3.1 1.3L19 21l-.9-2.7L15 17l3.1-1.3L19 13Z"></path>
                </svg>
                <span>Zodiac Signs</span>
              </button>
              <button aria-label="Planetary Transit" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <circle cx="12" cy="12" r="9"></circle>
                  <path d="M3 12h18"></path>
                  <path d="M12 3a14 14 0 0 1 0 18"></path>
                  <path d="M12 3a14 14 0 0 0 0 18"></path>
                </svg>
                <span>Planetary Transit</span>
              </button>
              <button aria-label="Numerology" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path d="M4 9h16"></path>
                  <path d="M4 15h16"></path>
                  <path d="M10 3L8 21"></path>
                  <path d="M16 3l-2 18"></path>
                </svg>
                <span>Numerology</span>
              </button>
              <button aria-label="Tarot" type="button"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl border border-white/10 bg-white/5 text-white/85 text-sm font-semibold text-left cursor-pointer hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                <svg class="w-4 h-4 text-white/75" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path d="M22 10L12 5 2 10l10 5 10-5Z"></path>
                  <path d="M6 12v6c4 2 8 2 12 0v-6"></path>
                </svg>
                <span>Tarot</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </aside>
  </div>

  <!-- FOOTER -->
  <footer class="mt-16 border-t border-white/10 bg-[#0B0E1F]/50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-white/50">© 2025 Mayatara. All rights reserved.</p>
        <div class="flex items-center gap-6 text-sm text-white/50">
          <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
          <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
          <a href="#" class="hover:text-white transition-colors">Contact</a>
        </div>
      </div>
    </div>
  </footer>


  <script src="./assets/js/main.js">

  </script>
</body>

</html>