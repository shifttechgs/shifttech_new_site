<x-crm::layout title="Edit Service">
<div class="crm-page-header">
    <div>
        <h1 class="crm-page-title">Edit Service</h1>
        <p class="crm-page-subtitle">{{ $service->name }}</p>
    </div>
    <a href="{{ route('crm.services.index') }}" class="crm-btn crm-btn-secondary">Cancel</a>
</div>

<div style="max-width:640px;">
<form method="POST" action="{{ route('crm.services.update', $service) }}" class="crm-card" style="padding:1.5rem;display:flex;flex-direction:column;gap:1.25rem;">
    @csrf @method('PUT')

    <div class="crm-form-group">
        <label class="crm-label">Service Name <span style="color:var(--color-danger);">*</span></label>
        <input type="text" name="name" class="crm-input @error('name') is-invalid @enderror"
               value="{{ old('name', $service->name) }}" required>
        @error('name') <p class="crm-field-error">{{ $message }}</p> @enderror
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div class="crm-form-group">
            <label class="crm-label">Category</label>
            <select name="category" class="crm-select">
                <option value="">— None —</option>
                @foreach(['Web','Mobile','Design','Software','Cloud','AI','Support','Consulting','Other'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $service->category) === $cat ? 'selected' : '' }}>{{ $cat === 'AI' ? 'AI & Automation' : $cat }}</option>
                @endforeach
            </select>
        </div>

        <div class="crm-form-group">
            <label class="crm-label">Priced Per <span style="color:var(--color-danger);">*</span></label>
            <select name="unit_type" class="crm-select" required>
                @foreach(['hour' => 'Hour', 'day' => 'Day', 'item' => 'Item', 'job' => 'Job (fixed)', 'month' => 'Month'] as $val => $lbl)
                    <option value="{{ $val }}" {{ old('unit_type', $service->unit_type) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="crm-form-group">
        <label class="crm-label">Default Price (R) <span style="color:var(--color-danger);">*</span></label>
        <div style="position:relative;">
            <span style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:var(--color-ink-3);font-weight:500;">R</span>
            <input type="number" name="unit_price" class="crm-input @error('unit_price') is-invalid @enderror"
                   value="{{ old('unit_price', $service->unit_price) }}" step="0.01" min="0" required style="padding-left:1.75rem;">
        </div>
        @error('unit_price') <p class="crm-field-error">{{ $message }}</p> @enderror
    </div>

    <div class="crm-form-group">
        <label class="crm-label">Description</label>
        <textarea name="description" class="crm-input" rows="3">{{ old('description', $service->description) }}</textarea>
    </div>

    <div style="display:flex;align-items:center;gap:0.625rem;">
        <input type="checkbox" name="is_active" id="is_active" value="1"
               {{ old('is_active', $service->is_active) ? 'checked' : '' }}
               style="width:1rem;height:1rem;accent-color:var(--color-accent);">
        <label for="is_active" style="font-size:0.875rem;font-weight:500;color:var(--color-ink-1);cursor:pointer;">
            Active — visible in all dropdowns
        </label>
    </div>

    <div style="display:flex;gap:0.75rem;padding-top:0.25rem;">
        <button type="submit" class="crm-btn crm-btn-primary">Save Changes</button>
        <a href="{{ route('crm.services.index') }}" class="crm-btn crm-btn-secondary">Cancel</a>
    </div>
</form>
</div>
</x-crm::layout>
