<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('web.home') }}">
            <img src="{{ mix('build/web/images/logotype.png') }}" alt="{{ config('app.url') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#web-navbar-nav">
            <span class="navbar-toggler-icon">
                <span class="fas fa-bars"></span>
            </span>
        </button>

        <div class="collapse navbar-collapse" id="web-navbar-nav">
            @include('web.components.navbar.nav')
            @include('web.components.navbar.search')
        </div>
    </div>
</nav>
