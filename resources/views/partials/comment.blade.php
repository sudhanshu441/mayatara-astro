<div class="flex gap-3 comment-item" id="comment-{{ $comment->id }}">
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
        @if(session('user_id') == $comment->post->user_id)
        <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.store', $comment->post_id) }}" method="POST" class="mt-3 ml-6 flex gap-2 hidden reply-form">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <input type="text" name="comment" required placeholder="Write a reply..." class="flex-1 px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-purple-500/50">
            <button type="submit" class="px-3 py-2 rounded-md bg-purple-600 hover:bg-purple-700 text-white text-xs font-medium">Reply</button>
        </form>
        @endif

        <!-- Replies -->
        @foreach($comment->replies()->latest()->get() as $reply)
        <div class="mt-4 ml-6 pl-4 border-l border-white/10">
            <p class="text-xs font-semibold text-white">{{ $reply->user->name ?? 'Anonymous' }}
                <span class="text-white/40 font-normal">• {{ $reply->created_at->diffForHumans() }}</span>
            </p>
            <p class="text-sm text-white/70 mt-1">{{ $reply->comment }}</p>
        </div>
        @endforeach
        
    </div>
</div>
