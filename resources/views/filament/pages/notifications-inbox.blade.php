<x-filament-panels::page>
    @php
        $notifications = $this->getNotifications();
        $typeColors = [
            'success' => ['bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'border' => 'border-emerald-200', 'dot' => 'bg-emerald-500', 'text' => 'text-emerald-700 dark:text-emerald-400'],
            'warning' => ['bg' => 'bg-amber-50 dark:bg-amber-900/20',   'border' => 'border-amber-200',   'dot' => 'bg-amber-500',   'text' => 'text-amber-700 dark:text-amber-400'],
            'danger'  => ['bg' => 'bg-rose-50 dark:bg-rose-900/20',     'border' => 'border-rose-200',     'dot' => 'bg-rose-500',    'text' => 'text-rose-700 dark:text-rose-400'],
            'info'    => ['bg' => 'bg-blue-50 dark:bg-blue-900/20',     'border' => 'border-blue-200',     'dot' => 'bg-blue-500',    'text' => 'text-blue-700 dark:text-blue-400'],
        ];
        $unreadCount = $notifications->where('is_read', false)->count();
    @endphp

    <div class="space-y-2">
        {{-- Unread count banner --}}
        @if($unreadCount > 0)
        <div class="flex items-center gap-3 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-700 rounded-xl px-5 py-3">
            <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 animate-pulse"></span>
            <p class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">
                {{ $unreadCount }} unread notification{{ $unreadCount > 1 ? 's' : '' }}
            </p>
        </div>
        @endif

        {{-- Notification list --}}
        @forelse($notifications as $n)
        @php $c = $typeColors[$n->type] ?? $typeColors['info']; @endphp
        <div wire:key="notif-{{ $n->id }}"
             class="flex items-start gap-4 p-4 rounded-xl border transition-all {{ $n->is_read ? 'bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 opacity-60' : $c['bg'] . ' border ' . $c['border'] }}">

            {{-- Dot --}}
            <div class="mt-1.5 flex-shrink-0">
                @if(! $n->is_read)
                <span class="w-2.5 h-2.5 rounded-full block {{ $c['dot'] }}"></span>
                @else
                <span class="w-2.5 h-2.5 rounded-full block bg-gray-300 dark:bg-gray-600"></span>
                @endif
            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <p class="text-sm font-semibold {{ $n->is_read ? 'text-gray-500' : 'text-gray-800 dark:text-gray-100' }}">
                            {{ $n->title }}
                        </p>
                        @if($n->description)
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $n->description }}</p>
                        @endif
                        @if($n->link)
                        <a href="{{ $n->link }}" class="text-xs text-indigo-500 hover:underline mt-1 inline-block">
                            View →
                        </a>
                        @endif
                    </div>
                    <span class="text-xs text-gray-400 flex-shrink-0">
                        {{ $n->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                @if(! $n->is_read)
                <button wire:click="markRead({{ $n->id }})"
                        title="Mark read"
                        class="text-gray-400 hover:text-emerald-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
                @endif
                <button wire:click="deleteNotification({{ $n->id }})"
                        wire:confirm="Remove this notification?"
                        title="Delete"
                        class="text-gray-400 hover:text-rose-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        @empty
        <div class="flex flex-col items-center justify-center py-20 text-gray-400">
            <svg class="w-12 h-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <p class="text-sm font-medium">All caught up — no notifications</p>
        </div>
        @endforelse
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>

