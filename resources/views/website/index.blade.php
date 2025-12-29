<x-website-layout description="{{ $startYear }} - {{ $endYear }}">
    <div class="admin-header text-left">
        <div class="row">
            <div class="col-sm-6">
                <h2 icon-title>{{ $startYear }} - {{ $endYear }}</h2>
            </div>
        </div>
    </div>

    <div class="row text-left thumbs" id="sortable">
        @forelse($archives as $archive)
        <div class="col-md-4 col-sm-6" data-archive="{{ $archive->id }}">
            <div class="media">
                <div class="media-left">
                    <a href="{{ route('archive', [$startYear, $endYear, $archive->slug]) }}">
                        @php
                            $imageUrl = $archive->image ?: 'https://placehold.co/1600x900';
                        @endphp
                        <figure style="background-image: url('{{ $imageUrl }}')"></figure>
                    </a>
                </div>
                <div class="media-body">
                    <a href="{{ route('archive', [$startYear, $endYear, $archive->slug]) }}">
                        <h4>{{ $archive->title }}</h4>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p>No se encontraron obras de arte para este rango de años.</p>
        </div>
        @endforelse
    </div>
</x-website-layout>