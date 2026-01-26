<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-calendar-outline"></i> Edit Exhibition
            </h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('exhibitions.update', $exhibition) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <x-input-label for="title" :value="'Title'" />
                <x-text-input id="title" name="title" type="text" class="form-control" required autofocus :value="old('title', $exhibition->title)" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div class="form-group">
                <x-input-label for="subtitle" :value="'Subtitle'" />
                <x-text-input id="subtitle" name="subtitle" type="text" class="form-control" :value="old('subtitle', $exhibition->subtitle)" />
                <x-input-error class="mt-2" :messages="$errors->get('subtitle')" />
            </div>

            <div class="form-group">
                <x-input-label for="description" :value="'Description'" />
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $exhibition->description) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <x-ckeditor-field name="description_two" label="Additional Description" :value="$exhibition->description_two" help="Add formatted text for additional exhibition information" />

            <div class="form-group">
                <x-input-label for="place" :value="'Place'" />
                <x-text-input id="place" name="place" type="text" class="form-control" :value="old('place', $exhibition->place)" placeholder="Gallery or venue name..." />
                <x-input-error class="mt-2" :messages="$errors->get('place')" />
            </div>

            <div class="form-group">
                <x-input-label for="location" :value="'Location'" />
                <x-text-input id="location" name="location" type="text" class="form-control" :value="old('location', $exhibition->location)" placeholder="City, Country..." />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <div class="form-group">
                <x-input-label for="category" :value="'Category'" />
                <x-text-input id="category" name="category" type="text" class="form-control" required :value="old('category', $exhibition->category)" placeholder="Solo Exhibition, Group Show, Fair, etc..." />
                <x-input-error class="mt-2" :messages="$errors->get('category')" />
            </div>

            <div class="form-group">
                <x-input-label for="year" :value="'Year'" />
                <input type="text" id="year" name="year" class="form-control" required value="{{ old('year', $exhibition->year) }}" placeholder="2024">
                <x-input-error class="mt-2" :messages="$errors->get('year')" />
            </div>

            <div class="form-group">
                <x-input-label for="image" :value="'Image (JPEG/PNG, max 2MB)'" />
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png">
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                
                @if($exhibition->image)
                    <div class="mt-2">
                        <small class="text-muted">Current image:</small><br>
                        <img src="{{ asset($exhibition->image) }}" alt="Current image" style="max-width: 200px; max-height: 150px; border: 1px solid #ddd; padding: 5px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default mr-2">
                    Update Exhibition
                </button>
                
                <a href="{{ route('exhibitions.index') }}" class="btn btn-secondary">
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