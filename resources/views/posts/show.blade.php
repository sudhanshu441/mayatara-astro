<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $post->title }} - Mayatara</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
    ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.3); }
    * { scroll-behavior: smooth; }
    .article-content p { margin-bottom: 1rem; line-height: 1.8; }
    .comment-item:hover { background: rgba(255,255,255,0.02); }
    .reply-indent { margin-left: 3rem; }
    @media (max-width:640px){ .reply-indent{ margin-left:1.5rem; } }
  </style>
</head>

<body class="bg-[#070A1A] text-white" id="commentsContainer">

<!-- HEADER -->
<header class="sticky top-0 z-50 bg-[rgba(11,16,35,0.4)] backdrop-blur-xl border-b border-white/10">
  <div class="mx-auto max-w-7xl px-6 h-16 flex items-center justify-between">
      <a href="{{route('dashboard')}}" class="flex items-center gap-2 cursor-pointer">
          <img class="w-8 h-8" src="{{ url('public\star.png') }}"   alt="Mayatara" />
          <h1 class="text-lg sm:text-xl font-bold text-white">Mayatara</h1>
        </a>

  <div class="flex items-center gap-3 cursor-pointer">
            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/10">
                <img
                    class="w-full h-full object-cover"
                    src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200"
                    alt="Profile"
                />
            </div>

            <p class="hidden sm:block text-base font-semibold text-white">
                {{ session('user_name') }}
            </p>
        </div>
  </div>
</header>

<!-- MAIN -->
<main class="max-w-4xl mx-auto px-4 py-10">

<article class="rounded-3xl border border-white/10 bg-gradient-to-b from-[#1A1D3F] to-[#0F1128] overflow-hidden shadow-2xl">

<!-- AUTHOR -->
<!-- Author Header -->
<div class="p-6 sm:p-8
            bg-gradient-to-b from-[#1A1D3F] to-[#0F1128]
            border-b border-white/10
            shadow-[inset_0_-1px_0_rgba(255,255,255,0.05)]">

  <div class="flex justify-between items-start gap-4">
    
    <!-- Author Info -->
    <div class="flex gap-3">
      <img src="{{ $post->user->avatar ?? 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200' }}"
           class="w-12 h-12 rounded-full object-cover border-2 border-white/10">

      <div>
        <h2 class="font-semibold text-white hover:underline cursor-pointer">
          {{ $post->user->name }}
        </h2>

        <p class="text-xs text-white/50 flex items-center gap-2">
          {{ $post->created_at->format('M d, Y') }}
          <span>•</span>
          {{ number_format($post->views) }} views
        </p>
      </div>
    </div>

    <!-- Follow Button -->
    <button aria-label="Follow this author"
      class="px-4 py-2 rounded-lg bg-purple-600 hover:bg-purple-700
             text-white text-sm font-semibold transition-colors
             flex items-center gap-2 whitespace-nowrap">
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2">
        <path d="M12 5v14M5 12h14" />
      </svg>
      Follow
    </button>

  </div>

  <!-- Post Title -->
  <h1 class="mt-6 text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight text-white/95">
    {{ $post->title }}
  </h1>
</div>



<!-- IMAGE -->
 @if(!empty($post->media))
        <div class="rounded-2xl overflow-hidden mb-5 border border-white/10">
            <img src="{{ url('public/' . $post->media[0]) }}" alt="{{ $post->media_alt }}" class="w-full h-[300px] object-cover">
        </div>
    @endif

<!-- CONTENT -->
<div class="p-6">
  <div class="article-content text-white/75">
    {!! $post->content !!}
  </div>

  <!-- TAGS -->
  @if($post->tags)
  <div class="flex flex-wrap gap-2 mt-6">
    @foreach($post->tags as $tag)
      <span class="px-3 py-1 rounded-lg bg-purple-500/10 text-purple-300 text-xs">
        #{{ $tag }}
      </span>
    @endforeach
  </div>
  @endif

  <!-- STATS -->
 <div class="flex items-center justify-between mt-5 flex-wrap gap-4">
  <div class="flex items-center gap-6">

    <!-- Like -->
               {{-- Like Button --}}
          @php
    $userLiked = $post->likes->contains('user_id', session('user_id'));
@endphp

<button 
    onclick="toggleLike({{ $post->id }})"
    class="flex items-center gap-2 hover:text-white transition-colors"
>
    <svg id="like-icon-{{ $post->id }}"
        class="w-5 h-5"
        viewBox="0 0 24 24"
        fill="{{ $userLiked ? 'red' : 'none' }}"
        stroke="{{ $userLiked ? 'red' : 'currentColor' }}"
        stroke-width="2">
        <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>
    </svg>

    <span id="like-count-{{ $post->id }}">
        {{ $post->likes->count() }}
    </span>
</button>
<script>
function toggleLike(postId) {

    // Laravel route with placeholder
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
        if (!response.ok) {
            throw new Error('Not logged in');
        }
        return response.json();
    })
    .then(data => {
        const icon  = document.getElementById(`like-icon-${postId}`);
        const count = document.getElementById(`like-count-${postId}`);

        if (data.liked) {
            icon.setAttribute('fill', 'red');
            icon.setAttribute('stroke', 'red');
        } else {
            icon.setAttribute('fill', 'none');
            icon.setAttribute('stroke', 'currentColor');
        }

        count.innerText = data.likes_count;
    })
    .catch(err => {
        alert('Please login to like this post');
        console.error(err);
    });
}
</script>



    <!-- Comments -->
    <button
      class="flex items-center gap-2 text-white/60 hover:text-blue-400 transition-colors group">
      <svg class="w-5 h-5 group-hover:scale-110 transition-transform"
           viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z" />
      </svg>
      <span class="text-sm font-medium">
        {{ $post->comments->count() }}
      </span>
    </button>

    <!-- Views -->
    <div class="flex items-center gap-2 text-white/50">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z" />
        <circle cx="12" cy="12" r="3" />
      </svg>
      <span class="text-sm font-medium">
        {{ number_format($post->views) }}
      </span>
    </div>

  </div>
</div>

</div>

<!-- COMMENTS SECTION -->
<div class="border-t border-white/10 px-6 sm:px-8 py-8
            bg-gradient-to-b from-[#111432] to-[#0B0D24]">

  <!-- Header -->
  <div class="flex items-center justify-between mb-6">
    <h3 class="text-lg font-semibold flex items-center gap-2 text-white">
      <svg class="w-5 h-5 text-purple-400" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2">
        <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
      </svg>
      Comments ({{ $post->comments->count() }})
    </h3>

<div class="flex items-center gap-2 text-xs mb-4">
    <a href="javascript:void(0)"
       onclick="loadComments('recent')"
       id="recentBtn"
       class="px-3 py-1.5 rounded-md bg-purple-600 text-white font-medium">
        Recent
    </a>

    <a href="javascript:void(0)"
       onclick="loadComments('popular')"
       id="popularBtn"
       class="px-3 py-1.5 rounded-md text-white/50 hover:text-white hover:bg-white/5 transition">
        Popular
    </a>
</div>


  </div>
<!-- Comment Input -->
<form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-10 comment-form">
    @csrf
    <div class="flex gap-3">
        <img src="{{ auth()->user()->avatar ?? 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200' }}"
             class="w-9 h-9 rounded-full object-cover border border-white/10">
        <div class="flex-1">
            <textarea name="comment" rows="3" required placeholder="Share your thoughts..."
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-white/40 text-sm resize-none focus:outline-none focus:border-purple-500/50"></textarea>
            <div class="flex justify-end mt-2">
                <button type="submit"
                        class="px-4 py-1.5 rounded-md bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium transition">
                    Comment
                </button>
            </div>
        </div>
    </div>
</form>

<!-- COMMENTS LIST -->
<div id="commentsWrapper" class="space-y-8 comments-list">
@foreach($comments as $comment)
<div class="flex gap-3">
    <img src="{{ $comment->user->avatar ?? 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200' }}"
         class="w-9 h-9 rounded-full object-cover border border-white/10">
    <div class="flex-1">
        <div class="flex items-center gap-2">
            <p class="text-sm font-semibold text-white">{{ $comment->user->name ?? 'Anonymous' }}</p>
            <span class="text-xs text-white/40">• {{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-sm text-white/80 mt-1 leading-relaxed">{{ $comment->comment }}</p>

        <!-- Actions -->
        <div class="flex items-center gap-4 mt-2 text-xs text-white/50">
            <form action="{{ route('comments.like', $comment->id) }}" method="POST" class="like-form">
                @csrf
                @php
                    $userLiked = $comment->likes->contains('user_id', session('user_id'));
                    $likesCount = $comment->likes->count();
                @endphp
                <button type="submit" class="transition flex items-center gap-1">
                    <span class="{{ $userLiked ? 'text-red-500' : ($likesCount > 0 ? 'text-gray-400 hover:text-purple-400' : 'text-white/30') }} like-icon">❤️</span>
                    <span class="likes-count">{{ $likesCount }}</span>
                </button>
            </form>
            <button type="button" onclick="toggleReply('{{ $comment->id }}')" class="hover:text-purple-400 transition">Reply</button>
        </div>

        <!-- Reply Form -->
        @if(session('user_id') == $post->user_id)
       <form id="reply-form-{{ $comment->id }}" 
      action="{{ route('comments.store', $post->id) }}" 
      method="POST" 
      class="mt-3 ml-6 flex gap-2 hidden reply-form">
    @csrf
    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
    <input type="text" name="comment" required placeholder="Write a reply..." class="flex-1 px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-purple-500/50">
    <button type="submit" class="px-3 py-2 rounded-md bg-purple-600 hover:bg-purple-700 text-white text-xs font-medium">Reply</button>
</form>

        @endif

        <!-- Replies -->
     <div class="replies-list mt-5 ml-6 pl-4 border-l border-white/10">
    @foreach($comment->replies()->latest()->get() as $reply)
        @include('partials.comment', ['comment' => $reply])
    @endforeach
</div>

    </div>
</div>
@endforeach
</div>

<!-- TOGGLE REPLY SCRIPT -->
<script>
  function toggleReply(id) {
    const form = document.getElementById('reply-form-' + id);
    if (form) {
      form.classList.toggle('hidden');
    }
  }
</script>

<script>
function loadComments(sort) {

    // Button active state
    document.getElementById('recentBtn').classList.remove('bg-purple-600', 'text-white');
    document.getElementById('popularBtn').classList.remove('bg-purple-600', 'text-white');

    if (sort === 'recent') {
        document.getElementById('recentBtn').classList.add('bg-purple-600', 'text-white');
    } else {
        document.getElementById('popularBtn').classList.add('bg-purple-600', 'text-white');
    }

    // AJAX request
    fetch("{{ route('posts.show', $post->id) }}?sort=" + sort, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('commentsWrapper').innerHTML = html;
    });
}
</script>

</article>

</main>

<footer class="mt-12 border-t border-white/10 py-6 text-center text-sm text-white/50">
  © {{ date('Y') }} Mayatara. All rights reserved.
</footer>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
$(document).ready(function() {

    // Submit new comment via AJAX
    $('form.comment-form').submit(function(e) {
        e.preventDefault();  // prevent page reload
        let form = $(this);
        let url = form.attr('action'); // route to store comment
        let data = form.serialize();

        // AJAX POST request
        $.post(url, data, function(response) {
            // Prepend the returned HTML to the comments list
            $('.comments-list').prepend(response.html);
            form[0].reset(); // clear the form
        }).fail(function(xhr) {
            alert(xhr.responseText || 'Something went wrong.');
        });
    });

    // Like comment via AJAX
    $(document).on('submit', 'form.like-form', function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');

        $.post(url, form.serialize(), function(response) {
            form.find('span.likes-count').text(response.likesCount);
            if(response.liked) {
                form.find('span.like-icon').removeClass('text-gray-400 hover:text-purple-400 text-white/30').addClass('text-red-500');
            } else {
                form.find('span.like-icon').removeClass('text-red-500').addClass('text-gray-400 hover:text-purple-400');
            }
        });
    });

    // Reply toggle
    window.toggleReply = function(id) {
        $('#reply-form-' + id).toggleClass('hidden');
    };

    // Submit reply via AJAX
    // Submit reply via AJAX
$(document).on('submit', 'form.reply-form', function(e) {
    e.preventDefault();
    let form = $(this);
    let url = form.attr('action');
    let data = form.serialize();

    $.post(url, data, function(response) {
        // Insert the new reply before the reply form
        form.before(response.html);
        form[0].reset();      // clear input
        form.addClass('hidden'); // hide reply form after submit
    }).fail(function(xhr) {
        alert(xhr.responseText || 'Something went wrong.');
    });
});


});
</script>

</body>
</html>
