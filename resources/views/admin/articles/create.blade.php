<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-paper-outline"></i> Create New Article
            </h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <x-input-label for="title" :value="'Title'" />
                <x-text-input id="title" name="title" type="text" class="form-control" required autofocus :value="old('title')" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            {{--
            <div class="form-group">
                <x-input-label for="description" :value="'Description'" />
                <x-ckeditor-field name="description" label="Article Content" help="Add formatted text for the article content" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
            --}}

            <div class="form-group">
                <x-input-label for="publication" :value="'Publication'" />
                <x-text-input id="publication" name="publication" type="text" class="form-control" :value="old('publication')" placeholder="Newspaper, Magazine, Journal, etc..." />
                <x-input-error class="mt-2" :messages="$errors->get('publication')" />
            </div>

            <div class="form-group">
                <x-input-label for="location" :value="'Location'" />
                <x-text-input id="location" name="location" type="text" class="form-control" :value="old('location')" placeholder="City, Country..." />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <div class="form-group">
                <x-input-label for="date" :value="'Publication Date'" />
                <input type="date" id="date" name="date" class="form-control" required value="{{ old('date', date('Y-m-d')) }}">
                <x-input-error class="mt-2" :messages="$errors->get('date')" />
            </div>

            <div class="form-group">
                <x-input-label for="image" :value="'Image (JPEG/PNG, max 2MB)'" />
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png">
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default mr-2">
                    Create Article
                </button>
                
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">
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