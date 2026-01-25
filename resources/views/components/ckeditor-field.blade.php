<div class="form-group">
    <label for="{{ $name }}">{{ $label ?? 'Digital Information' }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control ckeditor" rows="6" placeholder="Enter digital information about this artwork...">{{ $value ?? old($name, '') }}</textarea>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
    @if($help)
        <small class="form-text text-muted">{{ $help }}</small>
    @endif
</div>