<x-crm::layout title="New Job">
<div class="crm-page-header">
    <div>
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <a href="{{ route('crm.jobs.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Jobs</a>
            <span style="color:var(--color-ink-3);">/</span><span style="font-size:0.875rem;">New Job</span>
        </div>
        <h1 class="crm-page-title">New Job</h1>
    </div>
</div>

<form method="POST" action="{{ route('crm.jobs.store') }}">
@csrf
<div style="display:grid;grid-template-columns:1fr 300px;gap:1.25rem;">

    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Job Details</span></div>
            <div class="crm-card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Client <span style="color:var(--color-danger);">*</span></label>
                    <select name="client_id" class="crm-select" required>
                        <option value="">— Select Client —</option>
                        @foreach($clients as $c)
                        <option value="{{ $c->client_id }}" {{ (old('client_id', $selectedClient?->client_id) == $c->client_id) ? 'selected' : '' }}>
                            {{ $c->full_name }}{{ $c->company ? ' — '.$c->company : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Job Title <span style="color:var(--color-danger);">*</span></label>
                    <input type="text" name="job_title" value="{{ old('job_title') }}" class="crm-input" placeholder="e.g. Website Maintenance" required>
                </div>
                <div>
                    <label class="crm-label">Linked Quote</label>
                    <select name="quote_id" class="crm-select">
                        <option value="">— None —</option>
                        @foreach($quotes as $q)
                        <option value="{{ $q->quote_id }}" {{ old('quote_id')==$q->quote_id?'selected':'' }}>{{ $q->quote_id }} — {{ $q->job_title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="crm-label">Assign To</label>
                    <select name="team_member_assigned_id" class="crm-select">
                        <option value="">— Unassigned —</option>
                        @foreach($team as $member)
                        <option value="{{ $member->id }}" {{ old('team_member_assigned_id')==$member->id?'selected':'' }}>{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="crm-label">Scheduled Date / Time</label>
                    <input type="datetime-local" name="job_date_time" value="{{ old('job_date_time') }}" class="crm-input">
                </div>
                <div>
                    <label class="crm-label">Status</label>
                    <select name="job_status" class="crm-select">
                        @foreach(['New','Scheduled','InProgress','Completed','Cancelled'] as $s)
                        <option value="{{ $s }}" {{ old('job_status','New')==$s?'selected':'' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Instructions <span class="crm-label-hint">(visible to team)</span></label>
                    <textarea name="instructions" class="crm-textarea" rows="3">{{ old('instructions') }}</textarea>
                </div>
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Internal Notes</label>
                    <textarea name="job_notes" class="crm-textarea" rows="2">{{ old('job_notes') }}</textarea>
                </div>
            </div>
        </div>
        @include('crm.partials.line-items', ['items' => old('items', [])])
    </div>

    <div style="display:flex;flex-direction:column;gap:1.25rem;padding-top:3.5rem;">
        <button type="submit" class="crm-btn crm-btn-primary crm-btn-lg" style="width:100%;">Create Job</button>
        <a href="{{ route('crm.jobs.index') }}" class="crm-btn crm-btn-ghost" style="width:100%;justify-content:center;">Cancel</a>
    </div>

</div>
</form>
</x-crm::layout>

