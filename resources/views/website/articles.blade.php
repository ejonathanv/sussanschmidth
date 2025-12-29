<x-website-layout description="Articles">
    <div class="admin-header text-left">
        <div class="row">
            <div class="col-sm-6">
                <h2 icon-title>Articles - Press</h2>
            </div>
        </div>
    </div>

    <div class="text-left">
        <div class="row">
            <div class="col-sm-6">
                @foreach($articles as $article)

                <a href="{{ route('article', $article->slug) }}">
                    <p style="margin:0">{{$article->title}}</p>
                    <p><small style="color:#7B7B7B">{{ date('d F, Y', strtotime($article->date)) }}</small></p>
                </a>

                @endforeach
            </div>
        </div>
    </div>
</x-website-layout>