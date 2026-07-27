<x-crm::layout title="Edit Request">
<div class="crm-page-header">
    <div><a href="{{ route('crm.requests.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Requests</a> / <span style="font-size:0.875rem;">Edit</span>
    <h1 class="crm-page-title">Edit Request</h1></div>
    <a href="{{ route('crm.requests.show', $clientRequest) }}" class="crm-btn crm-btn-secondary">View</a>
</div>
<form method="POST" action="{{ route('crm.requests.update', $clientRequest) }}">
@csrf @method('PUT')
<div style="display:grid;grid-template-columns:1fr 280px;gap:1.25rem;">
    <div class="crm-card">
        <div class="crm-card-header"><span class="crm-card-title">Request Details</span></div>
        <div class="crm-card-body" style="display:flex;flex-direction:column;gap:1rem;">
            <div><label class="crm-label">Title</label><input type="text" name="title" value="{{ old('title', $clientRequest->title) }}" class="crm-input" required></div>
            <div><label class="crm-label">Description</label><textarea name="description" class="crm-textarea" rows="4">{{ old('description', $clientRequest->description) }}</textarea></div>
            <div><label class="crm-label">Assessment Notes</label><textarea name="assessment_notes" class="crm-textarea" rows="3">{{ old('assessment_notes', $clientRequest->assessment_notes) }}</textarea></div>
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
                        <option value="{{ $s }}" {{ old('status',$clientRequest->status)==$s?'selected':'' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="crm-label">Priority</label>
                    <select name="priority" class="crm-select">
                        <option value="">— None —</option>
                        @foreach(['Low','Medium','High','Urgent'] as $p)
                        <option value="{{ $p }}" {{ old('priority',$clientRequest->priority)==$p?'selected':'' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="crm-btn crm-btn-primary crm-btn-lg" style="width:100%;">Save Changes</button>
        <a href="{{ route('crm.requests.show', $clientRequest) }}" class="crm-btn crm-btn-ghost" style="width:100%;justify-content:center;">Cancel</a>
    </div>
</div>
</form>
</x-crm::layout>

