<x-crm::layout title="Job Calendar">
<div class="crm-page-header">
    <div><h1 class="crm-page-title">Job Calendar</h1><p class="crm-page-subtitle">Schedule and manage job timelines</p></div>
    <div style="display:flex;gap:0.5rem;align-items:center;">
        <span style="font-size:0.8125rem;color:var(--color-ink-3);">Today: {{ $todayJobs }} · This week: {{ $thisWeekJobs }}</span>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 280px;gap:1.25rem;">

    {{-- Calendar --}}
    <div class="crm-card">
        <div class="crm-card-header">
            <span class="crm-card-title">Schedule</span>
            <div style="display:flex;gap:0.375rem;">
                @foreach(['dayGridMonth'=>'Month','timeGridWeek'=>'Week','timeGridDay'=>'Day','listWeek'=>'List'] as $view => $label)
                <button type="button" onclick="calendar.changeView('{{ $view }}')" class="crm-btn crm-btn-ghost crm-btn-sm">{{ $label }}</button>
                @endforeach
            </div>
        </div>
        <div class="crm-card-body" style="padding:1rem;">
            <div id="calendar"></div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem;">

        {{-- Schedule a Job --}}
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Schedule a Job</span></div>
            <form method="POST" action="{{ route('crm.calendar.schedule') }}">
            @csrf
            <div class="crm-card-body" style="display:flex;flex-direction:column;gap:0.875rem;">
                <div>
                    <label class="crm-label">Job</label>
                    <select name="job_id" class="crm-select" required>
                        <option value="">— Select Job —</option>
                        @foreach($unscheduled as $j)
                        <option value="{{ $j->job_id }}">{{ $j->job_id }} — {{ $j->job_title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="crm-label">Assign Team Member</label>
                    <select name="team_member_id" class="crm-select">
                        <option value="">— Unassigned —</option>
                        @foreach($team as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="crm-label">Job Type</label>
                    <select name="job_type" class="crm-select">
                        <option value="Once-off">Once-off</option>
                        <option value="Recurring">Recurring</option>
                    </select>
                </div>
                <div>
                    <label class="crm-label">Start Date & Time <span style="color:var(--color-danger);">*</span></label>
                    <input type="datetime-local" name="scheduled_date" class="crm-input" required>
                </div>
                <div>
                    <label class="crm-label">End Date & Time</label>
                    <input type="datetime-local" name="scheduled_end" class="crm-input">
                </div>
                <div>
                    <label class="crm-label">Location</label>
                    <input type="text" name="location" class="crm-input" placeholder="Site address">
                </div>
                <div>
                    <label class="crm-label">Notes</label>
                    <textarea name="notes" class="crm-textarea" rows="2"></textarea>
                </div>
            </div>
            <div class="crm-card-footer">
                <button type="submit" class="crm-btn crm-btn-primary" style="width:100%;">Schedule Job</button>
            </div>
            </form>
        </div>

        {{-- Unscheduled jobs --}}
        @if($unscheduled->count() > 0)
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Unscheduled</span><span class="crm-badge crm-badge-warning">{{ $unscheduled->count() }}</span></div>
            <div style="max-height:240px;overflow-y:auto;">
                @foreach($unscheduled as $j)
                <div style="padding:0.625rem 1rem;border-bottom:1px solid var(--color-border);">
                    <a href="{{ route('crm.jobs.show', $j) }}" style="font-size:0.8125rem;font-weight:500;color:var(--color-ink-1);">{{ $j->job_title }}</a>
                    <p style="font-size:0.75rem;color:var(--color-ink-3);">{{ $j->client->full_name ?? '—' }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Legend --}}
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Legend</span></div>
            <div class="crm-card-body" style="display:flex;flex-direction:column;gap:0.5rem;">
                @foreach(['New'=>'#6366f1','Scheduled'=>'#2e90fa','InProgress'=>'#f79009','Completed'=>'#12b76a','Cancelled'=>'#f04438'] as $s => $c)
                <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.8125rem;">
                    <span style="width:12px;height:12px;border-radius:3px;background:{{ $c }};flex-shrink:0;"></span>
                    {{ $s }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
let calendar;
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(el, {
        initialView: 'dayGridMonth',
        headerToolbar: { left: 'prev,next today', center: 'title', right: '' },
        height: 550,
        events: '{{ route('crm.calendar.events') }}',
        eventClick: function(info) {
            const p = info.event.extendedProps;
            alert(`${info.event.title}\nClient: ${p.client}\nStatus: ${p.status}\nLocation: ${p.location || '—'}`);
        },
        eventDisplay: 'block',
    });
    calendar.render();
});
</script>
@endpush

</x-crm::layout>

