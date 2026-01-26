<x-admin-layout>
    <div class="text-left">
        <div class="admin-header">
            <h2 icon-title>
                <i class="ion-ios-paper-outline"></i> My Articles
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
                <a href="{{ route('articles.create') }}" class="btn btn-default">
                    <i class="ion-plus-round"></i> Add new article
                </a>
            </div>
            <div class="col-md-6" style="display: flex; align-items: center; justify-content: flex-end;">
                <form method="GET" action="{{ route('articles.index') }}" class="form-inline">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 10px;">
                        <input type="text" name="search" class="form-control" style="margin: 0px" placeholder="Search by title or publication..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="ion-search"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('articles.index') }}" class="btn btn-secondary">
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
                    <th>Publication</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th class="text-right" width="150px">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td style="vertical-align: middle;">
                        @if($article->image)
                            <figure style="background-image: url('{{ asset($article->image) }}')"></figure>
                        @else
                            <figure style="background-color: #f0f0f0;"></figure>
                        @endif
                    </td>
                    <td style="vertical-align: middle;" class="item-title">
                        {{ $article->title }}
                        @if($article->description)
                            <br><small class="text-muted">{{ \Illuminate\Support\Str::limit($article->description, 50) }}</small>
                        @endif
                    </td>
                    <td style="vertical-align: middle;">
                        @if($article->publication)
                            {{ $article->publication }}
                        @else
                            <span class="text-muted">No publication</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle;">
                        @if($article->date)
                            {{ date('M d, Y', strtotime($article->date)) }}
                        @else
                            <span class="text-muted">No date</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle;">
                        @if($article->location)
                            {{ $article->location }}
                        @else
                            <span class="text-muted">No location</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle; display: flex; align-items: center; justify-content: flex-end;" class="text-right">
                        <a href="{{ route('articles.edit', $article) }}" style="margin-right: 1rem, white-space: nowrap;">
                            <i class="ion-edit"></i> EDIT
                        </a>
                        <form method="POST" action="{{ route('articles.destroy', $article) }}" class="remove-item-form" style="display: inline; margin-left: 1rem;" onsubmit="return confirm('Are you sure you want to delete this article?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-item" style="white-space: nowrap;">
                                <i class="ion-close-round"></i> REMOVE
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">
                        @if(request('search'))
                            <p>No articles found matching your search criteria.</p>
                            <a href="{{ route('articles.index') }}" class="btn btn-default">Show all articles</a>
                        @else
                            <p>No articles found. Create your first article!</p>
                            <a href="{{ route('articles.create') }}" class="btn btn-default">Create Article</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($articles->hasPages())
            {{ $articles->links('pagination::bootstrap-4') }}
        @endif

        <div class="mt-3 text-muted">
            <small>
                Showing {{ $articles->firstItem() }} to {{ $articles->lastItem() }} of {{ $articles->total() }} articles
                @if(request('search'))
                    - Search results for "{{ request('search') }}"
                @endif
            </small>
        </div>
    </div>
</x-admin-layout>