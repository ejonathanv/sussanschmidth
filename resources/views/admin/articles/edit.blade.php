<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-paper-outline"></i> Edit Article
            </h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <x-input-label for="title" :value="'Title'" />
                <x-text-input id="title" name="title" type="text" class="form-control" required autofocus :value="old('title', $article->title)" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            {{--
            <div class="form-group">
                <x-input-label for="description" :value="'Description'" />
                <x-ckeditor-field name="description" label="Article Content" :value="$article->description" help="Add formatted text for the article content" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
            --}}

            <div class="form-group">
                <x-input-label for="publication" :value="'Publication'" />
                <x-text-input id="publication" name="publication" type="text" class="form-control" :value="old('publication', $article->publication)" placeholder="Newspaper, Magazine, Journal, etc..." />
                <x-input-error class="mt-2" :messages="$errors->get('publication')" />
            </div>

            <div class="form-group">
                <x-input-label for="location" :value="'Location'" />
                <x-text-input id="location" name="location" type="text" class="form-control" :value="old('location', $article->location)" placeholder="City, Country..." />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <div class="form-group">
                <x-input-label for="date" :value="'Publication Date'" />
                <input type="date" id="date" name="date" class="form-control" required value="{{ $article->date ? \Carbon\Carbon::parse($article->date)->format('Y-m-d') : old('date') }}">
                <x-input-error class="mt-2" :messages="$errors->get('date')" />
            </div>

            <div class="form-group">
                <x-input-label for="image" :value="'Image (JPEG/PNG, max 2MB)'" />
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png">
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                
                @if($article->image)
                    <div class="mt-2">
                        <small class="text-muted">Current image:</small><br>
                        <img src="{{ asset($article->image) }}" alt="Current image" style="max-width: 200px; max-height: 150px; border: 1px solid #ddd; padding: 5px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default mr-2">
                    Update Article
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