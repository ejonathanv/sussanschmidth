<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-briefcase-outline"></i> Create New Small Format
            </h2>
        </div>

        @session('errors')
            <div class="alert alert-danger">
                {{ $errors }}
            </div>
        @endsession

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('small-formats.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required autofocus value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image (JPEG/PNG, max 2MB)</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" id="category" name="category" class="form-control" required value="{{ old('category') }}">
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="format">Format</label>
                <input type="text" id="format" name="format" class="form-control" value="{{ old('format') }}">
                @error('format')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status (e.g., Available, Sold, Gallery, Private Collection)</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ old('status') }}" placeholder="Enter current status of the artwork...">
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}">
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" id="year" name="year" class="form-control" required min="1900" max="{{ date('Y') }}" value="{{ old('year', date('Y')) }}">
                @error('year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="height">Height (cm)</label>
                        <input type="number" id="height" name="height" class="form-control" min="0" step="0.1" value="{{ old('height') }}">
                        @error('height')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="width">Width (cm)</label>
                        <input type="number" id="width" name="width" class="form-control" min="0" step="0.1" value="{{ old('width') }}">
                        @error('width')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="length">Length (cm)</label>
                        <input type="number" id="length" name="length" class="form-control" min="0" step="0.1" value="{{ old('length') }}">
                        @error('length')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <x-ckeditor-field name="digital_info" label="Digital Information" help="Add formatted text about digital availability or information" />

            <div class="form-group">
                <button type="submit" class="btn btn-default mr-2">
                    Create Small Format
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