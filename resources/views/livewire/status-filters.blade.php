<div>
    <nav class="hidden md:flex items-center justify-between text-sm text-gray-400">
        <ul class="flex uppercase font-bold border-b-4 pb-3 space-x-10">
            <li><a wire:click.prevent="setStatus('all')"href="#" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'all') border-blue text-gray-900 @endif">All ({{ $statusCount['all_statuses'] }})</a></li>
            <li><a wire:click.prevent="setStatus('considering')"href="#" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'considering') border-blue text-gray-900 @endif">Considering ({{ $statusCount['considering'] }})</a></li>
            <li><a wire:click.prevent="setStatus('planned')"href="#" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'planned') border-blue text-gray-900 @endif">Planned ({{ $statusCount['planned'] }})</a></li>
        </ul>
        <ul class="flex uppercase font-bold border-b-4 pb-3 space-x-10">
            <li><a wire:click.prevent="setStatus('not_planned')"href="#" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'not_planned') border-blue text-gray-900 @endif">Not planned ({{ $statusCount['not_planned'] }})</a></li>
            <li><a wire:click.prevent="setStatus('done')"href="#" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'done') border-blue text-gray-900 @endif">Done ({{ $statusCount['done'] }})</a></li>
        </ul>
    </nav>
</div>
