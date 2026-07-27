<x-crm::layout title="New Request">
<div class="crm-page-header">
    <div><a href="{{ route('crm.requests.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Requests</a> / <span style="font-size:0.875rem;">New</span>
    <h1 class="crm-page-title">New Client Request</h1></div>
</div>
<form method="POST" action="{{ route('crm.requests.store') }}">
@csrf
<div style="display:grid;grid-template-columns:1fr 280px;gap:1.25rem;">
    <div class="crm-card">
        <div class="crm-card-header"><span class="crm-card-title">Request Details</span></div>
        <div class="crm-card-body" style="display:flex;flex-direction:column;gap:1rem;">
            <div>
                <label class="crm-label">Client <span style="color:var(--color-danger);">*</span></label>
                <select name="client_id" class="crm-select" required>
                    <option value="">— Select Client —</option>
                    @foreach($clients as $c)
                    <option value="{{ $c->client_id }}" {{ old('client_id')==$c->client_id?'selected':'' }}>{{ $c->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="crm-label">Title <span style="color:var(--color-danger);">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="crm-input" required placeholder="Brief description of the request">
            </div>
            <div>
                <label class="crm-label">Description</label>
                <textarea name="description" class="crm-textarea" rows="4">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="crm-label">Assessment Notes <span class="crm-label-hint">(internal)</span></label>
                <textarea name="assessment_notes" class="crm-textarea" rows="3">{{ old('assessment_notes') }}</textarea>
            </div>
        </div>
    </div>
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Classification</span></div>
            <div class="crm-card-body" style="display:flex;flex-direction:column;gap:1rem;">
                <div>
                    <label class="crm-label">Status</label>
                    <select name="status" class="crm-select">
                        @foreach(['New','InReview','Quoted','Approved','Closed'] as $s)
                        <option value="{{ $s }}" {{ old('status','New')==$s?'selected':'' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="crm-label">Priority</label>
                    <select name="priority" class="crm-select">
                        <option value="">— None —</option>
                        @foreach(['Low','Medium','High','Urgent'] as $p)
                        <option value="{{ $p }}" {{ old('priority')==$p?'selected':'' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="crm-btn crm-btn-primary crm-btn-lg" style="width:100%;">Create Request</button>
        <a href="{{ route('crm.requests.index') }}" class="crm-btn crm-btn-ghost" style="width:100%;justify-content:center;">Cancel</a>
    </div>
</div>
</form>
</x-crm::layout>

