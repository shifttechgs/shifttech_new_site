<x-filament-panels::page>
    @php
        $columns  = $this->getColumns();
        $requests = $this->getRequests();
        $priorityColors = [
            'Low'    => 'bg-slate-100 text-slate-500',
            'Normal' => 'bg-blue-100 text-blue-600',
            'High'   => 'bg-amber-100 text-amber-700',
            'Urgent' => 'bg-rose-100 text-rose-700',
        ];
    @endphp

    {{-- Header --}}
    <div class="flex items-center justify-between mb-2">
        <p class="text-sm text-gray-400">Drag cards between columns to update status, or use the actions on each card.</p>
        <a href="{{ route('filament.admin.resources.client-requests.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Request
        </a>
    </div>

    {{-- Kanban Board --}}
    <div class="flex gap-4 overflow-x-auto pb-4" id="kanban-board" style="min-height:70vh;">
        @foreach($columns as $status => $col)
        @php
            $cards = $requests[$status] ?? [];
        @endphp
        <div class="flex-shrink-0 w-72 flex flex-col"
             data-status="{{ $status }}"
             x-data
             @dragover.prevent
             @drop="$wire.moveCard($event.dataTransfer.getData('requestId'), '{{ $status }}')">

            {{-- Column Header --}}
            <div class="flex items-center justify-between px-3 py-2.5 rounded-xl mb-3"
                 style="background: {{ $col['color'] }}20; border: 1.5px solid {{ $col['color'] }}40">
                <div class="flex items-center gap-2">
                    <span class="text-base">{{ $col['icon'] }}</span>
                    <span class="text-sm font-bold" style="color:{{ $col['color'] }}">{{ $col['label'] }}</span>
                </div>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full text-white" style="background:{{ $col['color'] }}">
                    {{ count($cards) }}
                </span>
            </div>

            {{-- Cards --}}
            <div class="flex flex-col gap-3 flex-1">
                @forelse($cards as $card)
                @php
                    $priority = is_array($card) ? ($card['priority'] ?? 'Normal') : ($card->priority ?? 'Normal');
                    $title    = is_array($card) ? ($card['title'] ?? '') : ($card->title ?? '');
                    $reqId    = is_array($card) ? ($card['request_id'] ?? '') : ($card->request_id ?? '');
                    $clientFn = is_array($card) ? ($card['client']['firstname'] ?? '') : optional(optional($card)->client)->firstname ?? '';
                    $clientLn = is_array($card) ? ($card['client']['lastname'] ?? '') : optional(optional($card)->client)->lastname ?? '';
                    $desc     = is_array($card) ? ($card['description'] ?? '') : ($card->description ?? '');
                    $created  = is_array($card) ? ($card['created_at'] ?? '') : ($card->created_at ?? '');
                @endphp
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm cursor-grab active:cursor-grabbing hover:shadow-md transition-shadow"
                     draggable="true"
                     @dragstart="$event.dataTransfer.setData('requestId', '{{ $reqId }}')">
                    <div class="flex items-start justify-between mb-2">
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $priorityColors[$priority] ?? 'bg-blue-100 text-blue-600' }}">
                            {{ $priority }}
                        </span>
                        <div class="flex gap-1">
                            <button wire:click="updatePriority('{{ $reqId }}', 'Urgent')"
                                    title="Mark Urgent"
                                    class="text-gray-300 hover:text-rose-500 transition-colors text-xs">🔴</button>
                            <a href="{{ route('filament.admin.resources.client-requests.edit', $reqId) }}"
                               class="text-gray-300 hover:text-indigo-500 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                        </div>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 leading-tight mb-1">{{ $title }}</p>
                    @if($clientFn || $clientLn)
                    <p class="text-xs text-indigo-500 font-medium mb-1">👤 {{ trim($clientFn . ' ' . $clientLn) }}</p>
                    @endif
                    @if($desc)
                    <p class="text-xs text-gray-400 leading-relaxed line-clamp-2 mb-2">{{ $desc }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 dark:border-gray-700">
                        <span class="text-xs text-gray-300">#{{ $reqId }}</span>
                        <span class="text-xs text-gray-400">
                            @if($created)
                                {{ \Carbon\Carbon::parse($created)->diffForHumans() }}
                            @endif
                        </span>
                    </div>
                    {{-- Quick status move buttons --}}
                    <div class="flex flex-wrap gap-1 mt-2">
                        @foreach($columns as $s => $c)
                            @if($s !== $status)
                            <button wire:click="moveCard('{{ $reqId }}', '{{ $s }}')"
                                    class="text-xs px-2 py-0.5 rounded-full hover:opacity-80 transition-opacity text-white"
                                    style="background: {{ $c['color'] }}">
                                → {{ $c['label'] }}
                            </button>
                            @endif
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center py-10 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-xl text-gray-300">
                    <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span class="text-xs">No requests</span>
                </div>
                @endforelse
            </div>
        </div>
        @endforeach
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>

