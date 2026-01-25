<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-briefcase-outline"></i> Edit Small Format
            </h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('small-formats.update', $smallFormat) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required autofocus value="{{ old('title', $smallFormat->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <x-input-label for="description" :value="'Description'" />
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $smallFormat->description) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="form-group">
                <x-input-label for="image" :value="'Image (JPEG/PNG, max 2MB)'" />
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png">
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                
                @if($smallFormat->image)
                    <div class="mt-2">
                        <small class="text-muted">Current image:</small><br>
                        <img src="{{ asset($smallFormat->image) }}" alt="Current image" style="max-width: 200px; max-height: 150px; border: 1px solid #ddd; padding: 5px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <x-input-label for="category" :value="'Category'" />
                <x-text-input id="category" name="category" type="text" class="form-control" required :value="old('category', $smallFormat->category)" />
                <x-input-error class="mt-2" :messages="$errors->get('category')" />
            </div>

            <div class="form-group">
                <x-input-label for="format" :value="'Format'" />
                <x-text-input id="format" name="format" type="text" class="form-control" :value="old('format', $smallFormat->format)" />
                <x-input-error class="mt-2" :messages="$errors->get('format')" />
            </div>

            <div class="form-group">
                <x-input-label for="status" :value="'Status (e.g., Available, Sold, Gallery, Private Collection)'" />
                <x-text-input id="status" name="status" type="text" class="form-control" :value="old('status', $smallFormat->status)" placeholder="Enter current status of the artwork..." />
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>

            <div class="form-group">
                <x-input-label for="location" :value="'Location'" />
                <x-text-input id="location" name="location" type="text" class="form-control" :value="old('location', $smallFormat->location)" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <div class="form-group">
                <x-input-label for="year" :value="'Year'" />
                <input type="number" id="year" name="year" class="form-control" required min="1900" max="{{ date('Y') }}" value="{{ old('year', $smallFormat->year) }}">
                <x-input-error class="mt-2" :messages="$errors->get('year')" />
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <x-input-label for="height" :value="'Height (cm)'" />
                        <input type="number" id="height" name="height" class="form-control" min="0" step="0.1" value="{{ old('height', $smallFormat->height) }}">
                        <x-input-error class="mt-2" :messages="$errors->get('height')" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <x-input-label for="width" :value="'Width (cm)'" />
                        <input type="number" id="width" name="width" class="form-control" min="0" step="0.1" value="{{ old('width', $smallFormat->width) }}">
                        <x-input-error class="mt-2" :messages="$errors->get('width')" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <x-input-label for="length" :value="'Length (cm)'" />
                        <input type="number" id="length" name="length" class="form-control" min="0" step="0.1" value="{{ old('length', $smallFormat->length) }}">
                        <x-input-error class="mt-2" :messages="$errors->get('length')" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="is_available" name="is_available" class="form-check-input" {{ old('is_available', $smallFormat->is_available) ? 'checked' : '' }}>
                            <x-input-label for="is_available" :value="'Available'" class="form-check-label" />
                        </div>
                        <small class="form-text text-muted">Check if this small format is available for purchase/display</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="is_digital_print" name="is_digital_print" class="form-check-input" {{ old('is_digital_print', $smallFormat->is_digital_print) ? 'checked' : '' }}>
                            <x-input-label for="is_digital_print" :value="'Digital Print on Canvas'" class="form-check-label" />
                        </div>
                        <small class="form-text text-muted">Check if this is a digital print on canvas</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default mr-2">
                    Update Small Format
                </button>
                
                <a href="{{ route('small-formats.index') }}" class="btn btn-secondary">
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