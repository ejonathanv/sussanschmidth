<x-website-layout description="Small Format Collection">
    <div class="admin-header text-left">
        <div class="row">
            <div class="col-sm-6">
                <h2 icon-title>Small Format Collection</h2>
            </div>
        </div>
    </div>

    <div class="row text-left thumbs" id="sortable">
        @forelse($smallFormats as $smallFormat)
        <div class="col-md-4 col-sm-6" data-small-format="{{ $smallFormat->id }}">
            <div class="media">
                <div class="media-left">
                    <a href="{{ route('small-format', $smallFormat->slug) }}">
                        @php
                            $imageUrl = $smallFormat->image ?: 'https://placehold.co/1600x900';
                        @endphp
                        <figure style="background-image: url('{{ $imageUrl }}')"></figure>
                    </a>
                </div>
                <div class="media-body">
                    <a href="{{ route('small-format', $smallFormat->slug) }}">
                        <h4>{{ $smallFormat->title }}</h4>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p>No small format artworks found.</p>
        </div>
        @endforelse
    </div>
</x-website-layout>