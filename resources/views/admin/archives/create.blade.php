<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-folder-outline"></i> Create New Archive
            </h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('archives.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <x-input-label for="title" :value="'Title'" />
                <x-text-input id="title" name="title" type="text" class="form-control" required autofocus :value="old('title')" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div class="form-group">
                <x-input-label for="description" :value="'Description'" />
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="form-group">
                <x-input-label for="image" :value="'Image (JPEG/PNG, max 2MB)'" />
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png">
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <div class="form-group">
                <x-input-label for="category" :value="'Category'" />
                <x-text-input id="category" name="category" type="text" class="form-control" required :value="old('category')" />
                <x-input-error class="mt-2" :messages="$errors->get('category')" />
            </div>

            <div class="form-group">
                <x-input-label for="format" :value="'Format'" />
                <x-text-input id="format" name="format" type="text" class="form-control" :value="old('format')" />
                <x-input-error class="mt-2" :messages="$errors->get('format')" />
            </div>

            <div class="form-group">
                <x-input-label for="status" :value="'Status (e.g., Available, Sold, Gallery, Private Collection)'" />
                <x-text-input id="status" name="status" type="text" class="form-control" :value="old('status')" placeholder="Enter current status of the artwork..." />
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>

            <div class="form-group">
                <x-input-label for="location" :value="'Location'" />
                <x-text-input id="location" name="location" type="text" class="form-control" :value="old('location')" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <div class="form-group">
                <x-input-label for="year" :value="'Year'" />
                <input type="number" id="year" name="year" class="form-control" required min="1900" max="{{ date('Y') }}" value="{{ old('year', date('Y')) }}">
                <x-input-error class="mt-2" :messages="$errors->get('year')" />
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <x-input-label for="height" :value="'Height (cm)'" />
                        <input type="number" id="height" name="height" class="form-control" min="0" step="0.1" value="{{ old('height') }}">
                        <x-input-error class="mt-2" :messages="$errors->get('height')" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <x-input-label for="width" :value="'Width (cm)'" />
                        <input type="number" id="width" name="width" class="form-control" min="0" step="0.1" value="{{ old('width') }}">
                        <x-input-error class="mt-2" :messages="$errors->get('width')" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <x-input-label for="length" :value="'Length (cm)'" />
                        <input type="number" id="length" name="length" class="form-control" min="0" step="0.1" value="{{ old('length') }}">
                        <x-input-error class="mt-2" :messages="$errors->get('length')" />
                    </div>
                </div>
            </div>

            <x-ckeditor-field name="digital_info" label="Digital Information" help="Add formatted text about digital availability or information" />

            <div class="form-group">
                <button type="submit" class="btn btn-default mr-2">
                    Create Archive
                </button>
                
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Preview image before upload
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You can add image preview functionality here if needed
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    @endpush
</x-admin-layout>