<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-briefcase-outline"></i> Small Formats
            </h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search and Add Section -->
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('small-formats.create') }}" class="btn btn-default">
                    <i class="ion-plus-round"></i> Add new small format
                </a>
            </div>
            <div class="col-md-6" style="display: flex; align-items: center; justify-content: flex-end;">
                <form method="GET" action="{{ route('small-formats.index') }}" class="form-inline">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 10px;">
                        <input type="text" name="search" class="form-control" style="margin: 0px" placeholder="Search by title or category..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="ion-search"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('small-formats.index') }}" class="btn btn-secondary">
                                <i class="ion-close-round"></i> Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <table id="archives-table" class="table table-sm table-striped">
            <thead>
                <tr>
                    <th style="width: 70px">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Year</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($smallFormats as $smallFormat)
                <tr>
                    <td style="vertical-align: middle;">
                        @if($smallFormat->image)
                            <figure style="background-image: url('{{ asset($smallFormat->image) }}')"></figure>
                        @else
                            <figure style="background-color: #f0f0f0;"></figure>
                        @endif
                    </td>
                    <td style="vertical-align: middle;" class="item-title">
                        {{ $smallFormat->title }}
                        @if($smallFormat->description)
                            <br><small class="text-muted">{{ \Illuminate\Support\Str::limit($smallFormat->description, 50) }}</small>
                        @endif
                    </td>
                    <td style="vertical-align: middle;">
                        {{ $smallFormat->category }}
                    </td>
                    <td style="vertical-align: middle;">{{ $smallFormat->year }}</td>
                    <td style="vertical-align: middle;" class="text-right">
                        <a href="{{ route('small-formats.edit', $smallFormat) }}" style="margin-right: 1rem">
                            <i class="ion-edit"></i> EDIT
                        </a>
                        <form method="POST" action="{{ route('small-formats.destroy', $smallFormat) }}" class="remove-item-form" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this small format?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-item">
                                <i class="ion-close-round"></i> REMOVE
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        @if(request('search'))
                            <p>No small formats found matching your search criteria.</p>
                            <a href="{{ route('small-formats.index') }}" class="btn btn-default">Show all small formats</a>
                        @else
                            <p>No small formats found. Create your first small format!</p>
                            <a href="{{ route('small-formats.create') }}" class="btn btn-default">Create Small Format</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($smallFormats->hasPages())
            {{ $smallFormats->links('pagination::bootstrap-4') }}
        @endif

        <div class="mt-3 text-muted">
            <small>
                Showing {{ $smallFormats->firstItem() }} to {{ $smallFormats->lastItem() }} of {{ $smallFormats->total() }} small formats
                @if(request('search'))
                    - Search results for "{{ request('search') }}"
                @endif
            </small>
        </div>
    </div>
</x-admin-layout>