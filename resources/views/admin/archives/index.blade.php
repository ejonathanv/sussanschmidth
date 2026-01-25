<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-folder-outline"></i> My Archives
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
                <a href="{{ route('archives.create') }}" class="btn btn-default">
                    <i class="ion-plus-round"></i> Add new archive
                </a>
            </div>
            <div class="col-md-6" style="display: flex; align-items: center; justify-content: flex-end;">
                <form method="GET" action="{{ route('dashboard') }}" class="form-inline">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 10px;">
                        <input type="text" name="search" class="form-control" style="margin: 0px" placeholder="Search by title or category..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="ion-search"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
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
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($archives as $archive)
                <tr>
                    <td style="vertical-align: middle;">
                        @if($archive->image)
                            <figure style="background-image: url('{{ asset($archive->image) }}')"></figure>
                        @else
                            <figure style="background-color: #f0f0f0;"></figure>
                        @endif
                    </td>
                    <td style="vertical-align: middle;" class="item-title">
                        {{ $archive->title }}
                        @if($archive->description)
                            <br><small class="text-muted">{{ \Illuminate\Support\Str::limit($archive->description, 50) }}</small>
                        @endif
                    </td>
                    <td style="vertical-align: middle;">
                        {{ $archive->category }}
                    </td>
                    <td style="vertical-align: middle;">{{ $archive->year }}</td>
                    <td style="vertical-align: middle;">
                        {{ $archive->status }}
                    </td>
                    <td style="vertical-align: middle;" class="text-right">
                        <a href="{{ route('archives.edit', $archive) }}" style="margin-right: 1rem">
                            <i class="ion-edit"></i> EDIT
                        </a>
                        <form method="POST" action="{{ route('archives.destroy', $archive) }}" class="remove-item-form" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this archive?');">
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
                    <td colspan="6" class="text-center">
                        @if(request('search'))
                            <p>No archives found matching your search criteria.</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-default">Show all archives</a>
                        @else
                            <p>No archives found. Create your first archive!</p>
                            <a href="{{ route('archives.create') }}" class="btn btn-default">Create Archive</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($archives->hasPages())
            {{ $archives->links('pagination::bootstrap-4') }}
        @endif

        <div class="mt-3 text-muted">
            <small>
                Showing {{ $archives->firstItem() }} to {{ $archives->lastItem() }} of {{ $archives->total() }} archives
                @if(request('search'))
                    - Search results for "{{ request('search') }}"
                @endif
            </small>
        </div>
    </div>
</x-admin-layout>