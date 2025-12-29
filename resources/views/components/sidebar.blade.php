<aside>
    <a href="#" class="mobile-btn" id="app-nav-btn">
        <i class="ion-navicon"></i>
    </a>
    <a href="{{URL::to('/')}}">
        <h1>SCHMIDTHAZEN</h1>
    </a>
    <nav id="app-nav">
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
            <li><a href="{{ route('biography') }}">Biography</a></li>
            <li><a href="{{ route('exhibitions') }}">Exhibitions</a></li>
            <li><a href="{{ route('articles') }}">Articles</a></li>
        </ul>
        <a href="mailto:absolutelyschmidt@gmail.com" class="sm">Susan Schmidt-Hazen</a>
    </nav>
</aside>