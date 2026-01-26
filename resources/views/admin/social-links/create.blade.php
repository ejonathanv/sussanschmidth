<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-social-rss-outline"></i> Create New Social Link
            </h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('social-links.store') }}">
            @csrf
            
            <div class="form-group">
                <x-input-label for="name" :value="'Name'" />
                <x-text-input id="name" name="name" type="text" class="form-control" required autofocus :value="old('name')" placeholder="Instagram, Facebook, etc..." />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="form-group">
                <x-input-label for="url" :value="'URL'" />
                <x-text-input id="url" name="url" type="url" class="form-control" required :value="old('url')" placeholder="https://instagram.com/username" />
                <x-input-error class="mt-2" :messages="$errors->get('url')" />
            </div>

            <div class="form-group">
                <x-input-label for="icon" :value="'Icon'" />
                <select id="icon" name="icon" class="form-control" required>
                    <option value="">Select an icon...</option>
                    @foreach($availableIcons as $iconClass => $iconName)
                        <option value="{{ $iconClass }}" {{ old('icon') == $iconClass ? 'selected' : '' }}>
                            {{ $iconName }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('icon')" />
                
                <div class="mt-2">
                    <small class="text-muted">Icon Preview:</small>
                    <div id="icon-preview" style="font-size: 2rem; margin-top: 0.5rem;">
                        <i class="ion-help"></i>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <x-input-label for="order" :value="'Order'" />
                <input type="number" id="order" name="order" class="form-control" min="0" value="{{ old('order', 0) }}" placeholder="0 = last">
                <x-input-error class="mt-2" :messages="$errors->get('order')" />
                <small class="text-muted">Lower numbers appear first. Leave empty or 0 for last position.</small>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="active" class="custom-control-input" id="active" value="1" {{ old('active', true) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="active">Active</label>
                </div>
                <small class="text-muted">Only active links will be displayed on the website</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default mr-2">
                    Create Social Link
                </button>
                
                <a href="{{ route('social-links.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            function updateIconPreview() {
                var selectedIcon = $('#icon').val();
                var iconPreview = $('#icon-preview i');
                
                if (selectedIcon) {
                    iconPreview.removeClass().addClass(selectedIcon);
                } else {
                    iconPreview.removeClass().addClass('ion-help');
                }
            }
            
            $('#icon').on('change', updateIconPreview);
            updateIconPreview(); // Initialize preview
        });
    </script>

    <style>
        .custom-control-input:checked ~ .custom-control-label::before {
            color: #fff;
            border-color: #222;
            background-color: #222;
        }

        .custom-control-input:focus:not(:checked) ~ .custom-control-label::before {
            border-color: #222;
        }

        .custom-control-input:focus ~ .custom-control-label::before {
            box-shadow: 0 0 0 0.2rem rgba(34, 34, 34, 0.25);
        }

        .custom-control-input:not(:disabled):active ~ .custom-control-label::before {
            color: #fff;
            background-color: #666;
            border-color: #666;
        }

        .custom-switch .custom-control-label::after {
            background-color: #adb5bd;
        }

        .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
            background-color: #fff;
        }
    </style>
    @endpush
</x-admin-layout>