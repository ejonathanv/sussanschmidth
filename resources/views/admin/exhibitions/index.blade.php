<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-calendar-outline"></i> My Exhibitions
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
                <a href="{{ route('exhibitions.create') }}" class="btn btn-default">
                    <i class="ion-plus-round"></i> Add new exhibition
                </a>
            </div>
            <div class="col-md-6" style="display: flex; align-items: center; justify-content: flex-end;">
                <form method="GET" action="{{ route('exhibitions.index') }}" class="form-inline">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 10px;">
                        <input type="text" name="search" class="form-control" style="margin: 0px" placeholder="Search by title or category..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="ion-search"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('exhibitions.index') }}" class="btn btn-secondary">
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
                    <th>Place</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($exhibitions as $exhibition)
                <tr>
                    <td style="vertical-align: middle;">
                        @if($exhibition->image)
                            <figure style="background-image: url('{{ asset($exhibition->image) }}')"></figure>
                        @else
                            <figure style="background-color: #f0f0f0;"></figure>
                        @endif
                    </td>
                    <td style="vertical-align: middle;" class="item-title">
                        {{ $exhibition->title }}
                        @if($exhibition->subtitle)
                            <br><small class="text-muted">{{ \Illuminate\Support\Str::limit($exhibition->subtitle, 50) }}</small>
                        @endif
                    </td>
                    <td style="vertical-align: middle;">
                        {{ $exhibition->category }}
                    </td>
                    <td style="vertical-align: middle;">{{ $exhibition->year }}</td>
                    <td style="vertical-align: middle;">
                        @if($exhibition->place)
                            {{ $exhibition->place }}
                        @else
                            <span class="text-muted">No place</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle;" class="text-right">
                        <a href="{{ route('exhibitions.edit', $exhibition) }}" style="margin-right: 1rem">
                            <i class="ion-edit"></i> EDIT
                        </a>
                        <form method="POST" action="{{ route('exhibitions.destroy', $exhibition) }}" class="remove-item-form" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this exhibition?');">
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
                            <p>No exhibitions found matching your search criteria.</p>
                            <a href="{{ route('exhibitions.index') }}" class="btn btn-default">Show all exhibitions</a>
                        @else
                            <p>No exhibitions found. Create your first exhibition!</p>
                            <a href="{{ route('exhibitions.create') }}" class="btn btn-default">Create Exhibition</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($exhibitions->hasPages())
            {{ $exhibitions->links('pagination::bootstrap-4') }}
        @endif

        <div class="mt-3 text-muted">
            <small>
                Showing {{ $exhibitions->firstItem() }} to {{ $exhibitions->lastItem() }} of {{ $exhibitions->total() }} exhibitions
                @if(request('search'))
                    - Search results for "{{ request('search') }}"
                @endif
            </small>
        </div>
    </div>
</x-admin-layout>