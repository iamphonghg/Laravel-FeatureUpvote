<div>
    @if ($comments->isNotEmpty())
        <div class="comments-container relative space-y-6 pt-4 ml-22 my-8 mt-1">
            @foreach ($comments as $comment)
                <livewire:suggestion-comment
                    :key="$comment->id"
                    :comment="$comment"
                />
            @endforeach
        </div> <!-- end comments container -->
    @else
        <div class="mx-auto w-70 mt-32">
            <img src="{{ asset('img/error-404.svg') }}" alt="no suggestions" class="mx-auto w-32" style="mix-blend-mode: luminosity">
            <div class="text-gray-400 text-center font-bold mt-6">No comments yet</div>
        </div>
    @endif
</div>
