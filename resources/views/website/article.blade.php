<x-website-layout description="Articles">
    <div class="admin-header text-left">
        <div class="row">
            <div class="col-sm-6">
                <h2 icon-title>{{$article->title}}</h2>
            </div>
        </div>
    </div>

    <div class="text-left">
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-4">
                        <p><small style="color:#7B7B7B" class="text-uppercase">Publication</small><br> {{$article->publication}}</p>
                    </div>
                    <div class="col-sm-4">
                        <p><small style="color:#7B7B7B" class="text-uppercase">Date</small><br> {{ date('d F, Y', strtotime($article->date)) }}</p>
                    </div>
                    <div class="col-sm-4">
                        <p><small style="color:#7B7B7B" class="text-uppercase">Location</small><br> {{$article->location}}</p>
                    </div>
                </div>

                <img src="{{asset($article->image)}}" style="width: 100%; margin-top:2rem">
            </div>
            <div class="col-sm-4">
                @if($articles->count() > 0)
                    <h4>List of articles</h4>
                    <hr>
                    @foreach($articles as $article)

                        <a href="{{route('article', $article->slug)}}">
                            <p style="margin:0">{{$article->title}}</p>
                            <p><small style="color:#7B7B7B">{{ date('d F, Y', strtotime($article->date)) }}</small></p>
                        </a>

                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-website-layout>