<x-filament-panels::page>
    @php
        $events       = $this->getCalendarEvents();
        $unscheduled  = $this->getUnscheduledJobs();
        $statusColors = [
            'New'        => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700', 'dot' => 'bg-indigo-500'],
            'Scheduled'  => ['bg' => 'bg-blue-100',   'text' => 'text-blue-700',   'dot' => 'bg-blue-500'],
            'InProgress' => ['bg' => 'bg-amber-100',  'text' => 'text-amber-700',  'dot' => 'bg-amber-500'],
            'Completed'  => ['bg' => 'bg-emerald-100','text' => 'text-emerald-700','dot' => 'bg-emerald-500'],
            'Cancelled'  => ['bg' => 'bg-rose-100',   'text' => 'text-rose-700',   'dot' => 'bg-rose-500'],
        ];
    @endphp

    {{-- Legend --}}
    <div class="flex flex-wrap gap-3 mb-2">
        @foreach($statusColors as $label => $c)
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $c['bg'] }} {{ $c['text'] }}">
            <span class="w-2 h-2 rounded-full {{ $c['dot'] }}"></span>
            {{ $label }}
        </span>
        @endforeach
        <span class="ml-auto text-xs text-gray-400 self-center">
            {{ \App\Models\ScheduledJob::count() }} job(s) scheduled
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- FullCalendar --}}
        <div class="lg:col-span-3 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <div id="crm-calendar"></div>
        </div>

        {{-- Unscheduled Jobs Sidebar --}}
        <div class="flex flex-col gap-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 mb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                    Unscheduled Jobs ({{ count($unscheduled) }})
                </h3>

                @forelse($unscheduled as $job)
                @php $c = $statusColors[$job->job_status] ?? $statusColors['New']; @endphp
                <div class="mb-3 p-3 rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-gray-800 dark:text-gray-100 truncate">{{ $job->job_title ?? 'Untitled' }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ optional($job->client)->firstname }} {{ optional($job->client)->lastname }}
                            </p>
                            <span class="inline-flex items-center gap-1 mt-1 text-xs font-medium {{ $c['text'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $c['dot'] }}"></span>
                                {{ $job->job_status }}
                            </span>
                        </div>
                        <a href="{{ route('filament.admin.resources.jobs.view', $job) }}"
                           class="flex-shrink-0 text-indigo-400 hover:text-indigo-600 transition-colors mt-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">{{ $job->job_id }}</p>
                </div>
                @empty
                <p class="text-xs text-gray-400 py-3 text-center">All jobs are scheduled ✅</p>
                @endforelse
            </div>

            {{-- Quick Stats --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 mb-3">This Week</h3>
                @php
                    $thisWeekStart = now()->startOfWeek();
                    $thisWeekEnd   = now()->endOfWeek();
                    $weekJobs = \App\Models\ScheduledJob::whereBetween('scheduled_date', [$thisWeekStart, $thisWeekEnd])->count();
                    $todayJobs = \App\Models\ScheduledJob::whereDate('scheduled_date', today())->count();
                @endphp
                <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="text-xs text-gray-500">Today</span>
                    <span class="text-sm font-bold text-indigo-600">{{ $todayJobs }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-xs text-gray-500">This Week</span>
                    <span class="text-sm font-bold text-indigo-600">{{ $weekJobs }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Event Detail Modal --}}
    <div id="eventModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 p-6 w-full max-w-md z-10">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 id="modal-title" class="text-base font-bold text-gray-800 dark:text-gray-100 mb-4 pr-6"></h3>
            <div class="space-y-2.5 text-sm" id="modal-body"></div>
            <div class="mt-5 flex gap-3">
                <a id="modal-link" href="#" class="flex-1 text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors">
                    View Job →
                </a>
                <button onclick="closeModal()" class="flex-1 px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 text-sm font-semibold rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    {{-- FullCalendar CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <script>
        function closeModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }

        function initCalendar() {
            const el = document.getElementById('crm-calendar');
            if (!el || window._crmCalendar) return;

            window._crmCalendar = new FullCalendar.Calendar(el, {
                initialView:     'dayGridMonth',
                headerToolbar: {
                    left:   'prev,next today',
                    center: 'title',
                    right:  'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                height:        'auto',
                nowIndicator:  true,
                editable:      false,
                events:        @json(json_decode($events)),
                eventClick: function(info) {
                    const p  = info.event.extendedProps;
                    const s  = info.event.start;
                    const e  = info.event.end;
                    const fmt = d => d ? new Date(d).toLocaleString('en-ZA', { dateStyle:'medium', timeStyle:'short' }) : '—';

                    document.getElementById('modal-title').textContent = info.event.title;
                    document.getElementById('modal-body').innerHTML = `
                        <div class="flex justify-between py-1.5 border-b border-gray-100"><span class="text-gray-400">Status</span><span class="font-semibold">${p.status ?? '—'}</span></div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100"><span class="text-gray-400">Client</span><span class="font-semibold">${p.client ?? '—'}</span></div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100"><span class="text-gray-400">Assigned To</span><span class="font-semibold">${p.member ?? 'Unassigned'}</span></div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100"><span class="text-gray-400">Start</span><span class="font-semibold">${fmt(s)}</span></div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100"><span class="text-gray-400">End</span><span class="font-semibold">${fmt(e)}</span></div>
                        <div class="flex justify-between py-1.5"><span class="text-gray-400">Location</span><span class="font-semibold">${p.location ?? '—'}</span></div>
                    `;
                    document.getElementById('modal-link').href = '/useluminii/jobs/' + p.jobId;
                    document.getElementById('eventModal').classList.remove('hidden');
                },
                eventDidMount: function(info) {
                    info.el.style.borderRadius = '6px';
                    info.el.style.padding      = '2px 4px';
                    info.el.style.fontSize     = '11px';
                    info.el.style.fontWeight   = '600';
                    info.el.style.cursor       = 'pointer';
                },
            });

            window._crmCalendar.render();
        }

        document.addEventListener('DOMContentLoaded', initCalendar);
        document.addEventListener('livewire:navigated', () => {
            if (window._crmCalendar) { window._crmCalendar.destroy(); delete window._crmCalendar; }
            initCalendar();
        });
    </script>

    <x-filament-actions::modals />
</x-filament-panels::page>

