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
                <a href="#">Art Work</a>
                <ul style="display: block !important;">
                    <li><a class="#">2014 - {{ now()->format('Y') }}</a></li>
                    <li><a class="#">2008 - 2013</a></li>
                    <li><a class="#">2002 - 2007</a></li>
                    <li><a class="#">1990 - 2001</a></li>
                </ul>
            </li>
            <li><a href="#">Biography</a></li>
            <li>
                <a href="#">Exhibitions</a>
            </li>
            <li><a href="#">Articles</a></li>
        </ul>
        <a href="mailto:absolutelyschmidt@gmail.com" class="sm">Susan Schmidt-Hazen</a>
    </nav>
</aside>