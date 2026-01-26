<aside>
    <a href="#" class="mobile-btn" id="app-nav-btn">
        <i class="ion-navicon"></i>
    </a>
    @if($isWebsite)
    <a href="{{URL::to('/')}}">
        <h1>SCHMIDTHAZEN</h1>
    </a>
    @else
    <a href="{{ route('dashboard') }}">
        <h1>SCHMIDTHAZEN</h1>
    </a>
    @endif
    <nav id="app-nav">
        @if($isWebsite)
            <ul>
                <li>
                    <a href="{{ route('home') }}">Art Work</a>
                    <ul style="display: block !important;">
                        <li><a href="{{ route('work.year-range', ['startYear' => 2014, 'endYear' => now()->format('Y')]) }}">2014 - {{ now()->format('Y') }}</a></li>
                        <li><a href="{{ route('work.year-range', ['startYear' => 2008, 'endYear' => 2013]) }}">2008 - 2013</a></li>
                        <li><a href="{{ route('work.year-range', ['startYear' => 2002, 'endYear' => 2007]) }}">2002 - 2007</a></li>
                        <li><a href="{{ route('work.year-range', ['startYear' => 1990, 'endYear' => 2001]) }}">1990 - 2001</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('small-formats') }}">Small Format</a></li>
                <li><a href="{{ route('biography') }}">Biography</a></li>
                <li><a href="{{ route('exhibitions') }}">Exhibitions</a></li>
                <li><a href="{{ route('articles') }}">Articles</a></li>
            </ul>
        @endif

        @if($isAdmin)
            <ul>
                <li><a href="{{ route('dashboard') }}">Archives <i class="ion-ios-folder-outline"></i></a></li>
                <li><a href="{{ route('small-formats.index') }}">Small Format <i class="ion-ios-briefcase-outline"></i></a></li>
                <li><a href="{{ route('exhibitions.index') }}">Exhibitions <i class="ion-ios-calendar-outline"></i></a></li>
                <li><a href="{{ route('articles.index') }}">Articles <i class="ion-ios-paper-outline"></i></a></li>
                <li><a href="{{ route('social-links.index') }}">Social Links <i class="ion-social-rss-outline"></i></a></li>
            </ul>
        @endif

        @if($isWebsite)
            @php
                $socialLinks = App\Models\SocialLink::activeAndOrdered()->get();
            @endphp
            @if($socialLinks->isNotEmpty())
                <div class="social-links">
                    @foreach($socialLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" class="social-link" title="{{ $link->name }}">
                            <i class="{{ $link->icon }}"></i>
                        </a>
                    @endforeach
                </div>
            @endif
        @endif

        <a href="mailto:absolutelyschmidt@gmail.com" class="sm">Susan Schmidt-Hazen</a>
    </nav>
</aside>