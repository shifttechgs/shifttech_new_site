<x-crm::layout title="Edit User">
<div class="crm-page-header">
    <div><a href="{{ route('crm.users.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Users</a> / <span style="font-size:0.875rem;">Edit</span>
    <h1 class="crm-page-title">Edit User</h1></div>
    <a href="{{ route('crm.users.index') }}" class="crm-btn crm-btn-secondary">Back</a>
</div>
<form method="POST" action="{{ route('crm.users.update', $user) }}">
@csrf @method('PUT')
<div style="max-width:560px;">
    <div class="crm-card">
        <div class="crm-card-header"><span class="crm-card-title">{{ $user->name }}</span><span style="font-size:0.8125rem;color:var(--color-ink-3);">{{ $user->email }}</span></div>
        <div class="crm-card-body" style="display:flex;flex-direction:column;gap:1rem;">
            <div><label class="crm-label">Full Name</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="crm-input" required></div>
            <div><label class="crm-label">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="crm-input" required></div>
            <div><label class="crm-label">New Password <span class="crm-label-hint">(leave blank to keep current)</span></label><input type="password" name="password" class="crm-input" minlength="8"></div>
            <div><label class="crm-label">Confirm Password</label><input type="password" name="password_confirmation" class="crm-input"></div>
            <div>
                <label class="crm-label">Role</label>
                <select name="role" class="crm-select">
                    @foreach(\App\Models\User::ROLES as $key => $label)
                    <option value="{{ $key }}" {{ old('role',$user->role)==$key?'selected':'' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display:flex;align-items:center;gap:0.75rem;">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $user->is_active?'checked':'' }}>
                <label for="is_active" class="crm-label" style="margin:0;cursor:pointer;">Active account</label>
            </div>
        </div>
    </div>
    <div style="margin-top:1rem;display:flex;gap:0.5rem;">
        <button type="submit" class="crm-btn crm-btn-primary">Save Changes</button>
        @if($user->id !== auth()->id())
        <form method="POST" action="{{ route('crm.users.destroy', $user) }}" onsubmit="return confirm('Deactivate this user?')" style="margin:0;">
            @csrf @method('DELETE')
            <button type="submit" class="crm-btn crm-btn-danger">Deactivate</button>
        </form>
        @endif
        <a href="{{ route('crm.users.index') }}" class="crm-btn crm-btn-ghost">Cancel</a>
    </div>
</div>
</form>
</x-crm::layout>

